<?php

    class Errors extends Controller
    {
        function __construct()
        {
            parent::__construct();
            error_log('Errores::construct -> Inicio de errores');
        }

        function render(){
            $this->view->render('errors/index');
            
    
        }
    }
    

?>