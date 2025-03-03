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

namespace Sylius\Bundle\ResourceBundle\Tests\DependencyInjection\Compiler;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractCompilerPassTestCase;
use Sylius\Bundle\ResourceBundle\DependencyInjection\Compiler\RegisterResourcesPass;
use Sylius\Component\Resource\Model\ResourceInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class RegisterResourcesPassTest extends AbstractCompilerPassTestCase
{
    /**
     * @test
     */
    public function it_adds_method_call_to_resource_registry_if_resources_exist()
    {
        $this->setDefinition('sylius.resource_registry', new Definition());

        $this->setParameter(
            'sylius.resources',
            [
                'app.book' => ['classes' => ['model' => BookClass::class]],
                'app.author' => ['classes' => ['model' => AuthorClass::class]],
            ],
        );

        $this->compile();

        $this->assertContainerBuilderHasServiceDefinitionWithMethodCall(
            'sylius.resource_registry',
            'addFromAliasAndConfiguration',
            ['app.book', ['classes' => ['model' => BookClass::class]]],
        );

        $this->assertContainerBuilderHasServiceDefinitionWithMethodCall(
            'sylius.resource_registry',
            'addFromAliasAndConfiguration',
            ['app.author', ['classes' => ['model' => AuthorClass::class]]],
        );
    }

    protected function registerCompilerPass(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new RegisterResourcesPass());
    }
}

class AbstractResource implements ResourceInterface
{
    public function getId()
    {
        return;
    }
}
class BookClass extends AbstractResource
{
}
class AuthorClass extends AbstractResource
{
}

class PullRequestClass extends AbstractResource
{
}
