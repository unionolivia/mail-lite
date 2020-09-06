<?php

declare(strict_types = 1);

namespace App\Subfields;

class Subfield {

    public $id;
    public $subscriber_id; 
    public $field_id;

    public function __construct($data = null){
        if (is_array($data)) {

            if (isset($data['id'])) $this->id = $data['id'];
            $this->subscriber_id = $data['subscriber_id'];
            $this->field_id = $data['field_id'];
        }
    }

    public function getId(): int{
        return $this->int;
    }

}
