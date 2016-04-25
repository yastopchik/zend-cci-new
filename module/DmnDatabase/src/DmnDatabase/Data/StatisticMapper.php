<?php
namespace DmnDatabase\Data;

use DmnDatabase\Mapper\AbstractMapper;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

class StatisticMapper extends AbstractMapper implements StatisticMapperInterface {      
      
    /**
     * @dependency_table CciStatistics
     */
    private $entityNameStatistic = 'DmnDatabase\Entity\CciStatistic';  
    /**
     * @dependency_table CciCountry
     */
    private $entityNameCountry = 'DmnDatabase\Entity\CciCountry';
    
    /**     
     *
     * @param int $statisticId 
     * @return mixed | NULL
     */
    public function getStatisticByStatisticId($statisticId){
        
        $em=$this->doctrineEntity;       
        
    }
    /* ------------------Statistics-------------------------*/
    /**
     * View Count of request by Forms
     * @return query
     */
    public function getCountOfRequestByForms(array $statistic){
        $em=$this->doctrineEntity;
        $qb=$em->createQueryBuilder()
        ->from($this->entityNameRequestNumber, 'rn')
        ->select('f.forms as label, COUNT(rn.id) as value')
        ->join("rn.formsid", "f")
        ->join('rn.userid', 'u')
        ->join('u.organizationid', 'o')
        ->join('o.cityid', 'c');
        if(!is_null($this->authUserId))
            $qb=$this->convertAuthToWhere($qb);
        $qb=$this->addQuery($qb, $statistic);        
        $query=$qb->groupBy('rn.formsid')
                  ->getQuery();
        return $query;
    
    }
    /**
     * View Sum of request by Clients
     * @return query
     */
    public function getCountOfRequestByClients(array $statistic){
        $em=$this->doctrineEntity;
        $qb=$em->createQueryBuilder()
        ->from($this->entityNameRequestNumber, 'rn')
        ->select('o.name as label, COUNT(rn.id) as value')
        ->join("rn.userid", "u")
        ->join("u.organizationid", "o")
        ->join('o.cityid', 'c');
        if(!is_null($this->authUserId))
            $qb=$this->convertAuthToWhere($qb);
        $qb=$this->addQuery($qb, $statistic);  
        $query=$qb->groupBy('o.id')->orderBy('value','DESC')
                  ->getQuery();        
        return $query;
         
    }
    /**
     * View Count of request by Executors
     * @return query
     */
    public function getCountOfRequestByExecutors(array $statistic){
        $em=$this->doctrineEntity;
        $qb=$em->createQueryBuilder()
        ->from($this->entityNameRequestNumber, 'rn')
        ->select('u.name as label, COUNT(rn.id) as value')
        ->join("rn.executorid", "u")        
        ->join('u.organizationid', 'o')
        ->join('o.cityid', 'c');
        if(!is_null($this->authUserId))
            $qb=$this->convertAuthToWhere($qb);
        $qb=$this->addQuery($qb, $statistic);  
        $query=$qb->groupBy('rn.executorid')->orderBy('value','DESC')
                   ->getQuery();
        return $query;
    
    }
    /**
     * View Count of request by Status
     * @return query
     */
    public function getCountOfRequestByStatus(array $statistic){
        $em=$this->doctrineEntity;
        $qb=$em->createQueryBuilder()
        ->from($this->entityNameRequestNumber, 'rn')
        ->select('s.status as label, COUNT(rn.id) as value')
        ->join("rn.statusid", "s")
        ->join('rn.userid', 'u')
        ->join('u.organizationid', 'o')
        ->join('o.cityid', 'c');
        if(!is_null($this->authUserId))
            $qb=$this->convertAuthToWhere($qb);
        $qb=$this->addQuery($qb, $statistic);  
        $query=$qb->groupBy('rn.statusid')->orderBy('value','DESC')
                  ->getQuery();
        return $query;
    
    }
    /**
     * View Count of request by Status
     * @return query
     */
    public function getCountOfRequestByCountry(array $statistic){
        $em=$this->doctrineEntity;
        $qb=$em->createQueryBuilder()
        ->from($this->entityNameRequestNumber, 'rn')
        ->select('co.nameru as label, COUNT(rn.id) as value')
        ->join("rn.statusid", "s")
        ->join('rn.userid', 'u')
        ->join('u.organizationid', 'o')
        ->join('o.cityid', 'c');
        $qb->join($this->entityNameCountry, 'co', Join::WITH, 'co.id = rn.destinationiso');
        $qb->andWhere("rn.destinationiso IS NOT NULL");
        if(!is_null($this->authUserId))
            $qb=$this->convertAuthToWhere($qb);
        $qb=$this->addQuery($qb, $statistic);
        $query=$qb->groupBy('co.id')->orderBy('value','DESC')
        ->getQuery();
        return $query;
    
    }
    /**
     *Add params in main query
     *@params QueryBuilder $query
     * @return query
     */
    public function addQuery(QueryBuilder $query, array $statistic) {
        foreach ($statistic as $key=>$value) {
            if(!empty($value) && $value!='0') {
            switch ($key) {
                case 'periodDate': 
                    if(isset($value[0]) && isset($value[1])){
                        $query->andWhere("rn.dateorder>='".$value[0]."' AND rn.dateorder<='".$value[1]."'");
                    } elseif(isset($value[0]) && !isset($value[1])) {
                        $query->andWhere("rn.dateorder='".$value[0]."'");
                    } else {
                        $query->andWhere("rn.dateorder='".date('Y-m-d')."'");
                    }
                break;
                case 'organization':                    
                    $query->andWhere("o.id =:organizationid"); 
                    $query->setParameter('organizationid', $value);
                break;
                case 'executors':
                    $query->andWhere("rn.executorid =:executorid");
                    $query->setParameter('executorid', $value);
                break;
                case 'forms':
                    $query->andWhere("rn.formsid =:formsid");
                    $query->setParameter('formsid', $value);
                break;
                case 'status':
                    $query->andWhere("rn.statusid =:statusid");
                    $query->setParameter('statusid', $value);
                break;
                case 'country':
                    $query->andWhere("rn.destinationiso =:destinationiso");
                    $query->setParameter('destinationiso', $value);
                break;
            
            } 
          }            
        }
        return $query;
    } 
    
}

