<?php

declare(strict_types = 1);

namespace App\Subscribers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Subscribers\SubscriberService;


class SubscriberHandler {

    protected $subscriberService;

    public function __construct(SubscriberService $subscriberService){
      $this->subscriberService = $subscriberService;
    }

    public function index(){
      return new JsonResponse($this->subscriberService->index());
    }

    public function store(Request $request){
      return new JsonResponse($this->subscriberService->save($request));
    }
    
    public function show(Request $request, $data){
      return new JsonResponse($this->subscriberService->find($data));
    }
    
     public function update(Request $request, $data)
    {
    return new JsonResponse(['data' => $this->subscriberService->update($request, $data)]);
    }
    
    public function delete(Request $request, $data)
    {
      return new JsonResponse($this->subscriberService->delete($data));
    }


}
