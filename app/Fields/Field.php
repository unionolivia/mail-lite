<?php

declare(strict_types = 1);

namespace App\Fields;

class Field {

    public $id;
    public $title; 
    public $type;

    public function __construct($data = null){
        if (is_array($data)) {

            if (isset($data['id'])) $this->id = $data['id'];
            $this->title = $data['title'];
            $this->type = $data['type'];
        }
    }

    public function getId(): int{
        return $this->int;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getType(): string
    {
        return $this->type;
    }

}
