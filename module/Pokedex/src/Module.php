<?php

namespace Pokedex;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

/**
 * Created by PhpStorm.
 * User: Cyriaque
 * Date: 10/07/2017
 * Time: 20:35
 */

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\Pokemon::class => function($container) {
                    $tableGateway = $container->get(Model\PokemonTableGateway::class);
                    return new Model\Pokemon($tableGateway);
                },
                Model\PokemonTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Pokemon());
                    return new TableGateway('pokemon', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }
}