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

namespace Sylius\Bundle\ResourceBundle\Controller;

use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

final class NewResourceFactory implements NewResourceFactoryInterface
{
    public function create(RequestConfiguration $requestConfiguration, FactoryInterface $factory): ResourceInterface
    {
        if (null === $method = $requestConfiguration->getFactoryMethod()) {
            /** @var ResourceInterface $resource */
            $resource = $factory->createNew();

            return $resource;
        }

        if (is_array($method) && 2 === count($method)) {
            $factory = $method[0];
            $method = $method[1];
        }

        $arguments = array_values($requestConfiguration->getFactoryArguments());

        return $factory->$method(...$arguments);
    }
}
