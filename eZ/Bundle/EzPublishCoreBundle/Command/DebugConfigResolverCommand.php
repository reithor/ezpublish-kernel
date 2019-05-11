<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace eZ\Bundle\EzPublishCoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DebugConfigResolverCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->setName('ezplatform:debug:config-resolver');
        $this->setAliases(['ezplatform:debug:config']);
        $this->setDescription('Debug / Retrive parameter from Config Resolver');
        $this->addArgument(
            'parameter',
            InputArgument::REQUIRED,
            'The configuration resolver parameter to return, for instance "languages" or "http_cache.purge_servers"'
        );
        $this->addOption(
            'oneline',
            'o',
            InputOption::VALUE_NONE,
            'Only return value, for automation / testing use on a single line.',
        );
        $this->setHelp(<<<EOM
Outputs a given config resolver parameter, more commonly known as a SiteAccess setting.

To rather see all compiled siteaccess settings use: <comment>debug:config ezpublish [system.default]</comment>

EOM
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var \eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\ConfigResolver $configResolver */
        $configResolver = $this->getContainer()->get('ezpublish.config.resolver');
        $parameter = $input->getArgument('parameter');
        if ($input->getOption('oneline')) {
            $output->write($configResolver->getParameter($parameter));

            return;
        }

        /** @var \eZ\Publish\Core\MVC\Symfony\SiteAccess $siteAccess */
        $siteAccess = $this->getContainer()->get('ezpublish.siteaccess');
        $output->writeln("<comment>SiteAccess name:</> " . $siteAccess->name);

        $output->writeln("<comment>Parameter:</> " . $configResolver->getParameter($parameter));
    }
}
