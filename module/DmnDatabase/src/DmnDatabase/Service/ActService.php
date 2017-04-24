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

    public function getActNumbers()
    {
        return $this->mapperRequest->getActNumbers();
    }
    public function editActNumber(array $data, $oper) {

        if (empty($data) || empty($oper)) {
            throw new \InvalidArgumentException('Data or Operation  can\'t be empty');
        }
        if(strcmp($oper, 'edit')==0)
            return $this->mapperRequest->editActNumber($data);
        if(strcmp($oper, 'add')==0)
            return $this->mapperRequest->addActNumber($data);

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
    public function getActByActnumberId($actnumberId)
    {
        if (empty($actnumberId)) {
            throw new \InvalidArgumentException('Actnumber Id can\'t be empty');
        }
        return $this->mapperRequest->getActByActnumberId($actnumberId);
    }
}