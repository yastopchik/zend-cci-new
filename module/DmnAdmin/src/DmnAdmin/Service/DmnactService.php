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
use Zend\Paginator\Paginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use DmnAdmin\Options\GridOptionsInterface;


class DmnactService
{
    use \DmnAdmin\Object\ResponseTrait;

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
        '4'=>'Действует',
        '12'=>'Не действует'
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
    public function getActNumbers()
    {
        if(isset($this->data['_search']) && ($this->data['_search'])   && !empty($this->data['filters']))
            $search=$this->data['filters'];
        else
            $search=null;
        
        $data = $this->dbActService->getActNumbers();

        $adapter = new DoctrineAdapter(new ORMPaginator($data));

        $paginator = new Paginator($adapter);

        $paginator->setCurrentPageNumber((int)$this->page)
            ->setItemCountPerPage((int)$this->rows)
            ->setPageRange(5);

        $response=$this->convertPanginationToResponce($paginator, $this->options->getActNumberOptions());

        return $response;
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
     *Get Options
     *@return options
     */
    public function getOptions()
    {
        return $this->options;
    }
    /**
     *Set Options
     *@return options
     */
    public function setOptions(GridOptionsInterface $options)
    {
        $this->options = $options;

        return $this;
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
            $i = 0;
            foreach ($data as $key => $value) {
                $response[$i]['id'] = $key;
                $response[$i]['status'] = $value;
                $i++;
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
     *Edit ActNumber
     *@return true|false
     */
    public function editActNumber()
    {

        $this->logger->info('Редактирование/Добавление Акта экспертизы -, пользователь -'.$this->authUserId);

        return $this->dbActService->editActNumber($this->data, $this->data['oper']);

    }
    /**
     *Edit ActNumber
     *@return true|false
     */
    public function editAct($actn)
    {
        $this->logger->info('Редактирование/Добавление Данных в акт -'.$this->authUserId);

        $this->data['actid']=$actn;

        return $this->dbActService->editAct($this->data, $this->data['oper']);

    }
    /**
     *Get List of Acts by id actID
     * @return  paginator
     */
    public function getActs()
    {

        if ($this->id != 0) {

            $data = $this->dbActService->getActByActnumberId($this->id);

            $adapter = new DoctrineAdapter(new ORMPaginator($data));

            $paginator = new Paginator($adapter);

            $paginator->setCurrentPageNumber((int)$this->page)
                ->setItemCountPerPage((int)$this->rows)
                ->setPageRange(5);
            $response = $this->convertPanginationToResponce($paginator, $this->options->getActOptions());
        } else {
            $response = array();
        }
        return $response;

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