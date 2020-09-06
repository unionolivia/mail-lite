<?php

declare(strict_types = 1);

namespace App\Subscribers;

class Subscriber {

    public $id;
    public $email_address; 
    public $name;
    public $state; // active, unsubscribed, junk, bounced, unconfirmed

    public function __construct($data = null){
        if (is_array($data)) {

            if (isset($data['id'])) $this->id = $data['id'];
            $this->email_address = $data['email_address'];
            $this->name = $data['name'];
            $this->state = 'subscribed';
        }
    }

    public function getId(): int{
        return $this->int;
    }

    public function getEmail(): string
    {
        return $this->email_address;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getState(): string
    {
        return $this->state;
    }


}
