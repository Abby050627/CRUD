<style type= "text/css">
div.formulario{
	background-color: #FFF5BA;
	text-align: center;
	width: 60%;
	height:30%;
	border: border-style: solid #9FC;
  border-width: 5px;
	margin-left: auto;
	margin-right:auto;
	}

button{
  align-items: center;
  background-color: #FFABAB;
  border: 0;
  border-radius: 100px;
  box-sizing: border-box;
  color: #ffffff;
  cursor: pointer;
  display: inline-flex;
  font-size: 16px;
  font-weight: 600;
  justify-content: center;
  line-height: 20px;
  max-width: 480px;
  min-height: 40px;
  min-width: 0px;
  overflow: hidden;
  padding: 0px;
  padding-left: 20px;
  padding-right: 20px;
  text-align: center;
  touch-action: manipulation;
}

body p {
	font-family: Comic Sans MS, cursive;
}
.F {
	font-family: Comic Sans MS, cursive;
}
.f2 {
	font-family: Palatino Linotype, Book Antiqua, Palatino, serif;
}
.f2 {
	font-family: Comic Sans MS, cursive;
}
.f2 {
	font-family: Palatino Linotype, Book Antiqua, Palatino, serif;
}
.F3 {
	font-family: Comic Sans MS, cursive;
}
</style>



<?php 
session_start();
include 'conexion.php';
if ($_SERVER ["REQUEST_METHOD"]== "POST"){
$username= $_POST['username'];
$password = md5 ($_POST['password']);
$sql = "SELECT  * FROM usuarios WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
$_SESSION['username'] = $username;
header ("Location: ventas.php");
exit();
   } else {
     echo "Nombre de usuario o contraseña incorrectos.";
  }
  }


?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>login</title>
</head>
<body bgcolor="#ECD4FF">
<h2 align="center" class="f2">INICIAR SESION</h2>
<div class="formulario">
<form method="POST" action="Login.php">
<p>
  <label>
    <div align="center">
      <p class="f2"><span class="F3">Usuario</span></p>
    </div>
  </label>
  <div align="center">
    <input type="text" name="username" required>
  </div>
  <p>
    <div align="center" class="F">    </div>
  </p>
  <div align="center" class="F">
    <p>Contraseña</p>
  </div>
  <p>
    <div align="center" class="F"> </div>
    </label>
  </p>
  <h2>
    <div align="center">
      <span class="F">
      <input type="password" name="password" required>
      </span><br>
    </div>
  </h2>
<button type="submit" class:"btn1">Ingresar</button>
</form>
</body>
</html>