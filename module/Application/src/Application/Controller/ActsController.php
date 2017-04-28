<?php
/**
 * Created by PhpStorm.
 * User: yastopchik
 * Date: 25.04.2017
 * Time: 19:45
 */

namespace Application\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Service\ActsService;

class ActsController extends AbstractActionController
{
    protected $actsService;

    public function __construct(ActsService $actsService)
    {
        $this->actsService = $actsService;
    }
    public function indexAction ()
    {
        $view = new ViewModel();
        $view->setTemplate("application/acts/index");
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
}