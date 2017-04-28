<?php
/**
 * Created by PhpStorm.
 * User: yastopchik
 * Date: 24.04.2017
 * Time: 14:33
 */

namespace DmnAdmin\Object;

use Zend\Paginator\Paginator;
use Zend\Stdlib\Parameters;

trait ResponseTrait
{
    /**
     *convertPanginationToResponde
     *@param Paginator paginator,  options, rotate=false
     *@return data
     */
    public function convertPanginationToResponce(Paginator $paginator, array $options, $rotate=false, $response=array()){

        $response['records']=$paginator->count();
        $response['page'] = $this->page;
        $response['total']= ceil($paginator->getTotalItemCount()/$this->rows);
        $i=0;
        foreach($paginator as $key=>$row){
            if(!$rotate){
                $response['rows'][$key]['id']=$row['id'];
                $response['rows'][$key]['cell']=array();
                foreach($row as $keys=>$value){
                    if(array_key_exists($keys, $options['options'])){
                        if($value instanceof \DateTime){
                            $value=$value->format('d/m/Y');
                        }
                        array_push($response['rows'][$key]['cell'], stripslashes($value));
                    }
                }
            }else{
                foreach($row as $keys=>$value){
                    if(array_key_exists($keys, $options['options'])){
                        $response['rows'][$i]['id']=$i;
                        $response['rows'][$i]['cell']=array();
                        if($value instanceof \DateTime){
                            $value=$value->format('d.m.Y');
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
        $this->year = $parametrs->get('year', '');
        $this->rows = $parametrs->get('rows', '');
        $this->id = $parametrs->get('id', null);
        $this->isarch = $parametrs->get('isarch', null);
        $this->data['filters'] = $parametrs->get('filters', null);
        $this->data['_search'] = $parametrs->get('_search', false);
        $this->data['sidx'] = $parametrs->get('sidx', 'id');
        $this->data['sord'] = $parametrs->get('sord', 'asc');

    }
}