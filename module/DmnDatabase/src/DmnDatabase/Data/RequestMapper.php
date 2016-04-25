<?php
namespace DmnDatabase\Data;

use DmnDatabase\Mapper\AbstractMapper;
use Exception;
use Doctrine\ORM\QueryBuilder;

class RequestMapper extends AbstractMapper implements RequestMapperInterface
{

    protected $roleId = 2;
    /**
     * @dependency_table CciCountry
     */
    private $entityNameCountry = 'DmnDatabase\Entity\CciCountry';
    /**
     * @dependency_table CciLifecycle
     */
    private $entityNameLifecycle = 'DmnDatabase\Entity\CciLifecycle';
    /**
     * @dependency_table CciStatus
     */
    private $entityNameStatus = 'DmnDatabase\Entity\CciStatus';
    /**
     * @dependency_table CciPriority
     */
    private $entityNamePriority = 'DmnDatabase\Entity\CciPriority';
    /**
     * @dependency_table CciRequest
     */
    private $entityNameRequest = 'DmnDatabase\Entity\CciRequest';
    /**
     * @dependency_table CciRequestDescription
     */
    private $entityNameRequestDescription = 'DmnDatabase\Entity\CciRequestDescription';
    /**
     * @dependency_table CciForms
     */
    private $entityNameForms = 'DmnDatabase\Entity\CciForms';
    /**
     * @dependency_table CciXmlUnloading
     */
    private $entityNameXmlUnloading = 'DmnDatabase\Entity\CciXmlUnloading';
    /**
     * @dependency_table CciStatistics
     */
    private $entityNameStatistic = 'DmnDatabase\Entity\CciStatistic';

    /**
     *
     * @param int $requestId
     * @return mixed | NULL
     */
    public function getRequestDescriptionByRequestId($requestId)
    {

        $em = $this->doctrineEntity;
        $query = $em->createQueryBuilder()
            ->from($this->entityNameRequestDescription, 'rd')
            ->select("rd, rd.id, rd.paragraph, rd.seats, rd.description, rd.hscode, rd.quantity, rd.unit, rd.invoce")
            ->join('rd.sertificateid', 'rq')
            ->where("rq.sertificatenumid =:id")
            ->setParameter('id', $requestId)
            ->orderBy('rd.id', 'ASC')
            ->getQuery();
        return $query;

    }

