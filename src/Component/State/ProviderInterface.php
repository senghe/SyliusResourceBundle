<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\Component\Resource\State;

use Sylius\Bundle\ResourceBundle\Controller\RequestConfiguration;

/**
 * Retrieves data from a persistence layer.
 *
 * @experimental
 */
interface ProviderInterface
{
    public function provide(RequestConfiguration $configuration);
}
