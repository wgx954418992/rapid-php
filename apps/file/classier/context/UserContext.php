<?php

namespace apps\file\classier\context;

class UserContext
{

    /**
     * @var int|string|null
     */
    private $id;

    /**
     * @return int|string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int|string|null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * UserContext constructor.
     * @param $id
     */
    public function __construct($id = null)
    {
        $this->id = $id;
    }
}