    /**
     *
     * @param int $requestId
     * @return mixed | NULL
     */
    public function getRequestByRequestId($requestId)
    {

        $em = $this->doctrineEntity;
        $query = $em->createQueryBuilder()
            ->from($this->entityNameRequest, 'rq')
            ->select("rq, rq.id, rq.consignor, rq.exporter, rq.consignee, rq.importer,
    			 rq.transport, rq.servicemark, rq.adressconsignor, rq.adressexporter,
    			 rq.adressconsignee, rq.adressimporter, rq.itinerary, rq.unpconsignor,
    		  	 rq.unpexporter, rq.representation, rq.fioagent")
            ->where("rq.sertificatenumid =:id")
            ->setParameter('id', $requestId)
            ->orderBy('rq.id', 'ASC')
            ->getQuery();

        return $query;
    }

    /**
     * @param DateTime beginDate
     * @param DateTime endDate
     * @return query | NULL
     */
    public function getRequestNumbersByDate($beginDate, $endDate)
    {

        $em = $this->doctrineEntity;
        $query = $em->createQueryBuilder()
            ->from($this->entityNameRequestNumber, 'rn')
            ->select("rn.id, rn.workorder")
            ->where("rn.dateacceped >= '" . $beginDate . "'")
            ->andWhere("rn.dateacceped <='" . $endDate . "'")
            ->orderBy('rn.id', 'ASC')
            ->getQuery();
        return $query;
    }

    /**
     * @param Array status
     * @return query | NULL
     */
    public function getRequestNumbersByStatus(array $status)
    {
        $params = 'rn.workorder!=\'\' AND(';
        foreach ($status as $key => $value) {
            if ($key != count($status))
                $params .= 'rn.statusid=' . $value . ' OR ';
            else
                $params .= 'rn.statusid=' . $value . ')';
        }
        $em = $this->doctrineEntity;
        $query = $em->createQueryBuilder()
            ->from($this->entityNameRequestNumber, 'rn')
            ->select("rn.id, rn.workorder")
            ->leftJoin($this->entityNameXmlUnloading, 'x', \Doctrine\ORM\Query\Expr\Join::WITH, 'x.sertificatenumid	 = rn.id')
            ->where($params)
            ->andWhere('x.sertificatenumid is NULL')
            ->orderBy('rn.id', 'ASC')
            ->getQuery();
        return $query;
    }

    /**
     * @param Array value
     * @param DateTime date
     * @return query | NULL
     */
    public function fillXmlUnloading($value, $date)
    {
        $em = $this->doctrineEntity;
        try {
            $x = new $this->entityNameXmlUnloading;
            $x->setDateunloading($date);
            $x->setSertificatenumid($em->find($this->entityNameRequestNumber, $value['id']));
            $em->persist($x);
            $em->flush();
        } catch (Exception $e) {
            $em->getConnection()->rollback();
            $em->close();
            throw $e;
        }
    }

    /**
     *
     * @param int $requestId
     * @return mixed | NULL
     */
    public function getRequsetWorkOrder($requestId)
    {

        $em = $this->doctrineEntity;
        $query = $em->createQueryBuilder()
            ->from($this->entityNameRequestNumber, 'rn')
            ->select("rn.workorder")
            ->where("rn.id =:id")
            ->setParameter('id', $requestId)
            ->getQuery();

        return $query;
    }

    /**
     *
     * @return query
     */
    public function getRequestNumber($search)
    {

        $em = $this->doctrineEntity;
        $query = $em->createQueryBuilder()
            ->from($this->entityNameRequestNumber, 'rn')
            ->select("rn, rn.id, rn.workorder, rn.dateorder, rn.numblank, f.forms, rn.file, p.id as priorityid, p.priority,
    			  s.id as statusid, s.status, u.id as userid,  rn.numdoplist, u.name, u.position, u.phone as phone, o.name as organization, 
    			  rez.id as isresident, e.id as executorid, e.name as executor, rn.destinationiso, e.position as execposition, 
    			  e.phone as execphone, e.email as execemail, rez.sezname, e.nameshort, rez.prefix, f.id as formsid, e.nameshorten, u.email as useremail")
            ->join('rn.priorityid', 'p')
            ->join('rn.statusid', 's')
            ->join('rn.userid', 'u')
            ->join('rn.executorid', 'e')
            ->join('u.organizationid', 'o')
            ->join('o.cityid', 'c')
            ->join('rn.formsid', 'f')
            ->join('o.isresident', 'rez');
        if (!empty($search))
            $query = $this->convertSearchToWhere($query, $search);
        if (!is_null($this->authUserId))
            $query = $this->convertAuthToWhere($query);

        $result = $query->orderBy('rn.id', 'DESC')
            ->getQuery();

        return $result;

    }

    /**
     *Add search params in main query
     * @params QueryBuilder $query, json string
     * @return query
     */
    public function convertSearchToWhere(QueryBuilder $query, $search)
    {
        $allowedOperations = array('AND', 'OR');
        $allowedFields = array('id', 'workorder', 'dateorder', 'numblank', 'forms', 'priority', 'status', 'name', 'position', 'organization', 'executor', 'destinationiso');
        $search = json_decode($search);
        if (is_object($search) && (count($search->rules) < 10)) {
            foreach ($search->rules as $rule) {
                if (in_array($rule->field, $allowedFields)) {
                    switch ($rule->field) {
                        case 'id':
                            $qWhere = 'rn.' . $rule->field . ' = :id';
                            $qParametrs = 'id';
                            break;
                        case 'workorder':
                            $qWhere = 'rn.' . $rule->field . ' = :workorder';
                            $qParametrs = 'workorder';
                            break;
                        case 'numblank':
                            $qWhere = 'rn.' . $rule->field . ' = :numblank';
                            $qParametrs = 'numblank';
                            break;
                        case 'forms':
                            $qWhere = 'f.id = :forms';
                            $qParametrs = 'forms';
                            break;
                        case 'dateorder':
                            $qWhere = 'rn.' . $rule->field . ' = :dateorder';
                            $qParametrs = 'dateorder';
                            break;
                        /*case 'priority': $qWhere = 'p.id = :priorityid';
                                          $qParametrs='priorityid';
                                          break;*/
                        case 'status':
                            $qWhere = 's.id = :statusid';
                            $qParametrs = 'statusid';
                            break;
                        case 'name':
                            $qWhere = 'u.' . $rule->field . ' = :name';
                            $qParametrs = 'name';
                            break;
                        case 'position':
                            $qWhere = 'u.' . $rule->field . ' = :position';
                            $qParametrs = 'position';
                            break;
                        case 'organization':
                            $qWhere = 'o.name = :organization';
                            $qParametrs = 'organization';
                            break;
                        case 'executor':
                            $qWhere = 'e.id = :executorid';
                            $qParametrs = 'executorid';
                            break;
                        case 'destinationiso':
                            $qWhere = 'rn.' . $rule->field . ' = :destinationiso';
                            $qParametrs = 'destinationiso';
                            break;

                    }
                    if (strcmp($search->groupOp, 'AND') == 0)
                        $query->andWhere($qWhere);
                    elseif (strcmp($search->groupOp, 'OR') == 0)
                        $query->orWhere($qWhere);
                    $value = $rule->data;
                    if (strcmp('dateorder', $rule->field) == 0)
                        $value = $this->convertDataToMysqlFormat($value);
                    $query->setParameter($qParametrs, $value);
                }
            }
        }
        return $query;
    }

    /**
     *
     * @return query
     */
    public function getRequestNumberById($requestId)
    {

        $em = $this->doctrineEntity;
        $query = $em->createQueryBuilder()
            ->from($this->entityNameRequestNumber, 'rn')
            ->select("rn, rn.id, rn.workorder, rn.dateorder, rn.numblank, f.forms, rn.file, p.id as priorityid, p.priority,
    			  s.id as statusid, s.status, u.id as userid, rn.numdoplist, u.name, u.position, u.phone, o.name as organization, 
    			  rez.id as isresident, e.id as executorid, e.name as executor, rn.destinationiso, e.position as execposition, 
    			  e.phone as execphone, e.email as execemail, rez.sezname, e.nameshort, rez.prefix, f.id as formsid, e.nameshorten")
            ->join('rn.priorityid', 'p')
            ->join('rn.statusid', 's')
            ->join('rn.userid', 'u')
            ->join('rn.executorid', 'e')
            ->join('u.organizationid', 'o')
            ->join('rn.formsid', 'f')
            ->join('o.isresident', 'rez')
            ->where("rn.id =:id")
            ->setParameter('id', $requestId)
            ->orderBy('rn.id', 'DESC')
            ->getQuery();

        return $query;

    }

    /**
     * @var $data
     * @return true|false
     */
    public function updateRequestNumber(array $data, $statusid)
    {

        $em = $this->doctrineEntity;
        /*if(!is_null($data['destinationiso'])){
            $cointrymapper=new CountryMapper($em);
            $iso=$cointrymapper->getCountryById($data['destinationiso'])->getArrayResult();
            foreach ($iso as $key=>$value){
                $data['destinationiso']=$value['iso'];
            }
        }*/
        if (!is_null($data['id'])) {
            $em->getConnection()->beginTransaction();
            try {
                $rn = $em->find($this->entityNameRequestNumber, $data['id']);
                if ($rn instanceof \DmnDatabase\Entity\CciRequestNumber) {
                    if (!is_null($data['workorder']))
                        $rn->setWorkorder($data['workorder']);
                    if (!is_null($data['numblank']))
                        $rn->setNumblank($data['numblank']);
                    if (!is_null($data['dateorder']) && !empty($data['dateorder']))
                        $rn->setDateorder(new \DateTime($this->convertDataToMysqlFormat($data['dateorder'])));
                    if (!is_null($data['numdoplist']) && is_int(intval($data['numdoplist'])))
                        $rn->setNumDopList($data['numdoplist']);
                    /*if(!is_null($data['priority']) && is_int(intval($data['priority'])))
                    $rn->setPriorityid($em->find($this->entityNamePriority, $data['priority']));*/
                    if (!is_null($data['status']) && is_int(intval($data['status'])))
                        $rn->setStatusid($em->find($this->entityNameStatus, $data['status']));
                    if (!is_null($data['forms']) && is_int(intval($data['forms'])))
                        $rn->setFormsid($em->find($this->entityNameForms, $data['forms']));
                    if (!is_null($data['executor']) && is_int(intval($data['executor'])))
                        $rn->setExecutorid($em->find($this->entityUser, $data['executor']));
                    if (!is_null($data['destinationiso']) && is_int(intval($data['destinationiso'])))
                        $rn->setDestinationiso($data['destinationiso']);
                    $em->persist($rn);
                    $em->flush();
                    //Lifecycle if change status
                    if (!is_null($data['status']) && ((($data['status'] >= $statusid) && ($statusid < 9)) || (($data['status'] >= 2) && ($statusid >= 9)))) {
                        $lc = $em->getRepository($this->entityNameLifecycle)->findOneBy(array('sertificatenumid' => $data['id']));
                        if ($lc instanceof \DmnDatabase\Entity\CciLifecycle) {
                            if ($data['status'] == 2)
                                $lc->setWorking(new \DateTime("now"));
                            elseif ($data['status'] == 3)
                                $lc->setIssuance(new \DateTime("now"));
                            elseif ($data['status'] == 4)
                                $lc->setProceed(new \DateTime("now"));
                            elseif ($data['status'] == 5)
                                $lc->setDuplicate(new \DateTime("now"));
                            elseif ($data['status'] == 6)
                                $lc->setExchange(new \DateTime("now"));
                            elseif ($data['status'] == 7)
                                $lc->setNotindemand(new \DateTime("now"));
                            elseif ($data['status'] == 8)
                                $lc->setDamaged(new \DateTime("now"));
                            elseif ($data['status'] == 9)
                                $lc->setSuspended(new \DateTime("now"));
                            elseif ($data['status'] == 10)
                                $lc->setNodocuments(new \DateTime("now"));
                            $em->persist($lc);
                            $em->flush();
                        }
                    }
                }
                $em->getConnection()->commit();
            } catch (Exception $e) {
                $em->getConnection()->rollback();
                $em->close();
                throw $e;
            }
            return true;
        }
        return false;

    }

    /**
     * @var $data
     * @return true|false
     */
    public function updateRequestDescription(array $data)
    {

        $em = $this->doctrineEntity;
        if (!is_null($data['id'])) {
            $em->getConnection()->beginTransaction();
            try {
                $rd = $em->find($this->entityNameRequestDescription, $data['id']);
                if ($rd instanceof \DmnDatabase\Entity\CciRequestDescription) {
                    if (!is_null($data['description']))
                        $rd->setDescription($data['description']);
                    if (!is_null($data['hscode']))
                        $rd->setHscode($data['hscode']);
                    if (!is_null($data['invoce']))
                        $rd->setInvoce($data['invoce']);
                    if (!is_null($data['paragraph']))
                        $rd->setParagraph($data['paragraph']);
                    if (!is_null($data['quantity']))
                        $rd->setQuantity($data['quantity']);
                    if (!is_null($data['seats']))
                        $rd->setSeats($data['seats']);
                    if (!is_null($data['unit']))
                        $rd->setUnit($data['unit']);
                    $em->persist($rd);
                    $em->flush();
                    $em->getConnection()->commit();
                }
            } catch (Exception $e) {
                $em->getConnection()->rollback();
                $em->close();
                throw $e;
            }
            return true;
        }
        return false;

    }

    /**
     * @var $data
     * @return true|false
     */
    public function updateRequest(array $data)
    {

        $em = $this->doctrineEntity;
        $col = $em->getClassMetadata($this->entityNameRequest)->getFieldNames();
        $id = $data['id'] + 1;
        if (array_key_exists($id, $col)) {
            $value = 'rd.' . $col[$id];
            if (!is_null($data['id'])) {
                $em->getConnection()->beginTransaction();
                try {
                    $em->createQueryBuilder()
                        ->update($this->entityNameRequest, 'rd')
                        ->set($value, '?1')
                        ->setParameter('1', addslashes($data['value']))
                        ->where('rd.id = :id')
                        ->setParameter('id', $data['idreq'])
                        ->getQuery()
                        ->execute();
                    $em->getConnection()->commit();
                } catch (Exception $e) {
                    $em->getConnection()->rollback();
                    $em->close();
                    throw $e;
                }
                return true;
            }
        }
        return false;

    }

    /**
     * @var $data
     * @return true|false
     */
    public function addRequest(array $data)
    {
        $add = false;
        $em = $this->doctrineEntity;
        if (!empty($data)) {
            $em->getConnection()->beginTransaction();
            try {
                foreach ($data['rn'] as $keyRows => $valueRows) {
                    foreach ($valueRows as $keyId => $valueId) {
                        $rn = new $this->entityNameRequestNumber;
                        $rn->setDateorder(new \DateTime("now"));
                        $rn->setFile($valueId['cell'][4]);
                        $rn->setExecutorid($em->find($this->entityUser, $valueId['cell'][9]));
                        $rn->setUserid($em->find($this->entityUser, $valueId['cell'][7]));
                        $rn->setPriorityid($em->find($this->entityNamePriority, 1));
                        $rn->setNumDopList(0);
                        $rn->setStatusid($em->find($this->entityNameStatus, 1));
                        $rn->setFormsid($em->find($this->entityNameForms, 1));
                        $rn->setDateacceped(new \DateTime("now"));
                        $em->persist($rn);
                        $em->flush();
                        $requestNumber = $rn->getId();
                    }
                    try {
                        if (!is_null($requestNumber)) {
                            //LifeCycle
                            $lc = new $this->entityNameLifecycle;
                            $lc->setAcceped(new \DateTime("now"));
                            $lc->setWorking(null);
                            $lc->setIssuance(null);
                            $lc->setProceed(null);
                            $lc->setDuplicate(null);
                            $lc->setExchange(null);
                            $lc->setNotindemand(null);
                            $lc->setDamaged(null);
                            $lc->setSuspended(null);
                            $lc->setNodocuments(null);
                            $lc->setSertificatenumid($em->find($this->entityNameRequestNumber, $requestNumber));
                            $em->persist($lc);
                            $em->flush();
                            //Request
                            foreach ($data['rq'][$keyRows] as $keyId => $valueId) {
                                $rq = new $this->entityNameRequest;
                                $rq->setConsignor(addslashes(trim($valueId['cell'][0])));
                                $rq->setExporter(addslashes(trim($valueId['cell'][1])));
                                $rq->setConsignee(addslashes(trim($valueId['cell'][2])));
                                $rq->setImporter(addslashes(trim($valueId['cell'][3])));
                                $rq->setTransport(addslashes(trim($valueId['cell'][4])));
                                $rq->setServicemark(addslashes(trim($valueId['cell'][5])));
                                $rq->setAdressconsignor(addslashes(trim($valueId['cell'][6])));
                                $rq->setAdressexporter(addslashes(trim($valueId['cell'][7])));
                                $rq->setAdressconsignee(addslashes(trim($valueId['cell'][8])));
                                $rq->setAdressimporter(addslashes(trim($valueId['cell'][9])));
                                $rq->setItinerary(addslashes(trim($valueId['cell'][10])));
                                $rq->setUnpconsignor(addslashes(trim($valueId['cell'][11])));
                                $rq->setUnpexporter(addslashes(trim($valueId['cell'][12])));
                                $rq->setRepresentation(addslashes(trim($valueId['cell'][13])));
                                $rq->setFioagent(addslashes(trim($valueId['cell'][14])));
                                $rq->setSertificatenumid($em->find($this->entityNameRequestNumber, $requestNumber));
                                $em->persist($rq);
                                $em->flush();
                                $request = $rq->getId();
                                try {
                                    if (!is_null($request)) {
                                        foreach ($data['rd'] as $keyRdRows => $valueRdRows) {
                                            foreach ($valueRdRows as $keyId => $valueId) {
                                                $rd = new $this->entityNameRequestDescription;
                                                $rd->setParagraph(addslashes(trim($valueId['cell'][1])));
                                                $rd->setSeats(addslashes(trim($valueId['cell'][2])));
                                                $rd->setDescription(addslashes(trim($valueId['cell'][3])));
                                                $rd->setHscode(addslashes(trim($valueId['cell'][4])));
                                                $rd->setQuantity(addslashes(trim($valueId['cell'][5])));
                                                $rd->setUnit(addslashes(trim($valueId['cell'][6])));
                                                $rd->setInvoce(addslashes(trim($valueId['cell'][7])));
                                                $rd->setSertificateid($em->find($this->entityNameRequest, $request));
                                                $em->persist($rd);
                                                $em->flush();
                                            }
                                        }
                                    }
                                } catch (Exception $e) {
                                    $em->getConnection()->rollback();
                                    $em->close();
                                    throw $e;
                                }
                            }
                        }
                    } catch (Exception $e) {
                        $em->getConnection()->rollback();
                        $em->close();
                        throw $e;
                    }
                }
                $em->getConnection()->commit();
                $add = true;
            } catch (Exception $e) {
                $em->getConnection()->rollback();
                $em->close();
                throw $e;
            }
        }
        return $add;
    }

    /**
     * @return StatusId
     */
    public function getStatusByRequestId($id)
    {

        $em = $this->doctrineEntity;
        $query = $em->createQueryBuilder()
            ->from($this->entityNameRequestNumber, 'rn')
            ->select("s.id as statusid")
            ->join("rn.statusid", "s")
            ->where("rn.id =:id")
            ->setParameter('id', $id)
            ->getQuery();

        return $query;
    }

    /**
     * param int $requestid
     * @return query getCountryByRequestId
     */
    /*public function getCountryByRequestId($requestid) {
    
    	$em=$this->doctrineEntity;
    	$order=$em->createQueryBuilder()
    	->from($this->entityNameRequestNumber, 'rn')
    	->select("rn.destinationiso")    	
    	->where("rn.id =:id")
    	->setParameter('id', $requestid)
    	->getQuery()
    	->getSingleResult();    	
    	foreach($order as $key=>$iso){
    		if(!is_null($iso)){	
    		$em=$this->doctrineEntity;
    		$country=$em->createQueryBuilder()
    		->from($this->entityNameCountry, 'co')
    		->select("co.id, co.nameru, co.nameen, co.iso, co.fullnameru, co.dative")
    		->where("co.id =:id")
    		->setParameter('id', $iso)    		
    		->getQuery()
    		->getArrayResult();
    		return $country;
    	  }
    	}
    	return '';
    }*/
    /**
     * param int $id
     * @return query getCountryById
     */
    public function getCountryById($id)
    {
        $em = $this->doctrineEntity;
        $country = $em->createQueryBuilder()
            ->from($this->entityNameCountry, 'co')
            ->select("co.id, co.nameru, co.nameen, co.iso, co.fullnameru, co.dative")
            ->where("co.id =:id")
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
        return $country;

    }

    /**
     * param int $id
     * @return query getCountryByNameRu
     */
    public function getCountryByNameRu($nameru)
    {
        $em = $this->doctrineEntity;
        $country = $em->createQueryBuilder()
            ->from($this->entityNameCountry, 'co')
            ->select("co.id, co.nameru, co.nameen, co.iso, co.fullnameru, co.dative")
            ->where("co.nameru =:nameru")
            ->setParameter('nameru', $nameru)
            ->getQuery()
            ->getArrayResult();
        return $country;

    }


}

?>