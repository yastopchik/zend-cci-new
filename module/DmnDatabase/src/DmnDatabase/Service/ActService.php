<?php
/**
 * Created by PhpStorm.
 * User: yastopchik
 * Date: 13.04.2017
 * Time: 21:16
 */

namespace DmnDatabase\Service;

use DmnDatabase\Data\ActMapperInterface;

class ActService
{
    public function __construct(ActMapperInterface $mapperRequest)
    {
        $this->mapperRequest = $mapperRequest;
    }

    public function getActs()
    {
        return $this->mapperRequest->getActs();
    }
    public function editAct(array $data, $oper) {

        if (empty($data) || empty($oper)) {
            throw new \InvalidArgumentException('Data or Operation  can\'t be empty');
        }
        if(strcmp($oper, 'edit')==0)
            return $this->mapperRequest->editAct($data);
        if(strcmp($oper, 'add')==0)
            return $this->mapperRequest->addAct($data);

    }
}