<?php

declare(strict_types = 1);

namespace App\Fields;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Fields\FieldService;


class FieldHandler {
    
  protected $fieldService;

  public function __construct(FieldService $fieldService){
    $this->fieldService = $fieldService;
  }

  public function index(){
    return new JsonResponse($this->fieldService->index());
  }

  public function store(Request $request){
    return new JsonResponse($this->fieldService->save($request));
  }
  
  public function show(Request $request, $data){
    return new JsonResponse($this->fieldService->find($data));
  }
  
   public function update(Request $request, $data)
  {
  return new JsonResponse(['data' => $this->fieldService->update($request, $data)]);
  }
  
  public function delete(Request $request, $data)
  {
    return new JsonResponse($this->fieldService->delete($data));
  }


}
