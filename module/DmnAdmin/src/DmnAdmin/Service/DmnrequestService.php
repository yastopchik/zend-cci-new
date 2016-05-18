<?php

namespace DmnAdmin\Service;

use Zend\Cache\Storage\Adapter\Filesystem;
use DmnDatabase\Service\RequestService;
use DmnDatabase\Service\PriorityService;
use DmnDatabase\Service\StatusService;
use DmnDatabase\Service\LifecycleService;
use DmnDatabase\Service\FormsService;
use DmnDatabase\Service\UserService;
use DmnDatabase\Service\CountryService;
use DmnDatabase\Service\OrganizationService;
use DmnLog\Service\LogService;
use DmnAdmin\Options\GridOptionsInterface;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use Zend\Stdlib\Parameters;
use Zend\Session\Container;
use Zend\Cache\Storage\FlushableInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;

class DmnrequestService implements EventManagerAwareInterface
{
    use EventManagerAwareTrait;
    /**
     *
     * @var $id
     */
    protected $id;
    /**
     *
     * @var $rows
     */
    // get index row - i.e. user click to sort
    protected $rows;
    /**
     *
     * @var $page
     */
    // get the requested page
    protected $page;
    /**
     *
     * @var $data
     */
    protected $data = array();
    /**
     *
     * @var $dbRequest
     */
    protected $dbRequest;
    /**
     *
     * @var $options
     */
    protected $options;
    /**
     *
     * @var $dbPriority
     */
    protected $dbPriority;
    /**
     *
     * @var $dbStatus
     */
    protected $dbStatus;
    /**
     *
     * @var $lifecycle
     */
    protected $dbLifecycle;
    /**
     *
     * @var $forms
     */
    protected $dbForms;
    /**
     *
     * @var $dbUser
     */
    protected $dbUser;
    /**
     *
     * @var $dbCountry
     */
    protected $dbCountry;
    /**
     *
     * @var $dbOrganization
     */
    protected $dbOrganization;
    /**
     *
     * @var $authUserId
     */
    protected $authUserId;
    /**
     *
     * @var $authRoleId
     */
    protected $authRoleId;
    /**
     *
     * @var $storageSession
     */
    protected $storageSession;
    /**
     *
     * @var $session
     */
    protected $session;
    /**
     *
     * @var $logger
     */
    protected $logger;
    /**
     *
     * @param RequestService $serviceLocator
     */
    private $mapperRequest;
    /**
     *
     * @var $cache
     */
    protected $cache;

    /**
     * @param Zend\Cache\Storage\Adapter\Filesystem $cache
     */
    public function __construct(Filesystem $cache)
    {
        $this->cache = $cache;
    }

    /**
     *Clear Cache
     */
    public function clearCache()
    {
        if ($this->cache instanceof FlushableInterface) {
            $this->cache->flush();
        }
    }

    /**
     *
     * @param RequestService $dbRequest
     */
    public function setDbRequest(RequestService $dbRequest)
    {

        $this->dbRequest = $dbRequest;
    }

    /**
     *
     * @return $dbRequest
     */
    public function getDbRequest()
    {

        return $this->dbRequest;
    }

