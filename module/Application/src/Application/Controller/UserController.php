<?php
namespace Application\Controller;

use ZfcUser\Controller\UserController as ZfcUserController;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\View\Model\ViewModel;

class UserController extends ZfcUserController
{
    
    /**
     * @todo Make this dynamic / translation-friendly
     * @var string
     */
    protected $failedLoginMessage = 'Ошибка авторизации. Попробуйте еще раз. Возможно ваш аккаунт заблокирован.';
	/**
	 * Login form
	 */
	public function loginAction()
	{
		if ($this->zfcUserAuthentication()->hasIdentity()) {			
			return $this->redirect()->toRoute($this->getUserService()->getRedirectRoute());
		}
	
		$request = $this->getRequest();
		$form    = $this->getLoginForm();
	
		if ($this->getOptions()->getUseRedirectParameterIfPresent() && $request->getQuery()->get('redirect')) {
			$redirect = $request->getQuery()->get('redirect');
		} else {
			$redirect = false;
		}
	
		if (!$request->isPost()) {
			return array(
					'loginForm' => $form,
					'redirect'  => $redirect,
					'enableRegistration' => $this->getOptions()->getEnableRegistration(),
			);
		}
	
		$form->setData($request->getPost());
	
		if (!$form->isValid()) {
			$this->flashMessenger()->setNamespace('zfcuser-login-form')->addMessage($this->failedLoginMessage);
			return $this->redirect()->toUrl($this->url()->fromRoute(static::ROUTE_LOGIN).($redirect ? '?redirect='. rawurlencode($redirect) : ''));
		}
	
		// clear adapters
		$this->zfcUserAuthentication()->getAuthAdapter()->resetAdapters();
		$this->zfcUserAuthentication()->getAuthService()->clearIdentity();
	
		return $this->forward()->dispatch(static::CONTROLLER_NAME, array('action' => 'authenticate'));
	}
    /**
     * General-purpose authentication action
     */
    public function authenticateAction()
    {    	
    	if ($this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute($this->getUserService()->getRedirectRoute());
        }        
        
        $adapter = $this->zfcUserAuthentication()->getAuthAdapter();
        $redirect = $this->params()->fromPost('redirect', $this->params()->fromQuery('redirect', false));

        $result = $adapter->prepareForAuthentication($this->getRequest());

        // Return early if an adapter returned a response
        if ($result instanceof Response) {
            return $result;
        }

        $auth = $this->zfcUserAuthentication()->getAuthService()->authenticate($adapter);

        if (!$auth->isValid()) {
            //$this->flashMessenger()->setNamespace('zfcuser-login-form')->addMessage($this->failedLoginMessage);
            //$adapter->resetAdapters();
            /*return $this->redirect()->toUrl(
                $this->url()->fromRoute(static::ROUTE_LOGIN) .
                ($redirect ? '?redirect='. rawurlencode($redirect) : '')
            );*/
			return array('error'=>array('message'=>$this->failedLoginMessage));
        }

        //$redirect = $this->redirectCallback;

        //return $redirect();
        //return $this->redirect()->toRoute($this->getUserService()->getRedirectRoute());
		return array('route'=>$this->getUserService()->getRedirectRoute());
    }
	public function changepasswordAction()
	{
		// if the user isn't logged in, we can't change password
		if (!$this->zfcUserAuthentication()->hasIdentity()) {
			// redirect to the login redirect route
			return $this->redirect()->toRoute($this->getOptions()->getLoginRedirectRoute());
		}
		$form = $this->getChangePasswordForm();
		$request=$this->getRequest();
		if($request->isPost()) {
			$form->setData($request->getPost());
			if (!$form->isValid()) {
				return $this->getResponse()->setContent(json_encode(array('jsonrpc'=>'2.0',
					'error'=>array('code'=>100, 'message'=>$form->getMessages())), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
			}
			if (!$this->getUserService()->changePassword($form->getData())) {
				return $this->getResponse()->setContent(json_encode(array('jsonrpc'=>'2.0',
					'error'=>array('code'=>100, 'message'=>'Что-то не так. Попробуете изменить пароль позже.')), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
			}
			return $this->getResponse()->setContent(json_encode(array('success'=>true), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		}
		$view=new ViewModel();
		$view->setTerminal(true);
		$view->setTemplate('application/user/changepassword');
		$view->setVariable('form', $form);
		return $view;
	}
}
