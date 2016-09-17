<?php

namespace SixBySix\Float\Tests\Entity;

use PHPUnit\Framework\TestCase;
use SixBySix\Float\Entity\AbstractEntity;
use SixBySix\Float\FloatClient;

abstract class AbstractEntityTest extends TestCase
{
    public static $oneEntityId;

    protected function setUp()
    {
        FloatClient::setApiKey($_ENV['API_KEY']);
    }

    /**
     * @test
     */
    public function getAll()
    {
        /** @var AbstractEntity[] $collection */
        $collection = ($this->getClass())::getAll();
        $this->assertInternalType('array', $collection);
        $this->assertContainsOnlyInstancesOf($this->getClass(), $collection);

        if (sizeof($collection) == 0) {
            return;
        }

        /** @var AbstractEntity $entity */
        $entity = $collection[0];

        static::$oneEntityId = $entity->getId();
    }

    /**
     * @test
     */
    public function getOne()
    {
        /** @var AbstractEntity $entity */
        $entity = ($this->getClass())::getById(static::$oneEntityId);
        $this->assertInstanceOf($this->getClass(), $entity);
    }

    abstract public function getClass();
}