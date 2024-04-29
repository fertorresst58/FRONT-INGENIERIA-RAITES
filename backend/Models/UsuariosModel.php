<?php

    namespace Model;

    class UsuariosModel extends ActiveRecord{
        protected static $tabla_db = 'usuarios';
        protected static $columnas_db = ['usu_id', 'usu_nombre', 'usu_apaterno', 'usu_amaterno', 'usu_sexo', 'usu_email', 'usu_password', 'usu_telefono', 'usu_carrera'];

        public function __construct($args = [])
        {
            $this->usu_id = $args['id'] ?? null;
            $this->usu_nombre = $args['nombre'] ?? '';
            $this->usu_apaterno = $args['ap_paterno'] ?? '';
            $this->usu_amaterno = $args['ap_materno'] ?? '';
            $this->usu_sexo = $args['sexo'] ?? '';
            $this->usu_email = $args['correo'] ?? '';
            $this->usu_password = $args['password'] ?? '';
            $this->usu_telefono = $args['telefono'] ?? '';
            $this->usu_carrera = $args['carrera'] ?? '';
        }

        public function buscarPorCorreo() {
            $query = "SELECT * FROM " . self::$tabla_db;
            $query .= " WHERE usu_email = '$this->usu_email'";

            $resultado = self::$db->query($query);

            if(!$resultado->num_rows) {
                self::$errores[] = 'El usuario no existe';
                return;
            }

            return $resultado;
        }

        public function comprobarPassword($resultado) {
            $usuario = $resultado->fetch_object();

            $autenticado = ($usuario->usu_password === $this->usu_password) ? true : false;

            if(!$autenticado) {
                self::$errores[] = 'El Password es Incorrecto';
            }
    
            return $autenticado;
        }

    }