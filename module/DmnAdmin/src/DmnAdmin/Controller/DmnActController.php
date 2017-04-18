<?php
/**
 * Created by PhpStorm.
 * User: yastopchik
 * Date: 13.04.2017
 * Time: 21:41
 */

namespace DmnAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DmnAdmin\Service\DmnactService;

class DmnActController extends AbstractActionController
{
    protected $dbRequest;

    public function __construct(DmnactService $dbRequest)
    {
        $this->dbRequest = $dbRequest;
    }
    public function indexAction()
    {
        $view = new ViewModel();
        $view->setTemplate('dmnadmin/dmnact/index');
        return $view;
    }
    public function getactsAction()
    {
        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbRequest->setQueryParametrs($parameters);
        }

        $response = $this->dbRequest->getActs();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }
    public function editactAction()
    {

        $parameters = $this->getRequest()->getPost();

        if ($parameters) {

            $this->dbRequest->setPostParametrs($parameters);

            return $this->dbRequest->editSessionRequestValue();
        }
        return false;
    }
    public function getstatusAction()
    {

        $response = $this->dbRequest->getStatuses();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }
}