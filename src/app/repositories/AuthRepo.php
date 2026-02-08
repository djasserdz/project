<?php

namespace App\repositories;

use App\Models\User;
use Exception;
use Illuminate\Container\Attributes\Log;
use Illuminate\Database\QueryException;


class AuthRepo{
    public static function create(array $data){
      try{
        return User::create($data);
      }catch(QueryException $e){
         throw new Exception("Database erorr : ".$e->getMessage());
      }   
    }
    public static function find($id){
        try{return User::find($id);}
        catch(QueryException $e){
            throw new Exception("database error : ".$e->getMessage());
        }
    }
    public static function find_email($email){
       try{ return User::where('email',$email)->first();}
       catch(QueryException $e){
        throw new Exception("database error : ".$e->getMessage());
       }
    }
}