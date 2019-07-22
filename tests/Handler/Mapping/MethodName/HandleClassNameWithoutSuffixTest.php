<?php

declare(strict_types=1);

namespace League\Tactician\Tests\Handler\Mapping\MethodName;

use DateTime;
use League\Tactician\Handler\Mapping\MethodName\HandleClassNameWithoutSuffix;
use League\Tactician\Tests\Fixtures\Command\CompleteTaskCommand;
use League\Tactician\Tests\Fixtures\Handler\ConcreteMethodsHandler;
use PHPUnit\Framework\TestCase;

class HandleClassNameWithoutSuffixTest extends TestCase
{
    /** @var HandleClassNameWithoutSuffix */
    private $inflector;

    protected function setUp() : void
    {
        $this->inflector   = new HandleClassNameWithoutSuffix();
    }

    public function testRemovesCommandSuffixFromClasses() : void
    {
        self::assertEquals(
            'handleCompleteTask',
            $this->inflector->getMethodName(CompleteTaskCommand::class, ConcreteMethodsHandler::class)
        );
    }

    public function testDoesNotChangeClassesWithoutSuffix() : void
    {
        self::assertEquals(
            'handleDateTime',
            $this->inflector->getMethodName(DateTime::class, ConcreteMethodsHandler::class)
        );
    }

    public function testRemovesCustomSuffix() : void
    {
        $inflector = new HandleClassNameWithoutSuffix('Time');

        self::assertEquals(
            'handleDate',
            $inflector->getMethodName(DateTime::class, ConcreteMethodsHandler::class)
        );
    }
}