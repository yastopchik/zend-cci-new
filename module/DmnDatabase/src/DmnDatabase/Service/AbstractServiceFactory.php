<?php
namespace DmnDatabase\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DmnDatabase\Service\ArrayHelper;

abstract class AbstractServiceFactory implements FactoryInterface {

	/**
	 *
	 * @var ServiceLocatorInterface
	 */
	protected $serviceLocator;

	/**
	 *
	 * @param ServiceLocatorInterface $serviceLocator        	
	 */
	private function initialize(ServiceLocatorInterface $serviceLocator) {
		$this->serviceLocator = $serviceLocator;
	}

	/**
	 *
	 * @return \Zend\ServiceManager\ServiceLocatorInterface
	 */
	protected function getServiceLocator() {
		return $this->serviceLocator;
	}

	/**
	 *
	 * @param string $name        	
	 * @throws Exception\RuntimeException
	 * @return mixed
	 */
	protected function getConfig($name = null) {
		$config = $this->getServiceLocator()->get('Config');
		if (empty($config)) {
			throw new Exception\RuntimeException(sprintf('Failed to load config section in %s', __CLASS__));
		}
		if (null !== $name) {
			$value = ArrayHelper::multiKeyGet($config, $name, '.');
			if (null === $value) {
				throw new Exception\RuntimeException(sprintf('Failed to get config section "%s" in %s', $name, __CLASS__));
			}
			return $value;
		} else {
			return $config;
		}
	}
	
	/**
	 * 
	 * @param string $name
	 * @return boolean
	 */
	protected function hasConfig($name) {
		$config = $this->getConfig();
		return ArrayHelper::multiKeyExists($config, $name, '.');
	}

	/**
	 * (non-PHPdoc)
	 * 
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 */
	public function createService(ServiceLocatorInterface $serviceLocator) {
		$this->initialize($serviceLocator);
		return $this->create();
	}

	abstract protected function create();

}

?>