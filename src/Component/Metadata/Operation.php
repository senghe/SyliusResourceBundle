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
abstract class Operation
{
    private ?ResourceMetadata $resource = null;

    /** @var string|callable|null */
    protected $provider;

    /** @var string|callable|null */
    protected $processor;

    /** @var string|callable|null */
    protected $responder;

    /** @var string|callable|null */
    protected $repository;

    public function __construct(
        protected ?string $template = null,
        protected ?string $shortName = null,
        protected ?string $name = null,
        string|callable|null $provider = null,
        string|callable|null $processor = null,
        string|callable|null $responder = null,
        string|callable|null $repository = null,
        protected ?string $repositoryMethod = null,
        protected ?array $repositoryArguments = null,
        protected ?bool $read = null,
        protected ?bool $write = null,
        protected ?bool $validate = null,
        protected ?bool $deserialize = null,
        protected ?bool $serialize = null,
        protected ?string $formType = null,
        protected ?array $formOptions = null,
        protected ?array $normalizationContext = null,
        protected ?array $denormalizationContext = null,
        protected ?array $validationContext = null,
        protected ?string $eventShortName = null,
    ) {
        $this->provider = $provider;
        $this->processor = $processor;
        $this->responder = $responder;
        $this->repository = $repository;
    }

    public function getResource(): ?ResourceMetadata
    {
        return $this->resource;
    }

    public function withResource(ResourceMetadata $resource): self
    {
        $self = clone $this;
        $self->resource = $resource;

        return $self;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function withTemplate(string $template): self
    {
        $self = clone $this;
        $self->template = $template;

        return $self;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self->name = $name;

        return $self;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function withShortName(string $shortName): self
    {
        $self = clone $this;
        $self->shortName = $shortName;

        return $self;
    }

    public function getProvider(): callable|string|null
    {
        return $this->provider;
    }

    public function withProvider(string|callable|null $provider): self
    {
        $self = clone $this;
        $self->provider = $provider;

        return $self;
    }

    public function getProcessor(): callable|string|null
    {
        return $this->processor;
    }

    public function withProcessor(string|callable|null $processor): self
    {
        $self = clone $this;
        $self->processor = $processor;

        return $self;
    }

    public function getResponder(): callable|string|null
    {
        return $this->responder;
    }

    public function withResponder(string|callable|null $responder): self
    {
        $self = clone $this;
        $self->responder = $responder;

        return $self;
    }

    public function getRepository(): callable|string|null
    {
        return $this->repository;
    }

    public function withRepository(string|callable|null $repository): self
    {
        $self = clone $this;
        $self->repository = $repository;

        return $self;
    }

    public function getRepositoryMethod(): ?string
    {
        return $this->repositoryMethod;
    }

    public function withRepositoryMethod(string $repositoryMethod): self
    {
        $self = clone $this;
        $self->repositoryMethod = $repositoryMethod;

        return $self;
    }

    public function getRepositoryArguments(): ?array
    {
        return $this->repositoryArguments;
    }

    public function withRepositoryArguments(array $repositoryArguments): self
    {
        $self = clone $this;
        $self->repositoryArguments = $repositoryArguments;

        return $self;
    }

    public function canRead(): ?bool
    {
        return $this->read;
    }

    public function withRead(bool $read): self
    {
        $self = clone $this;
        $self->read = $read;

        return $self;
    }

    public function canWrite(): ?bool
    {
        return $this->write;
    }

    public function withWrite(bool $write): self
    {
        $self = clone $this;
        $self->write = $write;

        return $self;
    }

    public function canValidate(): ?bool
    {
        return $this->validate;
    }

    public function withValidate(bool $validate): self
    {
        $self = clone $this;
        $self->validate = $validate;

        return $self;
    }

    public function canDeserialize(): ?bool
    {
        return $this->deserialize;
    }

    public function withDeserialize(bool $deserialize): self
    {
        $self = clone $this;
        $self->deserialize = $deserialize;

        return $self;
    }

    public function canSerialize(): ?bool
    {
        return $this->serialize;
    }

    public function withSerialize(bool $serialize): self
    {
        $self = clone $this;
        $self->serialize = $serialize;

        return $self;
    }

    public function getFormType(): ?string
    {
        return $this->formType;
    }

    public function withFormType(string $formType): self
    {
        $self = clone $this;
        $self->formType = $formType;

        return $self;
    }

    public function getFormOptions(): ?array
    {
        return $this->formOptions;
    }

    public function withFormOptions(array $formOptions): self
    {
        $self = clone $this;
        $self->formOptions = $formOptions;

        return $self;
    }

    public function getNormalizationContext(): ?array
    {
        return $this->normalizationContext;
    }

    public function withNormalizationContext(?array $normalizationContext): self
    {
        $self = clone $this;
        $self->normalizationContext = $normalizationContext;

        return $self;
    }

    public function getDenormalizationContext(): ?array
    {
        return $this->denormalizationContext;
    }

    public function withDenormalizationContext(?array $denormalizationContext): self
    {
        $self = clone $this;
        $self->denormalizationContext = $denormalizationContext;

        return $self;
    }

    public function getValidationContext(): ?array
    {
        return $this->validationContext;
    }

    public function withValidationContext(?array $validationContext): self
    {
        $self = clone $this;
        $self->validationContext = $validationContext;

        return $self;
    }

    public function getEventShortName(): ?string
    {
        return $this->eventShortName;
    }

    public function withEventShortName(string $eventShortName): self
    {
        $self = clone $this;
        $self->eventShortName = $eventShortName;

        return $self;
    }
}
