<?php
    namespace app\controllers;
    use app\models\viewsModel;

    //Controlador
    class viewsController extends viewsModel{
        public function obtenerVistasControlador($vista){
            if($vista != ""){
                $respuesta = $this->obtenerVistasModelo($vista);
            }else{
                $respuesta = "login";
            }

            return $respuesta;
        }
    }
?>