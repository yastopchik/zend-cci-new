<?php
namespace DmnDatabase\Data;

use DmnDatabase\Mapper\AbstractMapper;

class CountryMapper extends AbstractMapper implements CountryMapperInterface {
   
    /**
     * @dependency_table CciCountry  
     */
    private $entityNameCountry = 'DmnDatabase\Entity\CciCountry';  
    /**
     * @dependency_table CciCity
     */
    private $entityNameCity = 'DmnDatabase\Entity\CciCity';    
    
    /**
     * @return query Countries
     */
    public function getCountries() {
    
    	$em=$this->doctrineEntity;
    	$query=$em->createQueryBuilder()
    	->from($this->entityNameCountry, 'co')
    	->select("co.id, co.nameru, co.nameen, co.iso, co.fullnameru, co.dative")
    	->orderBy('co.id', 'ASC')
    	->getQuery();
    	return $query;
    }
    /**
     * param int $id
     * @return query Countries
     */
    public function getCountryById($id) {
    
    	$em=$this->doctrineEntity;
    	$query=$em->createQueryBuilder()
    	->from($this->entityNameCountry, 'co')
    	->select("co.id, co.nameru, co.nameen, co.iso, co.fullnameru, co.dative")
    	->where("co.id =:id")
    	->setParameter('id', $id)
    	->getQuery();
    	return $query;
    }     
    /**
     * @return query City
     */
    public function getExecutorCities() {
    
    	$em=$this->doctrineEntity;
    	$query=$em->createQueryBuilder()
    	->from($this->entityNameCity, 'ci')
    	->select("ci.id, ci.nameru as city, ci.nameen")
    	->where("ci.idcountry =:id")
    	->setParameter('id', 21)
    	->orderBy('ci.nameru', 'ASC')
    	->getQuery();
    	return $query;
    }
    
}

