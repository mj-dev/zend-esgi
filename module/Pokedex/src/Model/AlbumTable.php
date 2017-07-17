<?php

namespace Pokedex\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class PokemonTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\PokemonController::class => function($container) {
                    return new Controller\PokemonController(
                        $container->get(Model\PokemonTable::class)
                    );
                },
            ],
        ];
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getPokemon($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id_pokemon' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function savePokemon(Pokemon $pokemon)
    {
        $data = [
            'name'          => $pokemon->name,
            'description'   => $pokemon->description,
            'type'          => $pokemon->type,
            'evolve'        => $pokemon->evolve,
            'img'           => $pokemon->img,
            'is_active'     => $pokemon->is_active,
        ];

        $id = (int) $pokemon->id_pokemon;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getPokemon($id)) {
            throw new RuntimeException(sprintf(
                'Impossible de mettre à jour le Pokémon avec id : %d; n\'existe pas.',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id_pokemon' => $id]);
    }

    public function deletePokemon($id)
    {
        $this->tableGateway->delete(['id_pokemon' => (int) $id]);
    }
}
