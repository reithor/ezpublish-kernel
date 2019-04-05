<?php

/**
 * File containing the FieldTypeCollectionPass class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace eZ\Publish\Core\Base\Container\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * This Pass overrides all services to be public.
 *
 * It is a workaround to the change in Symfony 4 which makes all services private by default.
 * Our integration tests are not prepared for this as they get services directly from the Container.
 *
 * WARNING! DO NOT USE IT IN YOUR APPLICATION.
 *
 * Inspired by \Symfony\Bundle\FrameworkBundle\DependencyInjection\Compiler\TestServiceContainerWeakRefPass
 */
class ReplaceServiceContainerPass implements CompilerPassInterface
{
    /**
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder
     */
    public function process(ContainerBuilder $containerBuilder)
    {
        foreach ($containerBuilder->getDefinitions() as $id => $definition) {
            $methodCalls = $definition->getMethodCalls();
            foreach ($methodCalls as $callIndex => $methodCall) {
                if ($methodCall[0] !== 'setContainer') {
                    continue;
                }
            }
        }
    }
}
