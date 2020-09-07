<?php

declare(strict_types = 1);

namespace App\Subscribers;

use App\Subscribers\SubscriberRepository;
use App\Subscribers\Subscriber;
use App\Subscribers\SubscriberDao;
use App\Helpers\Helper;

class SubscriberService {

    protected $subscriberRepository;
    protected $subscriberDao;

    public function __construct(SubscriberRepository $subscriberRepository, SubscriberDao $subscriberDao){
        $this->subscriberRepository = $subscriberRepository;
        $this->subscriberDao = $subscriberDao;
    }

    public function index(){
        return $this->subscriberRepository->findAll();
    }

    public function save($request){
        $data = json_decode($request->getContent(), true);

        if(Helper::isValidEmail($data['email_address']) == false){
            throw new \Exception('Please check the email and try again');
        }

         if($this->subscriberDao->getSubscriberByEmail($data['email_address']) !== false){

           throw new \Exception('It seems you already have an account with us.');
        }

       return $this->subscriberRepository->save(new Subscriber($data));
    }

    public function find(array $data){
        return $this->subscriberRepository->find($data['id']);
    }

    public function update($request, array $data){
        $input = json_decode($request->getContent(), true);
        $data = array_merge($input, $data);
        
        if(Helper::isValidEmail($data['email_address']) == false){
            throw new \Exception('Please check the email and try again');
        }

        return $this->subscriberRepository->update(new Subscriber($data));
    }

    public function delete(array $data){
        return $this->subscriberRepository->delete($data['id']);
    }



}
