<?php

namespace DmnExecutor\Service;

use DmnAdmin\Service\DmnactService;
use Zend\Cache\Storage\Adapter\Filesystem;
use DmnExecutor\Options\GridOptionsInterface;

class DmnexactsService extends DmnactService
{
    /**
     * @param Zend\Cache\Storage\Adapter\Filesystem $cache
     */
    public function __construct(Filesystem $cache)
    {
        parent::__construct($cache);
    }
    /**
     *Set Options
     *@return options
     */
    public function setExactsOptions(GridOptionsInterface $options)
    {
        $this->options = $options;

        return $this;
    }
}