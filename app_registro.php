<?php

require("validacion.php");

$name = $_POST['name'];
$email = $_POST['email'];
$user= $_POST['user'];
$password= $_POST['password'];

$usuario = new Usuario();

$usuario->insertar_usuario($name,$email,$user,$password);
