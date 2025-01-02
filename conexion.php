<?php 
$servername = "localhost"; // Nombre del servidor
$username = "root"; // nombre de usuario
$password = ""; // contraseña
$dbname = "sistema_ventas"; // nombre de la base de datos

// conexion con la base de datos
 $conn = new mysqli($servername, $username, $password, $dbname);
 if ($conn->connect_error){
     die("Conexion fallida: ".$conn->connect_error);
  }


?>
