<?php

    namespace Model;

    class ActiveRecord {
        protected static $db;
        protected static $tabla_db = '';
        protected static $columnas_db = [];

        protected static $errores = [];

        public static function setDB($database) {
            self::$db = $database;
        }

        public static function getErrores() {
            return self::$errores;
        }
    }