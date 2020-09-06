<?php

declare(strict_types = 1);

namespace App\Subfields;
use App\Subscribers\SubscriberDao;
use App\Subfields\SubfieldRepository;
use App\Subfields\Subfield;

class SubfieldService {

    protected $subscriberDao;

    public function __construct(SubscriberDao $subscriberDao, SubfieldRepository $subfieldRepository){
        $this->subscriberDao = $subscriberDao;
        $this->subfieldRepository = $subfieldRepository;
    }

    public function index(){
        return $this->subfieldRepository->findAll();
    }


    public function save($request){
        $data = json_decode($request->getContent(), true);
        $data['subscriber_id'] = $this->subscriberDao->getSubscriberByEmail($data['email_address']);
        return $this->subfieldRepository->save(new Subfield($data));
    }

}
