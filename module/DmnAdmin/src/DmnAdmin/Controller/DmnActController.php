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
    protected $dbAct;

    public function __construct(DmnactService $dbAct)
    {
        $this->dbAct = $dbAct;
    }
    public function indexAction()
    {
        $view = new ViewModel();
        $view->setTemplate('dmnadmin/dmnact/index');
        return $view;
    }
    public function getactnumbersAction()
    {
        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbAct->setQueryParametrs($parameters);
        }

        $response = $this->dbAct->getActNumbers();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }
    public function editactnumberAction()
    {

        $parameters = $this->getRequest()->getPost();

        if ($parameters) {

            $this->dbAct->setPostParametrs($parameters);

            return $this->dbAct->editActNumber();
        }
        return false;
    }
    public function editactAction()
    {
        $actn = (int) $this->params()->fromQuery('actn', 0);

        if (is_int($actn)&&!is_null($actn)) {

            $parameters = $this->getRequest()->getPost();

            if($parameters){

                $this->dbAct->setPostParametrs($parameters);

                return $this->dbAct->editAct($actn);
            }
        }
        return false;

    }
    public function getactsAction()
    {
        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbAct->setQueryParametrs($parameters);
        }

        $response = $this->dbAct->getActs();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
    public function getstatusAction()
    {

        $response = $this->dbAct->getStatuses();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }
    public function getorgAction()
    {

        $response = $this->dbAct->getOrganization();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }
}