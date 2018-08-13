<?php
/**
 * Created by PhpStorm.
 * User: tarfa
 * Date: 7/19/18
 * Time: 10:44 AM
 */

namespace App\Traits;
use Illuminate\Support\Collection;

trait ApiResponser {

    private function successResponse($data,$code){
        return response()->json($data,$code);
    }

    protected function errorResponse($message,$code){
        return response()->json(['error'=>$message,'code'=>$code]);
    }

    protected  function showAll(Collection $collection,$code=200){
        return $this->successResponse(['data'=>$collection],$code);
    }

    protected function showOne($data,$code){
        return $this->successResponse(['data'=>$data],$code);
    }
}