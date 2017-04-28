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
    public function __construct(ActMapperInterface $mapperAct)
    {
        $this->mapperAct = $mapperAct;
    }

    public function getActNumbers()
    {
        return $this->mapperAct->getActNumbers();
    }
    public function editActNumber(array $data, $oper) {

        if (empty($data) || empty($oper)) {
            throw new \InvalidArgumentException('Data or Operation  can\'t be empty');
        }
        if(strcmp($oper, 'edit')==0)
            return $this->mapperAct->editActNumber($data);
        if(strcmp($oper, 'add')==0)
            return $this->mapperAct->addActNumber($data);

    }
    public function editAct(array $data, $oper) {

        if (empty($data) || empty($oper)) {
            throw new \InvalidArgumentException('Data or Operation  can\'t be empty');
        }
        if(strcmp($oper, 'edit')==0)
            return $this->mapperAct->editAct($data);
        if(strcmp($oper, 'add')==0)
            return $this->mapperAct->addAct($data);

    }
    public function getActByActnumberId($actnumberId)
    {
        if (empty($actnumberId)) {
            throw new \InvalidArgumentException('Actnumber Id can\'t be empty');
        }
        return $this->mapperAct->getActByActnumberId($actnumberId);
    }
    public function setAuth($authUserId)
    {

        if (!is_int(intval($authUserId)) || is_null(intval($authUserId))) {
            throw new Exception\RuntimeException(sprintf('Failed to set varible $authUserId. It is not an integer or is null', __CLASS__));
        }

        return $this->mapperAct->setAuthUserId($authUserId);
    }

    public function setRole($authRoleId)
    {

        if (!is_int(intval($authRoleId)) || is_null(intval($authRoleId))) {
            throw new Exception\RuntimeException(sprintf('Failed to set varible $authRoleId. It is not an integer or is null', __CLASS__));
        }

        return $this->mapperAct->setAuthRoleId($authRoleId);
    }
}