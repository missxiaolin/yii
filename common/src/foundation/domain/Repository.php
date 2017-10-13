<?php namespace common\src\Foundation\Domain;

use common\src\foundation\domain\exceptions\EntityNotFound;
use common\src\foundation\domain\interfaces\Repository as RepositoryInterface;

abstract class Repository implements RepositoryInterface
{
    /**
     * Reconstitute an entity from persistence.
     *
     * @param mixed $id
     * @param array $params Additional params.
     * @return \common\src\foundation\domain\Entity
     */
    abstract protected function reconstitute($id, $params = []);

    /**
     * Store an entity into persistence.
     *
     * @param \common\src\foundation\domain\Entity $entity
     */
    abstract protected function store($entity);

    /**
     * Save an entity to repository and then publish its events.
     *
     * @param \common\src\foundation\domain\Entity $entity
     */
    public function save($entity)
    {
        $this->store($entity);
        $entity->stored();
        $entity->publishEvents();
    }

    /**
     * Fetch an entity from repository by its identity.
     *
     * @param mixed $id
     * @param array $params Additional params.
     * @param bool $throws Whether throws an EntityNotFound exception.
     * @return \common\src\foundation\domain\Entity|null
     *
     * @throws \common\src\foundation\domain\exceptions\EntityNotFound
     */
    public function fetch($id, $params = [], $throws = false)
    {
        $entity = $this->reconstitute($id, $params);
        if (isset($entity)) {
            $entity->stored();
        } elseif ($throws) {
            throw new EntityNotFound(static::class, $id);
        }

        return $entity;
    }

}