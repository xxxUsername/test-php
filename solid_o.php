<?php

interface SomeObjectInterface
{
    public function __construct(string $name);
    public function getObjectName(): string;
    public function getObjectHandler(): string;
}

class SomeObject implements SomeObjectInterface
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getObjectName(): string
    {
        return $this->name;
    }

    public function getObjectHandler(): string
    {
        return "handle_{$this->name}";
    }
}

class SomeObjectsHandler
{
    public function __construct()
    {
        //
    }

    public function handleObjects(array $objects): array
    {
        $handlers = [];

        foreach ($objects as $object) {
            $handlers[] = $object->getObjectHandler();
        }

        return $handlers;
    }
}

$objects = [
    new SomeObject('object_1'),
    new SomeObject('object_2')
];

$soh = new SomeObjectsHandler();
$soh->handleObjects($objects);