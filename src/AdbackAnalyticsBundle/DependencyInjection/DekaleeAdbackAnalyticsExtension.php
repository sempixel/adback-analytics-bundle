<?php

namespace Dekalee\AdbackAnalyticsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class DekaleeAdbackAnalyticsExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('dekalee_adback_analytics.api.access_token', $config['access_token']);
        $container->setParameter('dekalee_adback_analytics.api.api_url', $config['api_url']);
        $container->setParameter('dekalee_adback_analytics.api.script_url', $config['script_url']);
        if (array_key_exists('cache_service', $config)) {
            $container->setAlias('dekalee_adback_analytics.cache', $config['cache_service']);
        }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('client.yml');
        $loader->load('query.yml');
        $loader->load('script_cache.yml');
        $loader->load('generator.yml');
        $loader->load('twig.yml');
    }
}
