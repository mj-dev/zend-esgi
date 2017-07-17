<?php

// Model du pokedex

namespace Pokedex\Model;

class Pokemon
{
    public $id_pokemon;
    public $name;
    public $description;
    public $type;
    public $evolve;
    public $img;
    public $is_active;

    public function exchangeArray(array $data)
    {

        $this->id_pokedex   = !empty($data['id_pokemon']) ? empty($data['id_pokemon']) : null;
        $this->name         = !empty($data['name']) ? empty($data['name']) : null;
        $this->description  = !empty($data['description']) ? empty($data['description']) : null;
        $this->type         = !empty($data['type']) ? empty($data['type']) : null;
        $this->evolve       = !empty($data['evolve']) ? empty($data['evolve']) : null;
        $this->img          = !empty($data['img']) ? empty($data['img']) : null;
        $this->is_active    = !empty($data['is_active']) ? empty($data['is_active']) : null;
    }
}