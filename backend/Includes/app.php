<?php

    use Model\ActiveRecord;

    require 'database.php';
    require 'funciones.php';
    require __DIR__ . '/../vendor/autoload.php';

    ActiveRecord::setDB($db);