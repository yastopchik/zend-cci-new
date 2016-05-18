<?php

namespace DmnDatabase\Service;

use DmnDatabase\Data\RequestMapperInterface;

class RequestService
{

    /**
     *
     * @var RequestMapperInterface
     */
    private $mapperRequest;

    public function __construct(RequestMapperInterface $mapperRequest)
    {

        $this->mapperRequest = $mapperRequest;
    }

    public function getRequestNumberById($id)
    {
        if (empty($id)) {
            throw new \InvalidArgumentException('Request Id can\'t be empty');
        }
        return $this->mapperRequest->getRequestNumberById($id);
    }

    public function getRequestNumbersByDate($date)
    {
        if (!$date instanceof \DateTime) {
            throw new \InvalidArgumentException('Date must be instanceof DateTime');
        }
        return $this->mapperRequest->getRequestNumbersByDate($date->format('Y-m-d' . ' 00:00:00'), $date->format('Y-m-d' . ' 23:59:59'));
    }

    public function getRequestNumbersByStatus()
    {
        return $this->mapperRequest->getRequestNumbersByStatus(array('1' => 4, '2' => 5, '3' => 6, '4' => 7));
    }

    public function fillXmlUnloading($value, $date)
    {
        if (!is_array($value) || !$date instanceof \DateTime) {
            throw new \InvalidArgumentException('Value isn\'t an Array or Date isn\'t a date');
        }
        return $this->mapperRequest->fillXmlUnloading($value, $date);
    }
    public function requestToArchive($date)
    {
        if (!$date instanceof \DateTime) {
            throw new \InvalidArgumentException('Value isn\'t  a date');
        }
        return $this->mapperRequest->requestToArchive($date);
    }

    public function getRequestByRequestId($requestId)
    {
        if (empty($requestId)) {
            throw new \InvalidArgumentException('Request Id can\'t be empty');
        }
        return $this->mapperRequest->getRequestByRequestId($requestId);
    }

    public function getCountryByRequestId($requestId)
    {
        if (empty($requestId)) {
            throw new \InvalidArgumentException('Request Id can\'t be empty');
        }
        return $this->mapperRequest->getCountryByRequestId($requestId);
    }

    public function getRequestDescriptionByRequestId($requestId)
    {
        if (empty($requestId)) {
            throw new \InvalidArgumentException('Request Id can\'t be empty');
        }
        return $this->mapperRequest->getRequestDescriptionByRequestId($requestId);
    }

    public function getRequsetWorkOrder($requestId)
    {
        if (empty($requestId)) {
            throw new \InvalidArgumentException('Request Id can\'t be empty');
        }
        return $this->mapperRequest->getRequsetWorkOrder($requestId);
    }

    public function getRequestNumber($search = null)
    {

        return $this->mapperRequest->getRequestNumber($search);
    }

    public function editRequestNumber(array $data, $statusid)
    {

        if (!is_int(intval($statusid)) || is_null(intval($statusid))) {
            throw new Exception\RuntimeException(sprintf('Failed to set varible. It is not an integer or is null statusid', __CLASS__));
        }

        return $this->mapperRequest->updateRequestNumber($data, $statusid);
    }

    public function editRequestDescription(array $data)
    {

        return $this->mapperRequest->updateRequestDescription($data);
    }

    public function editRequest(array $data)
    {

        return $this->mapperRequest->updateRequest($data);
    }

    public function saveRequest(array $data)
    {

        return $this->mapperRequest->addRequest($data);
    }

    public function getEntityManager()
    {

        return $this->mapperRequest->getEntityManager();
    }

    public function getEntityNameRequestNumber()
    {

        return $this->mapperRequest->getEntityNameRequestNumber();
    }

    public function getEntityUser()
    {

        return $this->mapperRequest->getEntityUser();
    }

    public function  getStatusByRequestId($id)
    {

        if (!is_int(intval($id)) || is_null(intval($id))) {
            throw new Exception\RuntimeException(sprintf('Failed to set varible $Id. It is not an integer or is null', __CLASS__));
        }

        return $this->mapperRequest->getStatusByRequestId($id);
    }

    public function getCountries()
    {

        return $this->mapperRequest->getCountries();
    }

    public function getCountryById($id)
    {
        if (!is_int(intval($id)) || is_null(intval($id))) {
            throw new Exception\RuntimeException(sprintf('Failed to set varible $Id. It is not an integer or is null', __CLASS__));
        }

        return $this->mapperRequest->getCountryById($id);
    }

    public function getCountryByNameRu($nameru)
    {
        if (empty($nameru)) {
            throw new Exception\RuntimeException(sprintf('Failed to set varible $nameru.', __CLASS__));
        }

        return $this->mapperRequest->getCountryByNameRu($nameru);
    }

    public function setAuth($authUserId)
    {

        if (!is_int(intval($authUserId)) || is_null(intval($authUserId))) {
            throw new Exception\RuntimeException(sprintf('Failed to set varible $authUserId. It is not an integer or is null', __CLASS__));
        }

        return $this->mapperRequest->setAuthUserId($authUserId);
    }

    public function setRole($authRoleId)
    {

        if (!is_int(intval($authRoleId)) || is_null(intval($authRoleId))) {
            throw new Exception\RuntimeException(sprintf('Failed to set varible $authRoleId. It is not an integer or is null', __CLASS__));
        }

        return $this->mapperRequest->setAuthRoleId($authRoleId);
    }

}

?>