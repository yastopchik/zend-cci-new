<?php

namespace DoctrineORMModule\Proxy\__CG__\DmnDatabase\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class CciLifecycle extends \DmnDatabase\Entity\CciLifecycle implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', '' . "\0" . 'DmnDatabase\\Entity\\CciLifecycle' . "\0" . 'id', '' . "\0" . 'DmnDatabase\\Entity\\CciLifecycle' . "\0" . 'acceped', '' . "\0" . 'DmnDatabase\\Entity\\CciLifecycle' . "\0" . 'working', '' . "\0" . 'DmnDatabase\\Entity\\CciLifecycle' . "\0" . 'issuance', '' . "\0" . 'DmnDatabase\\Entity\\CciLifecycle' . "\0" . 'issued', '' . "\0" . 'DmnDatabase\\Entity\\CciLifecycle' . "\0" . 'suspended');
        }

        return array('__isInitialized__', '' . "\0" . 'DmnDatabase\\Entity\\CciLifecycle' . "\0" . 'id', '' . "\0" . 'DmnDatabase\\Entity\\CciLifecycle' . "\0" . 'acceped', '' . "\0" . 'DmnDatabase\\Entity\\CciLifecycle' . "\0" . 'working', '' . "\0" . 'DmnDatabase\\Entity\\CciLifecycle' . "\0" . 'issuance', '' . "\0" . 'DmnDatabase\\Entity\\CciLifecycle' . "\0" . 'issued', '' . "\0" . 'DmnDatabase\\Entity\\CciLifecycle' . "\0" . 'suspended');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (CciLifecycle $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setAcceped($acceped)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAcceped', array($acceped));

        return parent::setAcceped($acceped);
    }

    /**
     * {@inheritDoc}
     */
    public function getAcceped()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAcceped', array());

        return parent::getAcceped();
    }

    /**
     * {@inheritDoc}
     */
    public function setWorking($working)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setWorking', array($working));

        return parent::setWorking($working);
    }

    /**
     * {@inheritDoc}
     */
    public function getWorking()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getWorking', array());

        return parent::getWorking();
    }

    /**
     * {@inheritDoc}
     */
    public function setIssuance($issuance)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIssuance', array($issuance));

        return parent::setIssuance($issuance);
    }

    /**
     * {@inheritDoc}
     */
    public function getIssuance()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIssuance', array());

        return parent::getIssuance();
    }

    /**
     * {@inheritDoc}
     */
    public function setIssued($issued)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIssued', array($issued));

        return parent::setIssued($issued);
    }

    /**
     * {@inheritDoc}
     */
    public function getIssued()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIssued', array());

        return parent::getIssued();
    }

    /**
     * {@inheritDoc}
     */
    public function setSuspended($suspended)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSuspended', array($suspended));

        return parent::setSuspended($suspended);
    }

    /**
     * {@inheritDoc}
     */
    public function getSuspended()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSuspended', array());

        return parent::getSuspended();
    }

}
