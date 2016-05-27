<?php
namespace DmnAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DmnAdmin\Service\DmnuploadService;

class DmnUploadController extends AbstractActionController
{
    protected $upload;

    public function __construct(DmnuploadService $upload)
    {
        $this->upload = $upload;
    }

    /**
     * Upload File into the Database
     * @return Json|ViewModel
     */
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
        if ($request->isPost()) {
                //if select organization and client controller get user id
                $this->upload->setId($this->getRequest()->getQuery()->get('id', null));
                $fileArr = $this->params()->fromFiles('file');
                $response=$this->upload->saveFile($fileArr);
                return $this->getResponse()->setContent($response);
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
            $requestNumber = $this->upload->getRequestNumberWithValidate();
            if (($requestNumber === null) || (is_string($requestNumber))) {
                return $response->setContent($requestNumber, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            } else {
                ob_start();
                $this->upload->downloadPrint($requestNumber);
                $excelOutput = ob_get_clean();
                $response->setContent($excelOutput);
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
        return $this->getResponse()->setContent(json_encode(['success'=>true], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    public function reqxmlAction()
    {
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
        return $this->getResponse()->setContent(json_encode(['success'=>true], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }


}
