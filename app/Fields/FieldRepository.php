<?php

declare(strict_types = 1);

namespace App\Fields;

use App\Connection;
use App\Fields\Field;

class FieldRepository {

    protected $connection;

    public function __construct(){
        $this->connection = Connection::getInstance();
    }

    public function save(Field $field){
        $stmt = $this->connection->prepare('insert into fields (title, type) values (:title, :type)');
        $stmt->bindParam(':title', $field->title);
        $stmt->bindParam(':type', $field->type);
        $stmt->execute();
        return $this->find($this->connection->lastInsertId());
    }

    public function update(Field $field){
        $stmt = $this->connection->prepare('update fields set title = :title, type=:type where id = :id');
        $stmt->bindParam(':title', $field->title);
        $stmt->bindParam(':type', $field->type);
        $stmt->bindParam(':id', $field->id);
        $stmt->execute();
        return $this->find($field->id);
    }

    public function findAll(){
        $stmt = $this->connection->prepare('select id, title, type from fields');
        $stmt->execute();
        return $stmt->fetchAll($this->connection::FETCH_ASSOC);
    }

    public function find($id){
        $stmt = $this->connection->prepare('select id, title, type from fields where id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch($this->connection::FETCH_ASSOC);
    }

    public function delete($id){
        $stmt = $this->connection->prepare('delete from fields where id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $this->findAll();
    }
}
