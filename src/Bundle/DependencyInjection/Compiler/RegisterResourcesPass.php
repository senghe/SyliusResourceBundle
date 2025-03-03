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

namespace Sylius\Bundle\ResourceBundle\DependencyInjection\Compiler;

use Sylius\Component\Resource\Model\ResourceInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;

final class RegisterResourcesPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        try {
            /** @var array $resources */
            $resources = $container->getParameter('sylius.resources');
            $registry = $container->findDefinition('sylius.resource_registry');
        } catch (InvalidArgumentException $exception) {
            return;
        }

        foreach ($resources as $alias => $configuration) {
            $this->validateSyliusResource($configuration['classes']['model']);
            $registry->addMethodCall('addFromAliasAndConfiguration', [$alias, $configuration]);
        }
    }

    private function validateSyliusResource(string $class): void
    {
        /** @var array $interfaces */
        $interfaces = class_implements($class);

        if (!in_array(ResourceInterface::class, $interfaces, true)) {
            throw new InvalidArgumentException(sprintf(
                'Class "%s" must implement "%s" to be registered as a Sylius resource.',
                $class,
                ResourceInterface::class,
            ));
        }
    }
}
