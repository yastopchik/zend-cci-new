<?php
namespace DmnExecutor\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DmnExecutor\Service\DmnexrequestService;

class DmnExrequestController extends AbstractActionController
{

    protected $dbRequest;

    public function __construct(DmnexrequestService $dbRequest)
    {
        $this->dbRequest = $dbRequest;
    }

    public function indexAction()
    {
        $view = new ViewModel();
        $view->setTemplate('dmnexecutor/dmnexrequest/index');
        return $view;
    }

    public function addAction()
    {
        $view = new ViewModel();
        $this->dbRequest->clearSession();
        $view->setTemplate('dmnexecutor/dmnexrequest/add');
        return $view;
    }
    public function archiveAction()
    {
        $view = new ViewModel();
        $view->setTemplate('dmnexecutor/dmnexrequest/archive');
        return $view;
    }
    public function uploadAction()
    {
        $view = new ViewModel();
        $response = $this->getResponse();
        $response->getHeaders()->clearHeaders()->addHeaders(array(
            'Pragma' => 'no-cache',
            'Last-Modified' => gmdate("D, d M Y H:i:s") . " GMT",
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
        ));
        $upload = $this->dbRequest->getUploadService();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $upload->setId($this->getRequest()->getQuery()->get('id', null));
            $upload->setAuth($this->dbRequest->getAuth());
            $fileArr = $this->params()->fromFiles('file');
            $response=$upload->saveFile($fileArr);
            return $this->getResponse()->setContent($response);
        }
        $view->setTemplate('dmnexecutor/dmnexrequest/upload');
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
            $upload = $this->dbRequest->getUploadService();
            $upload->setId($id);
            $upload->setFileName('maketCT-1.xls');
            ob_start();
            $upload->downloadXls();
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
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment;filename="CT-1_' . date('Y_m_d(H:i:s)') . '.xls"',
            'Cache-Control' => 'max-age=0'
        ));
        $id = $this->params()->fromQuery('id', 0);
        if (!is_null($id)) {
            $upload = $this->dbRequest->getUploadService();
            $upload->setId($id);
            $requestNumber = $upload->getRequestNumberWithValidate();
            if (($requestNumber === null) || (is_string($requestNumber))) {
                return $response->setContent($requestNumber, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            } else {
                ob_start();
                $upload->downloadPrint($requestNumber);
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
            $upload = $this->dbRequest->getUploadService();
            $upload->setId($id);
            $fileName = $upload->getFileNameById();
            $xml = $this->getServiceLocator()->get('dmn_xml');
            $xml->setEncoding('windows-1251');
            if (!empty($fileName['workorder'])) {
                $response->getHeaders()->addHeaderLine('Content-Disposition', 'attachment;filename="' . $fileName['workorder'] . '.xml"');
                $writer = $upload->downloadXml();
                $upload->setFileName($fileName['workorder']);
            } else {
                $writer = array('error' => 'Не введен номер сертификата');
            }
            $xml->setRootName('cert');
            $response->setContent($xml->convert($writer));
        }

        return $response;
    }

    public function getrequestnumberAction()
    {

        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbRequest->setQueryParametrs($parameters);
        }

        $response = $this->dbRequest->getRequestNumber();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }

    public function getrequestAction()
    {

        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbRequest->setQueryParametrs($parameters);
        }

        $response = $this->dbRequest->getRequest();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }

    public function getoptionAction()
    {

        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbRequest->setQueryParametrs($parameters);
        }

        $response = $this->dbRequest->getOption();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }

    public function getaddrequestAction()
    {

        $response = $this->dbRequest->getRequestForAdd();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }

    public function getaddrequestdescAction()
    {
        $response = $this->dbRequest->getRequestDescForAdd();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }

    public function getrequestdescAction()
    {
        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbRequest->setQueryParametrs($parameters);
        }

        $response = $this->dbRequest->getRequestDescription();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    public function getpriorityAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);

        $response = $this->dbRequest->getPriorities();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }

    public function getcountryidsAction()
    {
        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbRequest->setQueryParametrs($parameters);
        }

        $response = $this->dbRequest->getCountryRequestNumber();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }
    public function getcountryjsonAction()
    {

        $response = $this->dbRequest->getCountriesJson();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }
    public function getcountriesAction()
    {
        $view = new ViewModel();
        $view->setTerminal(true);
        $parameters = $this->getRequest()->getQuery();
        $response = $this->dbRequest->getCountries();
        $view->setVariable('response', $response);
        $view->setVariable('id', $parameters->get('id', ''));
        $view->setTemplate('dmnexecutor/dmnexrequest/country');
        return $view;

    }

    public function geteditcountriesAction()
    {

        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbRequest->setQueryParametrs($parameters);
        }

        $response = $this->dbRequest->getCountries();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }
    public function getexorganizationAction()
    {
        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbRequest->setQueryParametrs($parameters);
        }

        $response = $this->dbRequest->getOrganizationForEx();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }
    public function getexexecutorsAction()
    {

        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbRequest->setQueryParametrs($parameters);
        }

        $response = $this->dbRequest->getExecutorsForEx();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }
    public function getcountrybyidAction()
    {

        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbRequest->setQueryParametrs($parameters);
        }

        $response = $this->dbRequest->getCountryById();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }

    public function getcountrybynameAction()
    {

        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbRequest->setQueryParametrs($parameters);
        }

        $response = $this->dbRequest->getCountryByName();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }

    public function getorganizationAction()
    {
        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbRequest->setQueryParametrs($parameters);
        }

        $response = $this->dbRequest->getOrganizationForEx();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }

    public function getstatusAction()
    {

        $id = (int)$this->params()->fromRoute('id', 0);

        $response = $this->dbRequest->getStatuses();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }

    public function getformsAction()
    {

        $id = (int)$this->params()->fromRoute('id', 0);

        $response = $this->dbRequest->getForms();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }

    public function getexecutorsAction()
    {

        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbRequest->setQueryParametrs($parameters);
        }

        $response = $this->dbRequest->getExecutorsForEx();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }

    public function getlifecycleAction()
    {
        $view = new ViewModel();

        $view->setTerminal(true);

        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbRequest->setQueryParametrs($parameters);
        }
        $data = $this->dbRequest->getLifeCycle();

        $view->setVariable('data', $data);

        $view->setTemplate('dmnexecutor/dmnexrequest/show');

        return $view;

    }

    public function editrequestnumberAction()
    {

        $parameters = $this->getRequest()->getPost();

        if ($parameters) {

            $this->dbRequest->setPostParametrs($parameters);

            return $this->dbRequest->editRequestNumber();
        }
        return false;
    }

    public function editrequestdescAction()
    {

        $parameters = $this->getRequest()->getPost();

        if ($parameters) {

            $this->dbRequest->setPostParametrs($parameters);

            return $this->dbRequest->editRequestDescription();
        }
        return false;
    }

    public function editrequestAction()
    {

        $parameters = $this->getRequest()->getPost();

        if ($parameters) {

            $this->dbRequest->setPostParametrs($parameters);

            return $this->dbRequest->editRequest();
        }
        return false;
    }

    public function addrequestAction()
    {

        $parameters = $this->getRequest()->getPost();

        if ($parameters) {

            $this->dbRequest->setPostParametrs($parameters);

            return $this->dbRequest->editSessionRequestValue();
        }
        return false;
    }

    public function addrequestdescAction()
    {

        $parameters = $this->getRequest()->getPost();

        if ($parameters) {

            $this->dbRequest->setPostParametrs($parameters);

            return $this->dbRequest->editSessionRequestDescValue();
        }
        return false;
    }

    public function saveAction()
    {
        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {

            $this->dbRequest->setQueryParametrs($parameters);
        }
        $result = $this->dbRequest->SaveRequestFromSession();

        return $this->getResponse()->setContent(json_encode('Ок', JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    public function updatecountryAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);

        $countryId = (int)$this->params()->fromRoute('countryId', 0);

        if (is_int($countryId) && !is_null($countryId) && is_int($id) && !is_null($id)) {

            $this->getRequest()->setPost(new \Zend\Stdlib\Parameters(array(
                'id' => $id,
                'destinationiso' => $countryId,

            )));
        }

        $parameters = $this->getRequest()->getPost();

        if ($parameters) {

            $this->dbRequest->setPostParametrs($parameters);

            $this->dbRequest->editRequestNumber();
        }
        return $this->redirect()->toRoute('dmnexrequest', array('action' => 'index'));
    }

    public function sendmailAction()
    {

        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbRequest->setQueryParametrs($parameters);
        }

        $response = $this->dbRequest->sendMail();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }


}
