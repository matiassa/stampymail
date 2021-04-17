<?php

class SuccessMessages
{

    const SUCCESS_ADMIN_NEWCATEGORY_EXISTS = "";

    private $successList = [];

    public function __construct()
    {
        $this->successList = [
            SuccessMessages::SUCCESS_ADMIN_NEWCATEGORY_EXISTS => 'El nombre de la categoria ya existe, intente otra.'
        ];
        
    }


    public function get($hash){

        return $this->successList[$hash];
        
    }

    public function existsKey($key){
       
        if (array_key_exists($key, $this->successList)) {
            return true;
        }else {
            return false;
        }
    }

}


?>