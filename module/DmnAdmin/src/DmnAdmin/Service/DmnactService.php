<?php
/**
 * Created by PhpStorm.
 * User: yastopchik
 * Date: 13.04.2017
 * Time: 21:35
 */

namespace DmnAdmin\Service;

use DmnLog\Service\LogService;
use DmnDatabase\Service\Exception\RuntimeException;

class DmnactService
{
    /**
     *
     * @var $id
     */
    protected $id;
    /**
     *
     * @var $dbContent
     */
    protected $dbContent;
    /**
     *
     * @var $logger
     */
    protected $logger;
    /**
     *
     * @var $authUserId
     */
    protected $authUserId;
    /**
     *get All Acts
     * @param $id
     * @return content
     */
    public function getActs()
    {
        return $this->dbContent->getActs();
    }
    /**
     *
     * @return $dbContent
     */
    public function getDbContent(){

        return $this->dbContent;
    }
    /**
     *
     * @param $dbContent
     */
    public function setDbContent($dbContent){

        $this->dbContent = $dbContent;
    }
    /**
     *
     * @param LogService $logger
     */
    public function setLogger(LogService $logger)
    {
        $this->logger = $logger->getLogger();
    }

    /**
     *
     * @return $Logger
     */
    public function getLogger()
    {

        return $this->logger;
    }
}