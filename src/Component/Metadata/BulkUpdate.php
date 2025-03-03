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

namespace Sylius\Component\Resource\Metadata;

/**
 * @experimental
 */
#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::IS_REPEATABLE)]
final class BulkUpdate extends HttpOperation implements UpdateOperationInterface, StateMachineAwareOperationInterface, BulkOperationInterface
{
    public function __construct(
        ?array $methods = null,
        ?string $path = null,
        ?string $routePrefix = null,
        ?string $template = null,
        ?string $shortName = null,
        ?string $name = null,
        string|callable|null $provider = null,
        string|callable|null $processor = null,
        string|callable|null $responder = null,
        string|callable|null $repository = null,
        ?string $repositoryMethod = null,
        ?array $repositoryArguments = null,
        ?bool $read = null,
        ?bool $write = null,
        ?bool $validate = null,
        ?bool $deserialize = null,
        ?bool $serialize = null,
        ?string $formType = null,
        ?array $formOptions = null,
        ?array $validationContext = null,
        ?string $eventShortName = null,
        ?string $redirectToRoute = null,
        ?array $redirectArguments = null,
        ?array $vars = null,
        private ?string $stateMachineComponent = null,
        private ?string $stateMachineTransition = null,
        private ?string $stateMachineGraph = null,
    ) {
        parent::__construct(
            methods: $methods ?? ['PUT', 'PATCH'],
            path: $path,
            routePrefix: $routePrefix,
            template: $template,
            shortName: $shortName ?? 'bulk_update',
            name: $name,
            provider: $provider,
            processor: $processor,
            responder: $responder,
            repository: $repository,
            repositoryMethod: $repositoryMethod,
            repositoryArguments: $repositoryArguments,
            read: $read,
            write: $write,
            validate: $validate,
            deserialize: $deserialize,
            serialize: $serialize,
            formType: $formType,
            formOptions: $formOptions,
            validationContext: $validationContext,
            eventShortName: $eventShortName,
            redirectToRoute: $redirectToRoute,
            redirectArguments: $redirectArguments,
            vars: $vars,
        );
    }

    public function getStateMachineComponent(): ?string
    {
        return $this->stateMachineComponent;
    }

    public function withStateMachineComponent(?string $stateMachineComponent): self
    {
        $self = clone $this;
        $self->stateMachineComponent = $stateMachineComponent;

        return $self;
    }

    public function getStateMachineTransition(): ?string
    {
        return $this->stateMachineTransition;
    }

    public function withStateMachineTransition(string $stateMachineTransition): self
    {
        $self = clone $this;
        $self->stateMachineTransition = $stateMachineTransition;

        return $self;
    }

    public function getStateMachineGraph(): ?string
    {
        return $this->stateMachineGraph;
    }

    public function withStateMachineGraph(string $stateMachineGraph): self
    {
        $self = clone $this;
        $self->stateMachineGraph = $stateMachineGraph;

        return $self;
    }
}
