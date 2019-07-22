<?php

declare(strict_types=1);

namespace League\Tactician\Tests\Handler\Mapping\MethodName;

use CommandWithoutNamespace;
use League\Tactician\Handler\Mapping\MethodName\HandleLastPartOfClassName;
use League\Tactician\Tests\Fixtures\Command\CompleteTaskCommand;
use League\Tactician\Tests\Fixtures\Handler\ConcreteMethodsHandler;
use PHPUnit\Framework\TestCase;

class HandleClassNameTest extends TestCase
{
    /** @var HandleLastPartOfClassName */
    private $inflector;

    protected function setUp() : void
    {
        $this->inflector   = new HandleLastPartOfClassName();
    }

    public function testHandlesClassesWithoutNamespace() : void
    {
        self::assertEquals(
            'handleCommandWithoutNamespace',
            $this->inflector->getMethodName(CommandWithoutNamespace::class, ConcreteMethodsHandler::class)
        );
    }

    public function testHandlesNamespacedClasses() : void
    {
        self::assertEquals(
            'handleCompleteTaskCommand',
            $this->inflector->getMethodName(CompleteTaskCommand::class, ConcreteMethodsHandler::class)
        );
    }
}