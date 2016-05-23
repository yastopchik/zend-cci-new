<?php
namespace DmnAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use DmnAdmin\Service\DmnrequestService;
use Zend\View\Model\ViewModel;

class DmnRequestController extends AbstractActionController
{

    protected $dbRequest;

    public function __construct(DmnrequestService $dbRequest)
    {
        $this->dbRequest = $dbRequest;
    }

    public function indexAction()
    {
        $view = new ViewModel();
        $view->setTemplate('dmnadmin/dmnrequest/index');
        return $view;
    }

    public function addAction()
    {
        $view = new ViewModel();
        $this->dbRequest->clearSession();
        $view->setTemplate('dmnadmin/dmnrequest/add');
        return $view;
    }

    public function clearAction()
    {
        $this->dbRequest->clearCache();
        return $this->getResponse()->setContent(json_encode(true, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
    public function archiveAction()
    {
        $view = new ViewModel();
        $view->setTemplate('dmnadmin/dmnrequest/archive');
        return $view;
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

    public function getcountriesAction()
    {
        $view = new ViewModel();
        $view->setTerminal(true);
        $parameters = $this->getRequest()->getQuery();
        $response = $this->dbRequest->getCountries();
        $view->setVariable('response', $response);
        $view->setVariable('id', $parameters->get('id', ''));
        $view->setTemplate('dmnadmin/dmnrequest/country');
        return $view;

    }
    public function getcountryjsonAction()
    {

        $response = $this->dbRequest->getCountriesJson();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

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

        $response = $this->dbRequest->getOrganization();

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

        $response = $this->dbRequest->getExecutors();

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

        $view->setTemplate('dmnadmin/dmnrequest/show');

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
        return $this->redirect()->toRoute('dmnrequest', array('action' => 'index'));
    }
    public function sendmailAction(){

        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbRequest->setQueryParametrs($parameters);
        }

        $response = $this->dbRequest->sendMail();

        return $this->getResponse()->setContent($response);
    }
    /*Archve*/
    public function archreqAction()
    {
        $response = $this->getResponse();
        $this->dbRequest->requestToArchive();
        return $response;
    }
}
