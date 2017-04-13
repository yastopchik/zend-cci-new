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
}