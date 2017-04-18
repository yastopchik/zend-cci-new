<?php
/**
 * Created by PhpStorm.
 * User: yastopchik
 * Date: 13.04.2017
 * Time: 21:35
 */

namespace DmnAdmin\Service;

use DmnLog\Service\LogService;
use Zend\Cache\Storage\Adapter\Filesystem;

class DmnactService
{
    const STATUS_ACTIVE = 1;

    const STATUS_DRAFT = 0;

    /**
     *
     * @var $id
     */
    protected $id;
    /**
     *
     * @var $dbActService
     */
    protected $dbActService;
    /**
     *
     * @var $logger
     */
    protected $logger;
    /**
     *
     * @var $cache
     */
    protected $cache;
    /**
     *
     * @var $authUserId
     */
    protected $authUserId;

    private $status = [
        '0'=>'Не действует',
        '1'=>'Действует',
    ];


    /**
     * @param Zend\Cache\Storage\Adapter\Filesystem $cache
     */
    public function __construct(Filesystem $cache)
    {
        $this->cache = $cache;
    }
    /**
     *get All Acts
     * @param $id
     * @return content
     */
    public function getActs()
    {
        return $this->dbActService->getActs();
    }
    /**
     *
     * @return $dbContent
     */
    public function getDbActService(){

        return $this->dbActService;
    }
    /**
     *
     * @param $dbActService
     */
    public function setDbActService($dbActService){

        $this->dbActService = $dbActService;
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
    /**
     *Get List of Statuses
     * @return  data
     */
    public function getStatuses()
    {

        $response = $this->cache->getItem('get_actstatuses');

        if (is_null($response)) {

            $data = $this->status;

            $response = [];
            foreach ($data as $key => $value) {
                $response[$key]['id'] = $key;
                $response[$key]['status'] = $value;
            }
            $this->cache->setItem('get_actstatuses', $response);
        }

        return $response;
    }
}