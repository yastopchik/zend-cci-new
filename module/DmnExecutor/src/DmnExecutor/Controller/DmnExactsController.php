<?php

namespace DmnExecutor\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DmnExecutor\Service\DmnexactsService;

class DmnExactsController extends AbstractActionController
{
    protected $actsService;

    public function __construct(DmnexactsService $actsService)
    {
        $this->actsService = $actsService;
    }
    public function indexAction ()
    {
        $view = new ViewModel();
        $view->setTemplate("dmnexecutor/dmnexacts/index");
        return $view;
    }
    public function getactnumbersAction()
    {
        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->actsService->setQueryParametrs($parameters);
        }

        $response = $this->actsService->getActNumbers();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }
    public function getactsAction()
    {
        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->actsService->setQueryParametrs($parameters);
        }

        $response = $this->actsService->getActs();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
    public function getstatusAction()
    {

        $response = $this->actsService->getStatuses();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }
    public function getorgAction()
    {

        $response = $this->actsService->getOrganization();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }
    public function editactnumberAction()
    {

        $parameters = $this->getRequest()->getPost();

        if ($parameters) {

            $this->actsService->setPostParametrs($parameters);

            return $this->actsService->editActNumber();
        }
        return false;
    }
    public function editactAction()
    {
        $actn = (int) $this->params()->fromQuery('actn', 0);

        if (is_int($actn)&&!is_null($actn)) {

            $parameters = $this->getRequest()->getPost();

            if($parameters){

                $this->actsService->setPostParametrs($parameters);

                return $this->actsService->editAct($actn);
            }
        }
        return false;

    }
}