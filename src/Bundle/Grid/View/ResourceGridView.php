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

namespace Sylius\Bundle\ResourceBundle\Grid\View;

use Sylius\Bundle\ResourceBundle\Controller\RequestConfiguration;
use Sylius\Component\Grid\Definition\Grid;
use Sylius\Component\Grid\Parameters;
use Sylius\Component\Grid\View\GridView;
use Sylius\Component\Resource\Metadata\MetadataInterface;

class ResourceGridView extends GridView
{
    private MetadataInterface $metadata;

    private RequestConfiguration $requestConfiguration;

    /**
     * @param mixed $data
     */
    public function __construct(
        $data,
        Grid $gridDefinition,
        Parameters $parameters,
        MetadataInterface $resourceMetadata,
        RequestConfiguration $requestConfiguration,
    ) {
        parent::__construct($data, $gridDefinition, $parameters);

        $this->metadata = $resourceMetadata;
        $this->requestConfiguration = $requestConfiguration;
    }

    public function getMetadata(): MetadataInterface
    {
        return $this->metadata;
    }

    public function getRequestConfiguration(): RequestConfiguration
    {
        return $this->requestConfiguration;
    }
}
