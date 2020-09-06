<?php

declare(strict_types = 1);

namespace App\Fields;

use App\Fields\FieldRepository;
use App\Fields\Field;

class FieldService {

    protected $FieldRepository;

    public function __construct(FieldRepository $fieldRepository){
        $this->fieldRepository = $fieldRepository;
    }

    public function index(){
        return $this->fieldRepository->findAll();
    }

    public function save($request){
        $data = json_decode($request->getContent(), true);
        return $this->fieldRepository->save(new Field($data));
    }

    public function find(array $data){
        return $this->fieldRepository->find($data['id']);
    }

    public function update($request, array $data){
        $input = json_decode($request->getContent(), true);
        $data = array_merge($input, $data);
        return $this->fieldRepository->update(new Field($data));
    }

    public function delete(array $data){
        return $this->fieldRepository->delete($data['id']);
    }



}
