<?php

declare(strict_types = 1);

namespace App\Subscribers;
use App\Connection;

class SubscriberDao{

    protected $connection;

    public function __construct(){
        $this->connection = Connection::getInstance();
      }

    public function getSubscriberByEmail($email_address){
            $stmt = $this->connection->prepare('select id from subscribers where email_address = :email_address');
            $stmt->bindParam(':email_address', $email_address);
            $stmt->execute();
            return $stmt->fetchColumn();
    }
}
