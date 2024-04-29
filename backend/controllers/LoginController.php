<?php

    namespace Controllers; // Debe tener todos los conterollers del composer json

use Model\UsuariosModel;

    class LoginController {
        public static function login() {

            $errores = [];

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $usuario = new UsuariosModel($_POST);

                $resultado = $usuario->buscarPorCorreo($_POST['correo']);

                if(!$resultado) {
                    $errores = UsuariosModel::getErrores();
                    foreach($errores as $error) {
                        echo $error;
                    }
                } else {
                    $autenticado = $usuario->comprobarPassword($resultado);

                    if($autenticado) {
                        echo "ESTAS LOGUEADO";
                    } else {
                        $errores = UsuariosModel::getErrores();
                        foreach($errores as $error) {
                            echo $error;
                        }
                    }
                }

            }
        }
    }
?>