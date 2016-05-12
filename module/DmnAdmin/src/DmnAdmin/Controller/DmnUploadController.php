<?php
namespace DmnAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use DmnAdmin\Service\DmnuploadService;
use Zend\View\Model\ViewModel;

class DmnUploadController extends AbstractActionController
{
    protected $upload;

    public function __construct(DmnuploadService $upload)
    {
        $this->upload = $upload;
    }

    public function indexAction()
    {
        $view = new ViewModel();
        $response = $this->getResponse();
        $response->getHeaders()->clearHeaders()->addHeaders(array(
            'Pragma' => 'no-cache',
            'Last-Modified' => gmdate("D, d M Y H:i:s") . " GMT",
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
        ));
        $request = $this->getRequest();
        //if select organization and client controller get user id
        try {
            if ($request->isPost()) {
                $this->upload->setId($this->getRequest()->getQuery()->get('id', null));
                $postArr = $request->getPost()->toArray();
                $fileArr = $this->params()->fromFiles('file');
                $formData = array_merge(
                    $postArr, //POST
                    array('file' => $fileArr['name'])
                );
                $adapter = new \Zend\File\Transfer\Adapter\Http();
                $adapter->setDestination($this->upload->getDirectory());
                $size = new \Zend\Validator\File\Size(array('min' => 1)); // minimum bytes filesize, max too..
                $extension = new \Zend\Validator\File\Extension(array('extension' => array('xls', 'xlsx')));
                $adapter->setValidators(array($size, $extension), $fileArr['name']);
                $files = $adapter->getFileInfo();
                foreach ($files as $file => $info) {
                    $this->upload->setFileName($adapter->getFileName($file));
                    // file uploaded & is valid
                    if (!$adapter->isUploaded($file)) {
                        return $this->getResponse()->setContent(json_encode(array('jsonrpc' => '2.0', 'error' => array('code' => 100, 'message' => $adapter->getMessages())), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                        continue;
                    }
                    if (!$adapter->isValid($file)) {
                        return $this->getResponse()->setContent(json_encode(array('jsonrpc' => '2.0', 'error' => array('code' => 100, 'message' => $adapter->getMessages())), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                        continue;
                    }
                    // receive the files into the user directory
                    $check = $adapter->receive($file); // this has to be on top
                    if (!$check) {
                        return $this->getResponse()->setContent(json_encode(array('jsonrpc' => '2.0', 'error' => array('code' => 100, 'message' => $adapter->getMessages())), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                    }
                    $error = $this->upload->uploadFileToDatabase();
                    if (is_array($error)) {
                        foreach ($error as $err) {
                            if (!$err) {
                                $this->upload->deleteFileFromDirectory();
                                return $this->getResponse()->setContent(json_encode(array('success' => true), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                            } else {
                                return $this->getResponse()->setContent(json_encode(array('jsonrpc' => '2.0', 'error' => array('code' => 100, 'message' => $err), 'id' => 'id'), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                            }
                        }
                    }
                }

                $this->upload->deleteFileFromDirectory();
            }
        } catch (\Exception $e) {
            return $this->getResponse()->setContent(json_encode(array('jsonrpc' => '2.0', 'error' => $e->getMessage()), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }

        $view->setTemplate('dmnadmin/dmnupload/index');
        return $view;
    }

    public function downloadxlsAction()
    {
        $response = $this->getResponse();
        $response->getHeaders()->clearHeaders()->addHeaders(array(
            'Pragma' => 'public',
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment;filename="CT-1_' . date('Y_m_d(H:i:s)') . '.xls"',
            'Cache-Control' => 'max-age=0'
        ));
        $id = $this->params()->fromQuery('id', 0);
        if (!is_null($id)) {
            $this->upload->setId($id);
            $this->upload->setFileName('maketCT-1.xls');
            ob_start();
            $this->upload->downloadXls();
            $excelOutput = ob_get_clean();
            $response->setContent($excelOutput);
        }
        return $response;
    }

    public function downloadprintAction()
    {
        $response = $this->getResponse();
        $response->getHeaders()->clearHeaders()->addHeaders(array(
            'Pragma' => 'public',
            'Content-Type' => 'application/application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment;filename="CT-1_' . date('Y_m_d(H:i:s)') . '.xls"',
            'Cache-Control' => 'max-age=0'
        ));
        $id = $this->params()->fromQuery('id', 0);
        if (!is_null($id)) {
            $this->upload->setId($id);
            $fileName = $this->upload->getFileNameById();
            if (!empty($fileName['workorder'])) {
                ob_start();
                $this->upload->downloadPrint();
                $excelOutput = ob_get_clean();
                $response->setContent($excelOutput);
            } else {
                return $response->setContent(json_encode(array('jsonrpc' => '2.0', 'error' => array('code' => 100, 'message' => 'Не введен номер сертификата')), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            }
        }
        return $response;
    }

    public function downloadxmlAction()
    {
        $id = $this->params()->fromQuery('id', 0);
        $response = $this->getResponse();
        $response->getHeaders()->clearHeaders()->addHeaders(array(
            'Pragma' => 'public',
            'Content-Type' => 'application/xml',
            'Cache-Control' => 'max-age=0'
        ));
        if (!is_null($id)) {
            $this->upload->setId($id);
            $fileName = $this->upload->getFileNameById();
            $xml = $this->getServiceLocator()->get('dmn_xml');
            $xml->setEncoding('windows-1251');
            if (!empty($fileName['workorder'])) {
                $response->getHeaders()->addHeaderLine('Content-Disposition', 'attachment;filename="' . $fileName['workorder'] . '.xml"');
                $this->upload->setFileName($fileName['workorder']);
                $writer = $this->upload->downloadXml();
            } else {
                return $response->setContent(json_encode(array('jsonrpc' => '2.0', 'error' => array('code' => 100, 'message' => 'Не введен номер сертификата')), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

            }
            $xml->setRootName('cert');
            $response->setContent($xml->convert($writer));
        }

        return $response;
    }

    public function uploadxmlAction()
    {
        $response = $this->getResponse();
        $date = new \DateTime('NOW');
        $data = $this->upload->getRequestNumbersByDate($date);

        if (is_array($data) && count($data) > 0) {
            $directory = '1C/download/' . $date->format('d_m_Y');
            if (is_dir($directory))
                $this->upload->delTree($directory);
            mkdir($directory, 0777, true);
            $xml = $this->getServiceLocator()->get('dmn_xml');
            foreach ($data as $key => $value) {
                $this->upload->setId($value['id']);
                $xml->setEncoding('windows-1251');
                $xml->setFile($directory . '/' . $value['id'] . '.xml');
                $writer = $this->upload->downloadXml();
                $xml->setRootName('cert');
                $xml->convertToFile($writer);
                $xml->flush();
            }
        }
        return $response;
    }

    public function reqxmlAction()
    {
        $response = $this->getResponse();
        $date = new \DateTime('NOW');
        $data = $this->upload->getRequestNumbersByStatus();
        if (is_array($data) && count($data) > 0) {
            $directory = '1C/request/' . $date->format('d_m_Y');
            if (is_dir($directory))
                $this->upload->delTree($directory);
            mkdir($directory, 0777, true);
            $xml = $this->getServiceLocator()->get('dmn_xml');
            foreach ($data as $key => $value) {
                $this->upload->setId($value['id']);
                $xml->setEncoding('windows-1251');
                $xml->setFile($directory . '/' . $value['id'] . '.xml');
                $writer = $this->upload->downloadXml();
                $xml->setRootName('cert');
                $xml->convertToFile($writer);
                $xml->flush();
                $data = $this->upload->getRequestService()->fillXmlUnloading($value, $date);
            }
        }
        return $response;
    }


}
