<?php

class ErrorMessages
{
    const PRUEBA = "409722fc72f71994f74c9d446042593c241a4ce5";

    private $errorList = [];

    

    public function __construct()
    {
        $this->errorList = [
            ErrorMessages::PRUEBA => 'El nombre de la categoria ya existe, intente otra.'
        ];
    }

    public function get($hash){

        return $this->errorList[$hash];

    }

    public function existsKey($key){
       
        if (array_key_exists($key, $this->errorList)) {
            return true;
        }else {
            return false;
        }
    }


}


?>