<?php
namespace DmnDatabase\Data;

use DmnDatabase\Mapper\AbstractMapper;
use Exception;

class ContentMapper extends AbstractMapper implements ContentMapperInterface
{

    /**
     * @dependency_table CciContent
     */
    private $entityNameContent = 'DmnDatabase\Entity\CciContent';

    /**
     * @return query Content
     */
    public function getContent()
    {

        $em = $this->doctrineEntity;
        $query = $em->createQueryBuilder()
            ->from($this->entityNameContent, 'co')
            ->select("co, co.id, co.static, co.title, co.content")
            ->orderBy('co.id', 'ASC')
            ->getQuery();
        return $query;
    }

    /**
     * @return query Content
     */
    public function getStatic()
    {

        $em = $this->doctrineEntity;
        $query = $em->createQueryBuilder()
            ->from($this->entityNameContent, 'co')
            ->select("co.id, co.static")
            ->orderBy('co.id', 'ASC')
            ->getQuery();
        return $query;
    }

    /**
     * param int $id
     * @return query Content
     */
    public function getContentById($id)
    {

        $em = $this->doctrineEntity;

        if ($id === null) {
            throw new \InvalidArgumentException('id  can\'t be empty in ContentMapper');
        }
        $result = $em->getRepository($this->entityNameContent)->findOneBy(array('id' => $id));

        return $result;
    }

    /**
     * @return query City
     */
    public function getContentByStatic($static)
    {

        $em = $this->doctrineEntity;

        if ($static === null) {
            throw new \InvalidArgumentException('static  can\'t be empty in ContentMapper');
        }
        $result = $em->getRepository($this->entityNameContent)->findOneBy(array('static' => $static));

        return $result;
    }

    /**
     * @return true | false
     */
    public function updateById(array $data)
    {
        $em = $this->doctrineEntity;
        if (!is_null($data['id'])) {
            $em->getConnection()->beginTransaction();
            try {
                $content = $em->find($this->entityNameContent, $data['id']);
                $content->setTitle($data['title']);
                $content->setContent($data['content']);
                $em->persist($content);
                $em->flush();
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

}

