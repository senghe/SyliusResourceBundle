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

use Doctrine\Persistence\ObjectManager;
use Sylius\Component\Resource\Model\ResourceInterface;

interface ResourceUpdateHandlerInterface
{
    public function handle(
        ResourceInterface $resource,
        RequestConfiguration $requestConfiguration,
        ObjectManager $manager,
    ): void;
}
