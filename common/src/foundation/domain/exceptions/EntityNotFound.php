<?php namespace common\src\foundation\domain\exceptions;

class EntityNotFound extends Exception
{
    /**
     * The repository name.
     *
     * @var string
     */
    public $repository;

    /**
     * The entity id that can not be found.
     *
     * @var mixed
     */
    public $id;

    /**
     * Construct the exception.
     *
     * @param string $repository
     * @param mixed $id
     */
    public function __construct($repository, $id)
    {
        parent::__construct("Can't find identity $id in $repository");
    }
}