    /**
     *
     * @return $dbUser
     */
    public function getDbUser()
    {

        return $this->dbUser;
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
     *
     * @param CountryService $dbCountry
     */
    public function setDbCountry(CountryService $dbCountry)
    {

        $this->dbCountry = $dbCountry;
    }

    /**
     *
     * @return $Country
     */
    public function getDbCountry()
    {

        return $this->dbCountry;
    }

    /**
     *
     * @param UserService $dbUser
     */
    public function setDbUser(UserService $dbUser)
    {

        $this->dbUser = $dbUser;
    }

    /**
     *
     */
    public function getRole()
    {

        return $this->authRoleId;
    }

    /**
     * set RoleId
     */
    public function setRole($authRole)
    {

        $this->authRoleId = $authRole;
    }

    /**
     *
     */
    public function getAuth()
    {

        return $this->authUserId;
    }

    /**set UserId
     *
     */
    public function setAuth($authUser)
    {

        $this->authUserId = $authUser;
    }

    /**
     *
     * @param Container $session
     */
    public function setDbSession(\DmnAdmin\Storage\StorageInterface $storageSession)
    {

        $this->storageSession = $storageSession;
        $this->session = $this->storageSession->getSession();
    }

    /**
     *
     * @param PriorityService $dbPriority
     */
    public function setDbPriority(PriorityService $dbPriority)
    {

        $this->dbPriority = $dbPriority;
    }

    /**
     *
     * @param StatusService $dbStatus
     */
    public function setDbStatus(StatusService $dbStatus)
    {

        $this->dbStatus = $dbStatus;
    }

    /**
     *
     * @param LifecycleService $dbLifecycle
     */
    public function setDbLifecycle(LifecycleService $dbLifecycle)
    {

        $this->dbLifecycle = $dbLifecycle;
    }

    /**
     *
     * @param FormsService $dbForms
     */
    public function setDbForms(FormsService $dbForms)
    {

        $this->dbForms = $dbForms;
    }

    /**
     *Get Options
     * @return options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     *Set Options
     * @return options
     */
    public function setOptions(GridOptionsInterface $options)
    {
        $this->options = $options;

        return $this;
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
     *Set Date
     */
    public function setDate(\DateTime $date)
    {

        $this->date = $date;
    }

    /**
     *
     */
    public function getDate()
    {

        return $this->Date;
    }

    /**
     *Edit RequestsNumber from data
     * @return true|false
     */
    public function editRequestNumber()
    {
        $this->logger->info('Редактирование заявки -' . $this->data['id'] . ', пользователь -' . $this->authUserId);
        return $this->dbRequest->editRequestNumber($this->data, $this->dbRequest->getStatusByRequestId($this->data['id'])->getSingleScalarResult());
    }

    /**
     *Edit RequestsDescription from data
     * @return true|false
     */
    public function editRequestDescription()
    {
        $this->logger->info('Редактирование дополнительной информации по заявке -' . $this->data['id'] . ', пользователь -' . $this->authUserId);
        return $this->dbRequest->editRequestDescription($this->data);

    }

    /**
     *Edit Requests from data
     * @return true|false
     */
    public function editRequest()
    {
        $this->logger->info('Редактирование инф. по заявке -' . $this->data['id'] . ', пользователь -' . $this->authUserId);
        return $this->dbRequest->editRequest($this->data);

    }

    public function fillXmlUnloading($value, $date)
    {
        return $this->dbRequest->fillXmlUnloading($value, $date);
    }

    /**
     * Get Request With Parameters
     */
    public function getRequestNumberWithParameters($data = array())
    {
        //Если потребуется сортировка ,передавать массив дата и в нем выбирать data['sord'] И data['sidx']
        if (isset($this->data['_search']) && ($this->data['_search']) && !empty($this->data['filters']))
            $search = $this->data['filters'];
        else
            $search = null;

        $this->dbRequest->setAuth($this->authUserId);

        $this->dbRequest->setRole($this->authRoleId);

        $data = $this->dbRequest->getRequestNumber($search);

        return $data;
    }

    /**
     *Get List of RequestsNumber from data
     * @return  paginator
     */
    public function getRequestNumber()
    {
        $data = $this->getRequestNumberWithParameters();

        $adapter = new DoctrineAdapter(new ORMPaginator($data));

        $paginator = new Paginator($adapter);

        $paginator->setCurrentPageNumber((int)$this->page)
            ->setItemCountPerPage((int)$this->rows)
            ->setPageRange(5);

        $response = $this->convertPanginationToResponce($paginator, $this->options->getRequestNumberOptions());

        return $response;

    }

    /**
     *Get List of RequestsNumber by Data
     * @return  array
     */
    public function getRequestNumbersByDate()
    {

        //Пока предусмотрена выгрузка только Могилевского Филиала

        if (is_null($this->date))
            $this->date = new \DateTime('Now');

        return $this->dbRequest->getRequestNumbersByDate($this->date)->getArrayResult();

    }

    /**
     *Get List of Requests by id RequestNumber
     * @return  paginator
     */
    public function getRequest()
    {

        if ($this->id != 0) {

            $data = $this->dbRequest->getRequestByRequestId($this->id);

            $adapter = new DoctrineAdapter(new ORMPaginator($data));

            $paginator = new Paginator($adapter);

            $paginator->setCurrentPageNumber((int)$this->page)
                ->setItemCountPerPage((int)$this->rows)
                ->setPageRange(5);
            $response = $this->convertPanginationToResponce($paginator, $this->options->getRequestOptions(), true);

        } else {
            $response = array();
        }
        return $response;
    }

    /**
     *Get List of RequestsDescription by id RequestID
     * @return  paginator
     */
    public function getRequestDescription()
    {

        if ($this->id != 0) {

            $data = $this->dbRequest->getRequestDescriptionByRequestId($this->id);

            $adapter = new DoctrineAdapter(new ORMPaginator($data));

            $paginator = new Paginator($adapter);

            $paginator->setCurrentPageNumber((int)$this->page)
                ->setItemCountPerPage((int)$this->rows)
                ->setPageRange(5);
            $response = $this->convertPanginationToResponce($paginator, $this->options->getRequestDescriptionOptions());
        } else {
            $response = array();
        }
        return $response;

    }

    /**
     * Send Mail Function
     */
    public function sendMail()
    {
        $data = $this->getRequestNumberWithParameters()->getResult();
        if (is_array($data) && count($data) != 0) {
            $this->getEventManager()->trigger('send_mail', $this, $data);
            return array('success'=>true);
        }
        return array('error'=>true);
    }

    /*Session
     --------------------------------------------------------------------------------*/
    /**
     *Clear Session
     */
    public function clearSession()
    {

        $this->storageSession->clear();
        //unset($_SESSION['Request_Add']);
    }

    /**
     *Get Empty List of Requests
     * @return  paginator
     */
    public function getRequestForAdd()
    {

        return $this->getResponseFromRequestOption($this->options->getRequestOptions());

    }

    /**
     *Get Empty List of RequestsDesc
     * @return  paginator
     */
    public function getRequestDescForAdd()
    {

        if (isset($this->session->rd) && (!empty($this->session->rd))) {

            return $this->getResponseFromRequestDescOption($this->options->getRequestDescriptionOptions());

        } else {
            return '';

        }
    }

    /**
     *Edit Session Requests from data at Add
     * @return true|false
     */
    public function editSessionRequestValue()
    {

        $value = $this->data['value'];
        $ses = 'req_' . $this->data['id'];
        $name = $this->session->$ses;
        if (!empty($value)) {
            $this->session->$ses = $value;
            return true;
        } else {
            return false;
        }
    }

    /**
     *Edit Session RequestsDesc from data at Add
     * @return true|false
     */
    public function editSessionRequestDescValue()
    {

        $options = $this->options->getRequestDescriptionOptions();
        //addition
        if ((isset($this->data['oper']) && (strcmp($this->data['oper'], 'add') == 0))) {
            if (isset($this->session->rd) && (!empty($this->session->rd))) {
                $key = count($this->session->rd);
            } else {
                $key = 0;
                $this->session->rd = array();
            }
            $this->session->rd[$key] = array();
        } elseif (isset($this->data['oper']) && (strcmp($this->data['oper'], 'edit') == 0)) {
            $key = $this->data['id'];
        }
        foreach ($options as $keysOptions => $valueOptions) {
            foreach ($valueOptions as $keysOptions => $valueOptions) {
                if (array_key_exists($keysOptions, $this->data) && (strcmp($keysOptions, 'id') != 0)) {
                    $this->session->rd[$key][$keysOptions] = $this->data[$keysOptions];
                }
            }
        }
        return true;
    }

    /**
     *Save Requests from data
     * @return true|false
     */
    public function SaveRequestFromSession()
    {
        $this->logger->info('Сохранение заявки из Сессии, пользователь -' . $this->authUserId);
        $data = array();
        if (!is_null($this->id)) {
            $userId = intval($this->id);
            $executorId = $this->authUserId;
        } else {
            $userId = $this->authUserId;
            $executorId = $this->dbUser->getDistributorsByUserId($this->authUserId);
        }
        if (isset($this->session->rd) && (!empty($this->session->rd))) {
            $data['rd'] = $this->getResponseFromRequestDescOption($this->options->getRequestDescriptionOptions());
            $data['rq'] = $this->getResponseFromSessionNotRotate($this->options->getRequestOptions());
            $data['rn'] = array('rows' => array(0 => array('id' => '0', 'cell' => array(4 => '', 7 => $userId, 9 => $executorId))));
            if (isset($this->id) && is_int($this->id))
                $data['UserId'] = $this->id;
        }
        $save = $this->dbRequest->saveRequest($data);
        if ($save) {
            $this->storageSession->clear();
            return 'Заявка принята!';
        } else {
            return 'Ошибки при выполнении операции';
        }

    }

    /**
     *convertOptionsToResponde
     * @param options
     * @return data
     */
    public function getResponseFromRequestOption(array $options, $response = array())
    {
        $i = 0;
        foreach ($options as $keysOptions => $valueOptions) {
            foreach ($valueOptions as $keys => $value) {
                $response['rows'][$i]['id'] = $i;
                $response['rows'][$i]['cell'] = array();
                array_push($response['rows'][$i]['cell'], $value);
                array_push($response['rows'][$i]['cell'], '');
                $ses = 'req_' . $i;
                $this->session->$ses = '';
                $i++;
            }
        }
        return $response;
    }

    /**
     *convertOptionsToResponde
     * @param options
     * @return data
     */
    public function getResponseFromSessionNotRotate(array $options, $response = array())
    {
        $response['rows'][0]['id'] = 0;
        $response['rows'][0]['cell'] = array();
        $i = 0;
        foreach ($options as $keysOptions => $valueOptions) {
            foreach ($valueOptions as $keys => $value) {
                $ses = 'req_' . $i;
                array_push($response['rows'][0]['cell'], $this->session->$ses);
                $i++;
            }
        }
        return $response;
    }

    /**
     *convertRequestDescOptionToResponde from Session
     * @param options
     * @return data
     */
    public function getResponseFromRequestDescOption(array $options, $response = array())
    {
        foreach ($options as $keysOptions => $valueOptions) {
            foreach ($this->session->rd as $keysRd => $valueRd) {
                $response['rows'][$keysRd]['id'] = $keysRd;
                $response['rows'][$keysRd]['cell'] = array();
                array_push($response['rows'][$keysRd]['cell'], $keysRd + 1);
                foreach ($valueRd as $keysRdi => $valueRdi) {
                    if (array_key_exists($keysRdi, $valueOptions)) {
                        array_push($response['rows'][$keysRd]['cell'], $valueRdi);

                    }
                }
            }
        }
        return $response;
    }
    /*--------------------------------------------------------------------------------*/
    /**
     *convertPanginationToResponde
     * @param Paginator paginator,  options, rotate=false
     * @return data
     */
    public function convertPanginationToResponce(Paginator $paginator, array $options, $rotate = false, $response = array())
    {

        $response['records'] = $paginator->count();
        $response['page'] = $this->page;
        $response['total'] = ceil($paginator->getTotalItemCount() / $this->rows);
        $i = 0;
        foreach ($paginator as $key => $row) {
            if (!$rotate) {
                $response['rows'][$key]['id'] = $row['id'];
                $response['rows'][$key]['cell'] = array();
                foreach ($row as $keys => $value) {
                    if (array_key_exists($keys, $options['options'])) {
                        if ($value instanceof \DateTime) {
                            $value = $value->format('d/m/Y');
                        }
                        array_push($response['rows'][$key]['cell'], stripslashes($value));
                    }
                }
            } else {
                foreach ($row as $keys => $value) {
                    if (array_key_exists($keys, $options['options'])) {
                        $response['rows'][$i]['id'] = $i;
                        $response['rows'][$i]['cell'] = array();
                        if ($value instanceof \DateTime) {
                            $value = $value->format('d.m.Y');
                        }
                        array_push($response['rows'][$i]['cell'], $options['options'][$keys]);
                        array_push($response['rows'][$i]['cell'], stripslashes($value));
                        array_push($response['rows'][$i]['cell'], $row['id']);
                        $i++;
                    }
                }
            }
        }
        return $response;
    }

    /**
     * Set Query parametrs into the varibles
     * @var Zend\Stdlib\Parameters parametrs
     */
    public function setQueryParametrs(Parameters $parametrs)
    {

        $this->page = $parametrs->get('page', '');
        $this->rows = $parametrs->get('rows', '');
        $this->id = $parametrs->get('id', null);
        $this->data['filters'] = $parametrs->get('filters', null);
        $this->data['_search'] = $parametrs->get('_search', false);
        $this->data['sidx'] = $parametrs->get('sidx', 'id');
        $this->data['sord'] = $parametrs->get('sord', 'asc');

    }

    /**
     * Set Post parametrs into the varibles
     * @var Zend\Stdlib\Parameters parametrs
     */
    public function setPostParametrs(Parameters $parametrs)
    {

        $data['dateorder'] = $parametrs->get('dateorder', null);
        $data['executor'] = $parametrs->get('executor', null);
        $data['priority'] = $parametrs->get('priority', null);
        $data['numdoplist'] = $parametrs->get('numdoplist', null);
        $data['status'] = $parametrs->get('status', null);
        $data['workorder'] = $parametrs->get('workorder', null);
        $data['destinationiso'] = $parametrs->get('destinationiso', null);
        $data['numblank'] = $parametrs->get('numblank', null);
        $data['forms'] = $parametrs->get('forms', null);
        $data['id'] = $parametrs->get('id', null);
        $data['description'] = $parametrs->get('description', null);
        $data['hscode'] = $parametrs->get('hscode', null);
        $data['invoce'] = $parametrs->get('invoce', null);
        $data['paragraph'] = $parametrs->get('paragraph', null);
        $data['quantity'] = $parametrs->get('quantity', null);
        $data['seats'] = $parametrs->get('seats', null);
        $data['unit'] = $parametrs->get('unit', null);
        $data['value'] = $parametrs->get('value', null);
        $data['oper'] = $parametrs->get('oper', null);
        $data['idreq'] = $parametrs->get('idreq', null);
        $this->data = $data;
    }

    /**
     *Get of getCountryByRequestId
     * @return  data
     */
    public function getCountryRequestNumber()
    {

        $data = $this->dbRequest->getRequestNumberById($this->id)->getArrayResult();

        $response = array();

        foreach ($data as $key => $row) {
            if (!is_null($row['destinationiso']))
                return true;
        }

        return false;

    }

    /**
     *Get List of getCountries
     * @return  data
     */
    public function getOrganization()
    {

        $response = $this->cache->getItem('get_organization');

        if (is_null($response)) {

            $response = array();

            $data = $this->dbOrganization->setIscci(1);

            $data = $this->dbOrganization->getOrgUsers()->getArrayResult();

            foreach ($data as $key => $row) {
                $response[$key]['id'] = $row['id'];
                $response[$key]['name'] = $row['name'];
            }

            $this->cache->setItem('get_organization', $response);
        }

        return $response;

    }

    /**
     *Get List of getCountries
     * @return  data
     */
    public function getCountries()
    {

        $response = $this->cache->getItem('get_countries');

        if (is_null($response)) {

            $response = array();

            $data = $this->dbCountry->getCountries()->getArrayResult();

            foreach ($data as $key => $row) {
                $response[$key]['id'] = $row['id'];
                $response[$key]['nameru'] = $row['nameru'] . '(' . $row['iso'] . ')';
            }

            $this->cache->setItem('get_countries', $response);
        }

        return $response;
    }
    public function getCountriesJson()
    {

        $response = $this->cache->getItem('get_countries_json');

        if (is_null($response)) {

            $response = array();

            $data = $this->dbCountry->getCountries()->getArrayResult();

            foreach ($data as $key => $row) {
                $response[$row['id']] = $row['nameru'];
            }

            $this->cache->setItem('get_countries_json', $response);
        }

        return $response;
    }

    /**
     *Get of getCountryById
     * @return  data
     */
    public function getCountryById()
    {

        $response = false;

        if (!empty($this->id)) {

            $response = $this->cache->getItem('get_countries' . $this->id);

            if (is_null($response)) {

                $data = $this->dbRequest->getCountryById($this->id);

                foreach ($data as $key => $row) {
                    $response[$key]['id'] = $row['id'];
                    $response[$key]['nameru'] = $row['nameru'];
                }

                $this->cache->setItem('get_countries' . $this->id, $response);
            }
        }
        return $response;
    }

    /**
     *Get of getCountryByName
     * @return  data
     */
    public function getCountryByName()
    {

        $response = false;

        if (!empty($this->rows)) {

            $data = $this->dbRequest->getCountryByNameRu($this->rows);

            foreach ($data as $key => $row) {
                $response[$key]['id'] = $row['id'];
                $response[$key]['nameru'] = $row['nameru'];
            }
        }
        return $response;
    }

    /**
     *Get of getLifeCycle by Id
     * @return  data
     */
    public function getLifeCycle()
    {

        $data = $this->dbLifecycle->getLifecycleByLifecycleId($this->id)->getArrayResult();

        $response = array();

        foreach ($data as $key => $row) {
            $response[$key]['id'] = $row['id'];
            $response[$key]['acceped'] = $row['acceped'];
            $response[$key]['working'] = $row['working'];
            $response[$key]['issuance'] = $row['issuance'];
            $response[$key]['proceed'] = $row['proceed'];
            $response[$key]['duplicate'] = $row['duplicate'];
            $response[$key]['exchange'] = $row['exchange'];
            $response[$key]['notindemand'] = $row['notindemand'];
            $response[$key]['damaged'] = $row['damaged'];
            $response[$key]['suspended'] = $row['suspended'];
            $response[$key]['nodocuments'] = $row['nodocuments'];
        }

        return $response;

    }

    /**
     *Get List of Priorities
     * @return  data
     */
    public function getPriorities()
    {

        $response = $this->cache->getItem('get_priorities');

        if (is_null($response)) {
            $data = $this->dbPriority->getPriorities()->getArrayResult();

            $response = array();
            foreach ($data as $key => $row) {
                $response[$key]['id'] = $row['id'];
                $response[$key]['priority'] = $row['priority'];
            }
            $this->cache->setItem('get_priorities', $response);
        }

        return $response;

    }

    /**
     *Get Forms
     * @return  data
     */
    public function getForms()
    {

        $response = $this->cache->getItem('get_forms');

        if (is_null($response)) {

            $data = $this->dbForms->getForms()->getArrayResult();

            $response = array();
            foreach ($data as $key => $row) {
                $response[$key]['id'] = $row['id'];
                $response[$key]['forms'] = $row['forms'];
            }
            $this->cache->setItem('get_forms', $response);
        }

        return $response;
    }

    /**
     *Get List of Statuses
     * @return  data
     */
    public function getStatuses()
    {

        $response = $this->cache->getItem('get_statuses');

        if (is_null($response)) {

            $data = $this->dbStatus->getStatuses()->getArrayResult();

            $response = array();
            foreach ($data as $key => $row) {
                $response[$key]['id'] = $row['id'];
                $response[$key]['status'] = $row['status'];
            }
            $this->cache->setItem('get_statuses', $response);
        }

        return $response;
    }

    /**
     *Get List of Executers
     * @return  data
     */
    public function getExecutors()
    {

        $data = $this->dbUser->setIscci(1);

        $data = $this->dbUser->getUserByOrgId($this->id)->getArrayResult();

        $response = array();

        foreach ($data as $key => $row) {
            $response[$key]['id'] = $row['id'];
            $response[$key]['executor'] = $row['executor'];
        }

        return $response;

    }

    /**
     *Get List of getCountries
     * @return  data
     */
    public function getOrganizationForEx()
    {

        $response = array();

        if (!is_null($this->id) && ($this->id != 0)) {

            $response = $this->cache->getItem('get_execorganization');

            if (is_null($response)) {

                $data = $this->dbOrganization->setIscci(0);

                $data = $this->dbOrganization->getOrgUsers(null, 'org.name', 'ASC')->getArrayResult();

                foreach ($data as $key => $row) {

                    $response[$key]['id'] = stripslashes($row['id']);
                    $response[$key]['name'] = stripslashes($row['name']);
                }

                $this->cache->setItem('get_execorganization', $response);
            }
        } else {
            $response[0]['organization'] = 'Необходимо выбрать организацию';
            $response[0]['name'] = '';
        }

        return $response;

    }

    /**
     *Get List of Executers
     * @return  data
     */
    public function getExecutorsForEx()
    {

        $response = array();

        $data = $this->dbUser->setIscci(0);

        $data = $this->dbUser->getUserByOrgId($this->id)->getArrayResult();

        foreach ($data as $key => $row) {
            $response[$key]['id'] = $row['id'];
            $response[$key]['executor'] = $row['executor'];
        }

        return $response;

    }
    public function requestToArchive()
    {
        return $this->dbRequest->requestToArchive();
    }

}

?>