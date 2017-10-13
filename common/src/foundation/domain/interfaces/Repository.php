<?php namespace common\src\foundation\domain\interfaces;

interface Repository
{
    /**
     * Save an entity to repository.
     *
     * @param \common\src\foundation\domain\Entity $entity
     */
    public function save($entity);

    /**
     * Fetch an entity from repository by its identity.
     *
     * @param mixed $id
     * @param bool  $throws Whether throws an EntityNotFound exception.
     * @return \common\src\foundation\domain\Entity|null
     *
     * @throws \common\src\foundation\domain\exceptions\EntityNotFound
     */
    public function fetch($id, $throws = false);

}