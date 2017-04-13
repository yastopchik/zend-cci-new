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
    protected $dbContent;

    public function __construct(DmnactService $dbContent)
    {
        $this->dbContent = $dbContent;
    }
    public function indexAction()
    {
        $view = new ViewModel();
        $view->setTemplate('dmnact/dmnact/index');
        return $view;
    }
    public function getactsAction()
    {
        $parameters = $this->getRequest()->getQuery();

        if ($parameters) {
            $this->dbRequest->setQueryParametrs($parameters);
        }

        $response = $this->dbRequest->getRequestNumber();

        return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    }
}