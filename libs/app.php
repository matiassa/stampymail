<?php

require_once 'controllers/errors.php';

class App
{
    function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        if (empty($url[0])) {
            error_log('APP::construct-> no hay controlador especificado');
            $archivoController = 'controllers/login.php';
            require_once $archivoController;
            $controller = new Login();
            $controller->loadModel('login');
            $controller->render();
            return false;
        }

     $archivoController = 'controllers/' . $url[0] . '.php';

     if (file_exists($archivoController)) {
            require_once $archivoController;
            $controller = new $url[0];
            $controller->loadModel($url[0]);

            if (isset($url[1])) {
                if(method_exists($controller,$url[1])){

                    if (isset($url[2])) {
                        //nº de parametros
                        $nparams = count($url) - 2;

                        $params = [];

                        for ($i=0; $i < $nparams ; $i++) { 
                            array_push($params, $url[$i] + 2);
                        }
                        //le voy a pasar a mi controlador el método mas sus parámetros
                        $controller->{$url[1]}($params);
                    } else {
                        //no tiene parametros, se manda a llamar el metodo tal cual
                        $controller->{$url[1]}();
                    }

                }else{
                    // error, no existe el metodo
                    $controller = new Errors();
                    $controller->render();
                }
                
            } else {
                // no hay método a cargar, se carga el método por default
                $controller->render();
            }
            


     } else {

        // no existe el archivo, manda error
        $controller = new Errors();
        $controller->render();
         
     }
    }
}
