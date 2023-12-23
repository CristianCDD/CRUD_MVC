<?php
   namespace app\controllers;
   use app\models\mainModel;

   class loginController extends mainModel{
       //Controlador iniciar sesion
       
       public function iniciarSesionControlador(){
        $usuario=$this->limpiarCadena($_POST['login_usuario']);
        $clave=$this->limpiarCadena($_POST['login_clave']);

        if($usuario=="" || $clave==""){
            echo "<script>
            Swal.fire({
                    icon: 'error',
                    title: 'Ocurrio un error inesperado',
                    text: 'No ha llenado todos los campos obligatorios',
                    confirmButtonText: 'Aceptar'
                });
        </script>";
        }else{
            if($this->verificarDatos("[a-zA-Z0-9]{4,20}",$usuario)){
                echo "<script>
                Swal.fire({
                        icon: 'error',
                        title: 'Ocurrio un error inesperado',
                        text: 'El usuario no coincide con el formato solicitado',
                        confirmButtonText: 'Aceptar'
                    });
            </script>";
            }else{
                if($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}",$clave)){
                    echo "<script>
                    Swal.fire({
                            icon: 'error',
                            title: 'Ocurrio un error inesperado',
                            text: 'La clave no coincide con el formato solicitado',
                            confirmButtonText: 'Aceptar'
                        });
                </script>";
                }else{
                    $check_usuario = $this->ejecutarConsulta("SELECT * FROM usuario  WHERE usuario_usuario ='$usuario'");

                    if($check_usuario->rowCount()==1){
                        $check_usuario = $check_usuario -> fetch();
                        if($check_usuario["usuario_usuario"] == $usuario && password_verify($clave,$check_usuario["usuario_clave"] )){

                            $_SESSION['id'] = $check_usuario["usuario_id"];  // Usar '=' en lugar de '=='
                            $_SESSION['nombre'] = $check_usuario["usuario_nombre"];
                            $_SESSION['apellido'] = $check_usuario["usuario_apellido"];
                            $_SESSION['usuario'] = $check_usuario["usuario_usuario"];
                            $_SESSION['foto'] = $check_usuario["usuario_foto"];
                        
                            if(headers_sent()){
                                echo "<script>window.location.href = '".APP_URL."dashboard/'; </script>";
                            } else {
                                header("Location: ". APP_URL . "dashboard/");
                            }
                        
                        } else {
                            echo "<script>
                            Swal.fire({
                                    icon: 'error',
                                    title: 'Ocurrió un error inesperado',
                                    text: 'Usuario o clave incorrectos',
                                    confirmButtonText: 'Aceptar'
                                });
                            </script>";
                        }
                    }else{
                        echo "<script>
                Swal.fire({
                        icon: 'error',
                        title: 'Ocurrio un error inesperado',
                        text: 'Usuario o clave incorrectos',
                        confirmButtonText: 'Aceptar'
                    });
            </script>";
                    }
                }
            }
        }
       }

       public function cerrarSesionControlador(){
        session_destroy();

        if(headers_sent()){
            echo "<script>window.location.href = '".APP_URL."login/'; </script>";
        }else{
            header("Location: ". APP_URL . "login/");
        }
       }
   }

   ?>