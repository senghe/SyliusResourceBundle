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

namespace spec\Sylius\Resource\State\Processor;

use PhpSpec\ObjectBehavior;
use Sylius\Component\Resource\Metadata\Create;
use Sylius\Component\Resource\Symfony\EventDispatcher\OperationEvent;
use Sylius\Component\Resource\Symfony\EventDispatcher\OperationEventDispatcherInterface;
use Sylius\Component\Resource\Symfony\EventDispatcher\OperationEventHandlerInterface;
use Sylius\Resource\Context\Context;
use Sylius\Resource\State\Processor\EventDispatcherProcessor;
use Sylius\Resource\State\ProcessorInterface;
use Symfony\Component\HttpFoundation\Response;

final class EventDispatcherProcessorSpec extends ObjectBehavior
{
    function let(
        ProcessorInterface $decorated,
        OperationEventDispatcherInterface $operationEventDispatcher,
        OperationEventHandlerInterface $eventHandler,
    ): void {
        $this->beConstructedWith($decorated, $operationEventDispatcher, $eventHandler);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(EventDispatcherProcessor::class);
    }

    function it_dispatches_pre_and_post_events_with_operation_as_string(
        ProcessorInterface $decorated,
        OperationEventDispatcherInterface $operationEventDispatcher,
        OperationEventHandlerInterface $eventHandler,
        \stdClass $data,
        \stdClass $result,
    ): void {
        $operation = new Create(processor: '\App\Processor');
        $context = new Context();

        $decorated->process($data, $operation, $context)->willReturn($result)->shouldBeCalled();

        $preEvent = new OperationEvent();
        $postEvent = new OperationEvent();

        $operationEventDispatcher->dispatchPreEvent($data, $operation, $context)->willReturn($preEvent)->shouldBeCalled();
        $operationEventDispatcher->dispatchPostEvent($data, $operation, $context)->willReturn($postEvent)->shouldBeCalled();

        $eventHandler->handlePreProcessEvent($preEvent, $context, 'index')->willReturn(null)->shouldBeCalled();
        $eventHandler->handlePostProcessEvent($postEvent, $context)->willReturn(null)->shouldBeCalled();

        $this->process($data, $operation, $context)->shouldReturn($result);
    }

    function it_does_not_call_processor_if_pre_event_returns_a_response(
        ProcessorInterface $decorated,
        OperationEventDispatcherInterface $operationEventDispatcher,
        OperationEventHandlerInterface $eventHandler,
        \stdClass $data,
        \stdClass $result,
        Response $response,
    ): void {
        $operation = new Create(processor: '\App\Processor');
        $context = new Context();

        $decorated->process($data, $operation, $context)->willReturn($result)->shouldNotBeCalled();

        $preEvent = new OperationEvent();

        $operationEventDispatcher->dispatchPreEvent($data, $operation, $context)->willReturn($preEvent)->shouldBeCalled();

        $eventHandler->handlePreProcessEvent($preEvent, $context, 'index')->willReturn($response)->shouldBeCalled();

        $this->process($data, $operation, $context)->shouldReturn($response);
    }

    function it_returns_post_event_response(
        ProcessorInterface $decorated,
        OperationEventDispatcherInterface $operationEventDispatcher,
        OperationEventHandlerInterface $eventHandler,
        \stdClass $data,
        \stdClass $result,
        Response $response,
    ): void {
        $operation = new Create(processor: '\App\Processor');
        $context = new Context();

        $decorated->process($data, $operation, $context)->willReturn($result)->shouldBeCalled();

        $preEvent = new OperationEvent();
        $postEvent = new OperationEvent();

        $operationEventDispatcher->dispatchPreEvent($data, $operation, $context)->willReturn($preEvent)->shouldBeCalled();
        $operationEventDispatcher->dispatchPostEvent($data, $operation, $context)->willReturn($postEvent)->shouldBeCalled();

        $eventHandler->handlePreProcessEvent($preEvent, $context, 'index')->willReturn(null)->shouldBeCalled();
        $eventHandler->handlePostProcessEvent($postEvent, $context)->willReturn($response)->shouldBeCalled();

        $this->process($data, $operation, $context)->shouldReturn($response);
    }
}
