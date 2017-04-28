<?php
/**
 * Created by PhpStorm.
 * User: yastopchik
 * Date: 25.04.2017
 * Time: 19:37
 */

namespace Application\Service;

use DmnAdmin\Service\DmnactService;
use Zend\Cache\Storage\Adapter\Filesystem;
use Application\Options\GridOptionsInterface;

class ActsService extends DmnactService
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
    public function setApplicationOptions(GridOptionsInterface $options)
    {
        $this->options = $options;

        return $this;
    }
}