<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Sylius Sp. z o.o.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\Sylius\Resource\State;

use PhpSpec\ObjectBehavior;
use Psr\Container\ContainerInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Metadata\Create;
use Sylius\Component\Resource\Symfony\ExpressionLanguage\ArgumentParserInterface;
use Sylius\Resource\Context\Context;
use Sylius\Resource\State\Factory;

final class FactorySpec extends ObjectBehavior
{
    function let(
        ContainerInterface $locator,
        ArgumentParserInterface $argumentParser,
    ): void {
        $this->beConstructedWith($locator, $argumentParser);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(Factory::class);
    }

    function it_calls_factory_from_operation_as_callable(): void
    {
        $factory = [FactoryCallable::class, 'create'];

        $operation = new Create(factory: $factory);

        $this->create($operation, new Context())->shouldHaveType(\stdClass::class);
    }

    function it_calls_factory_with_arguments_from_operation_as_callable(
        ArgumentParserInterface $argumentParser,
    ): void {
        $factory = [FactoryCallable::class, 'create'];

        $operation = new Create(factory: $factory, factoryArguments: ['userId' => 'user.getUserIdentifier()']);

        $argumentParser->parseExpression('user.getUserIdentifier()')->willReturn('51353e91-5295-4876-a994-cae4b3ff3a7c');

        $result = $this->create($operation, new Context());
        $result->shouldHaveType(\stdClass::class);
        $result->userId->shouldReturn('51353e91-5295-4876-a994-cae4b3ff3a7c');
    }

    function it_calls_factory_from_operation_as_string(
        FactoryInterface $factory,
        ContainerInterface $locator,
        \stdClass $data,
    ): void {
        $operation = new Create(name: 'app_dummy_create', factory: $factory::class, factoryMethod: 'createNew');

        $locator->has($factory::class)->willReturn(true);
        $locator->get($factory::class)->willReturn($factory);

        $factory->createNew()->willReturn($data);

        $this->create($operation, new Context())->shouldReturn($data);
    }

    function it_throws_an_exception_when_factory_is_not_found_on_locator(
        FactoryInterface $factory,
        ContainerInterface $locator,
        \stdClass $data,
    ): void {
        $operation = new Create(name: 'app_dummy_create', factory: $factory::class, factoryMethod: 'createNew');

        $locator->has($factory::class)->willReturn(false);
        $locator->get($factory::class)->willReturn($factory);

        $factory->createNew()->willReturn($data);

        $this->shouldThrow(
            new \RuntimeException(sprintf('Factory "%s" not found on operation "app_dummy_create"', $factory::class)),
        )->during('create', [$operation, new Context()]);
    }

    function it_throws_an_exception_when_factory_method_is_null(
        FactoryInterface $factory,
        ContainerInterface $locator,
        \stdClass $data,
    ): void {
        $operation = new Create(name: 'app_dummy_create', factory: $factory::class);

        $locator->has($factory::class)->willReturn(true);
        $locator->get($factory::class)->willReturn($factory);

        $factory->createNew()->willReturn($data);

        $this->shouldThrow(
            new \RuntimeException('No Factory method was configured on operation "app_dummy_create"'),
        )->during('create', [$operation, new Context()]);
    }
}

final class ResourceFactory implements FactoryInterface
{
    public function createNew(): object
    {
        return new \stdClass();
    }

    public function createForUser(string $userId): object
    {
        $object = $this->createNew();

        $object->userId = $userId;

        return $object;
    }
}

final class FactoryCallable
{
    public static function create(?string $userId = null): object
    {
        $object = new \stdClass();

        $object->userId = $userId;

        return $object;
    }
}
