<?php

declare(strict_types = 1);

namespace App\Subscribers;

use App\Connection;
use App\Subscribers\Subscriber;

class SubscriberRepository {

    protected $connection;

    public function __construct(){
        $this->connection = Connection::getInstance();
    }

    public function save(Subscriber $subscriber){
        if(isset($subscriber->id)){
            return $this->update($subscriber);
        }
        $stmt = $this->connection->prepare('insert into subscribers (email_address, name, state) values (:email_address, :name, :state)');
        $stmt->bindParam(':email_address', $subscriber->email_address);
        $stmt->bindParam(':name', $subscriber->name);
        $stmt->bindParam(':state', $subscriber->state);
        $stmt->execute();
        return $this->find($this->connection->lastInsertId());
    }

    public function update(Subscriber $subscriber){
        $stmt = $this->connection->prepare('update subscribers set email_address = :email_address, name = :name, state=:state where id = :id');
        $stmt->bindParam(':email_address', $subscriber->email_address);
        $stmt->bindParam(':name', $subscriber->name);
        $stmt->bindParam(':state', $subscriber->state);
        $stmt->bindParam(':id', $subscriber->id);
        $stmt->execute();
        return $this->find($subscriber->id);
    }

    public function findAll(){
        $stmt = $this->connection->prepare('select id, email_address, name, state from subscribers');
        $stmt->execute();
        return $stmt->fetchAll($this->connection::FETCH_ASSOC);
    }

    public function find($id){
        $stmt = $this->connection->prepare('select id, email_address, name, state from subscribers where id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch($this->connection::FETCH_ASSOC);
    }
    
    public function delete($id){
    	$stmt = $this->connection->prepare('delete from subscribers where id = :id');
       $stmt->bindParam(':id', $id);
       $stmt->execute();
       return $this->findAll();
    }
}
