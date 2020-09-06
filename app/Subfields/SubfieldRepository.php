<?php

declare(strict_types = 1);

namespace App\Subfields;

use App\Connection;
use App\Subfields\Subfield;

class SubfieldRepository {

    protected $connection;

    public function __construct(){
        $this->connection = Connection::getInstance();
    }

    public function save(Subfield $subfield){
        $stmt = $this->connection->prepare('insert into subscriber_fields (subscriber_id, field_id) values (:subscriber_id, :field_id)');
        $stmt->bindParam(':subscriber_id', $subfield->subscriber_id);
        $stmt->bindParam(':field_id', $subfield->field_id);
        $stmt->execute();
        return $this->find($this->connection->lastInsertId());
    }

    public function find($id){
        $stmt = $this->connection->prepare('select s.id, s.email_address, s.name, s.state, f.title, f.type, sf.created_at from subscriber_fields sf join subscribers s on s.id = sf.subscriber_id join fields f on f.id = sf.field_id where sf.id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch($this->connection::FETCH_ASSOC);
    }

    public function findAll(){
        $stmt = $this->connection->prepare('select s.id, s.email_address, s.name, s.state, f.title, f.type, sf.created_at from subscriber_fields sf join subscribers s on s.id = sf.subscriber_id join fields f on f.id = sf.field_id');
        $stmt->execute();
        return $stmt->fetchAll($this->connection::FETCH_ASSOC);
    }

}
