<?php

/*
 * This file is part of SyliusResourceBundle.
 *
 * (c) Mobizel
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\Bundle\ResourceBundle\State;

use Sylius\Bundle\ResourceBundle\Controller\RequestConfiguration;

interface ProviderInterface
{
    public function provide(RequestConfiguration $configuration);
}
