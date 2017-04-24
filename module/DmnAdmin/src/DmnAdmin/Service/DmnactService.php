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
use DmnDatabase\Service\OrganizationService;
use Zend\Stdlib\Parameters;

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

    /**
     *
     * @var $dbOrganization
     */
    protected $dbOrganization;

    private $status = [
        '0'=>'Не действует',
        '1'=>'Действует'
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
     * @param OrganizationService $dbOrganization
     */
    public function setDbOrganization(OrganizationService $dbOrganization)
    {

        $this->dbOrganization = $dbOrganization;
    }

    /**
     *
     * @return $Organization
     */
    public function getDbOrganization()
    {

        return $this->dbOrganization;
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
    /**
     *Get List of Statuses
     * @return  data
     */
    public function getOrganization()
    {

        $response = $this->cache->getItem('get_actorganization');

        if (is_null($response)) {

            $response = array();

            $data = $this->dbOrganization->setIscci(0);

            $data = $this->dbOrganization->getOrgUsers(null, 'org.name', 'ASC')->getArrayResult();

            foreach ($data as $key => $row) {
                $response[$key]['id'] = $row['id'];
                $response[$key]['name'] = $row['name'];
            }

            $this->cache->setItem('get_actorganization', $response);
        }

        return $response;
    }
    /**
     *Edit Organization
     *@return true|false
     */
    public function editAct(){

        if($this->cache->hasItem('get_act')){
            $this->cache->removeItem('get_act');
        }
        $this->logger->info('Редактирование/Добавление Акта экспертизы -, пользователь -'.$this->authUserId);

        return $this->dbActService->editAct($this->data, $this->data['oper']);

    }
    public function setPostParametrs(Parameters $parametrs)
    {

        $data['numact'] = $parametrs->get('numact', null);
        $data['organization'] = $parametrs->get('organization', null);
        $data['countryrule'] = $parametrs->get('countryrule', null);
        $data['dateact'] = $parametrs->get('dateact', null);
        $data['dateduration'] = $parametrs->get('dateduration', null);
        $data['status'] = $parametrs->get('status', null);
        $data['hscode'] = $parametrs->get('hscode', null);
        $data['description'] = $parametrs->get('description', null);
        $data['criorigin'] = $parametrs->get('criorigin', null);
        $data['id'] = $parametrs->get('id', null);
        $data['oper']=$parametrs->get('oper', null);
        $this->data = $data;
    }
}