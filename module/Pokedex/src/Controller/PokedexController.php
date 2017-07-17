<?php

namespace Pokedex\Controller;

use Pokedex\Model\Pokemon;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Created by PhpStorm.
 * User: Cyriaque
 * Date: 10/07/2017
 * Time: 20:50
 */
class PokedexController extends AbstractActionController
{
    private $table;

    public function __construct(PokemonTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        return new ViewModel([
            'pokemon' => $this->table->fetchAll(),
        ]);
    }

    public function addAction()
    {
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}