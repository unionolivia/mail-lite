<?php

declare(strict_types = 1);

namespace App\Subfields;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Subfields\SubfieldService;


class SubfieldHandler {
    
  protected $subfieldService;

  public function __construct(SubfieldService $subfieldService){
    $this->subfieldService = $subfieldService;
  }    

  public function index(){
    return new JsonResponse($this->subfieldService->index());
  }

  public function store(Request $request){   
    return new JsonResponse($this->subfieldService->save($request));
  }


}
