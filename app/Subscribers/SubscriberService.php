<?php

declare(strict_types = 1);

namespace App\Subscribers;

use App\Subscribers\SubscriberRepository;
use App\Subscribers\Subscriber;

class SubscriberService {

    protected $subscriberRepository;

    public function __construct(SubscriberRepository $subscriberRepository){
        $this->subscriberRepository = $subscriberRepository;
    }

    public function index(){
        return $this->subscriberRepository->findAll();
    }

    public function save($request){
        $data = json_decode($request->getContent(), true);
        return $this->subscriberRepository->save(new Subscriber($data));
    }

    public function find(array $data){
        return $this->subscriberRepository->find($data['id']);
    }

    public function update($request, array $data){
        $input = json_decode($request->getContent(), true);
        $data = array_merge($input, $data);
        return $this->subscriberRepository->update(new Subscriber($data));
    }

    public function delete(array $data){
        return $this->subscriberRepository->delete($data['id']);
    }



}
