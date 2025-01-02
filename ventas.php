<style type= "text/css">
div.tienda{
	background-color: #FFB5E8;
	width: 100%;
	height: 16%;
    border:  border-style: solid #F6F ;
  border-width: 5px;
	 }
div.formulario{
	background-color: #FFF5BA;
	text-align: center;
	width: 30%;
	border: border-style: solid #9FC;
  border-width: 5px;
	margin-left: auto;
	margin-right:auto;
	}
	th.tabla{
		border: 5px solid #6EB5FF;
		background-color: #ACE7FF;
	}
	tr.tabla{
		border: 5px solid #C4FAF8;
		background-color: #ACE7FF;
	}
button.btnav{
  background-color: #fbeee0;
  border: 2px solid #422800;
  border-radius: 30px;
  box-shadow: #422800 4px 4px 0 0;
  color: #422800;
  cursor: pointer;
  display: inline-block;
  font-weight: 600;
  font-size: 18px;
  padding: 0 18px;
  line-height: 50px;
  text-align: center;
  text-decoration: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}
button.btnM{
  align-items: center;
  background-color: #AFF8D8;
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
  user-select: none;
  -webkit-user-select: none;
  vertical-align: middle;
}

button.btnE{
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
  user-select: none;
  -webkit-user-select: none;
  vertical-align: middle;
	
	}


.tienda .Nombre.tienda {
	font-family: Comic Sans MS, cursive;
}
.fuente3 {
	font-family: Palatino Linotype, Book Antiqua, Palatino, serif;
}
.fuente1 {
	font-family: Comic Sans MS, cursive;
}
.tabla div {
	font-family: Palatino Linotype, Book Antiqua, Palatino, serif;
}
.tabla {
	font-family: Palatino Linotype, Book Antiqua, Palatino, serif;
}
.fuente3 {
	font-family: Palatino Linotype, Book Antiqua, Palatino, serif;
}
.tabla {
	font-family: Palatino Linotype, Book Antiqua, Palatino, serif;
}
.tabla {
	font-family: Palatino Linotype, Book Antiqua, Palatino, serif;
}
.formulario form {
	font-family: Comic Sans MS, cursive;
}
.formulario form {
	font-family: Comic Sans MS, cursive;
}
.formulario form input {
	font-family: Comic Sans MS, cursive;
}
</style>

<?php
session_start();
ob_start(); // manejo de salida 
include 'conexion.php';
// verificacion de la salida
if(!isset($_SESSION['username'])) {
	header("Location: Login.php");
	exit();
}
// manejo de acciones de formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$action = $_POST['action'];
	
	if($action == 'agregar') {
		$producto = $_POST['producto'];
		$cantidad = $_POST['cantidad'];
		$precio = $_POST['precio'];
		
		$stmt = $conn->prepare("INSERT INTO ventas (producto, cantidad, precio) VALUES (?, ?, ?)");
		$stmt->bind_param("sid", $producto, $cantidad, $precio);
		
		if ($stmt->execute()) {
			echo "<script>window.location.href='ventas.php';</script>";
			exit();
		} else {
			echo "Error al  cargar la venta: " . $conn->error;
		}
		
		$stmt->close();
	} elseif ($action == 'modificar'){
		$id = $_POST['id'];
		$producto = $_POST['producto'];
		$cantidad = $_POST['cantidad'];
		$precio = $_POST['precio'];
		
		$stmt = $conn->prepare("UPDATE ventas SET producto=?, cantidad=?, precio=? WHERE id=?");
		$stmt->bind_param("sidi", $producto, $cantidad, $precio, $id);
		
		if($stmt->execute()) {
			echo "<script>window.location.href='ventas.php';</script>";
			exit();
		} else {
			echo "Error al modificar la venta: " . $conn->error;
		}
		
		$stmt->close();
	} elseif ($action == 'eliminar') {
		$id = $_POST['id'];
		
		$stmt = $conn->prepare("DELETE FROM ventas WHERE id=?");
		$stmt->bind_param("i", $id);
		
		if ($stmt->execute()) {
			echo "<script> window.location.href='ventas.php';</script>";
			exit();
		} else {
			echo "Error al eliminar la venta: " . $conn->error;
		}
		
		$stmt->close();
	}
}

//Consulta para mostrar todas las ventas
$result = $conn->query("SELECT * FROM ventas");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title> SISTEMA DE VENTAS </title>
</head>

<body bgcolor= "#ECD4FF">

<header> <div class="tienda">  
  <h1 align="center" class= "Nombre tienda"  font-size: small >
    DULCERIA</h1>
  <h1 align="center" class= "Nombre tienda"  font-size: small > YUMMY 🍬</h1>
<h2></div> </header>
<h1 align="center">&nbsp; </h1>
<h1 align="center" class="fuente1">BIENVENIDO, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>

<h2 align="center" class="fuente3"><!--Formulario para agregar una venta --> 
  VENTAS</h2>
 
<div class="formulario">
  <form method="POST" action="ventas.php">
            <input type="hidden" name="action" value="agregar">
            Producto: <input type="text" name="producto" required>
            <br>
            <br>
            Cantidad: <input type="number" name="cantidad" required>
            <br>
            <br>
            Precio: <input type="number" step="0.01" name="precio" required>
            <br>
            <br>
             <button type="submit" class= "btnav"> 
            <div align="center">Agregar Venta</div>
            </button>
  </form>
</div>
    
    <div align="center">
  <!-- Tabla para mostrar ventas y formularios para modificar/eliminar -->
      
  <table border="4">
    <tr>
      
      <tr>
        <th class="tabla"> ID </th>
        <th class="tabla"> Producto </th>
        <th class="tabla"> Cantidad </th>
        <th class="tabla"> <span class="fuente3">Precio </span></th>
        <th class="tabla"> Fecha </th>
        <th class="tabla"> <div align="center">Opciones</div></th>
        </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr class= "tabla">
      <form method="POST" action="ventas.php">
        <td class = "tabla"><?php echo htmlspecialchars($row['id']); ?> </td> 
        <td class="tabla"> <input type="text" name="producto" value="<?php echo htmlspecialchars($row['producto']); ?>" required> </td>
        <td class="tabla"> <input type="number" name="cantidad" value="<?php echo htmlspecialchars($row['cantidad']); ?>" required> </td>
        <td class="tabla"> <input type="number" step="0.01" name="precio" value="<?php echo htmlspecialchars($row['precio']); ?>" required> </td>
        <td class="tabla"> <p><?php echo htmlspecialchars($row['fecha']); ?></p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td>
          <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
          <button type="submit" name="action" value="modificar" class="btnM"> Modificar </button>
          <button type="submit" name="action" value="eliminar" class="btnE"> Eliminar </button>
          </td>
        </form>
      </tr>
    <?php endwhile; ?>
    </table>
    </div>
    <div align="center"><br>
      <br>
      
    </div>
    <div align="center"><a href="Login.php" > Cerrar Sesión </a></div>
 
 <br>
 <br>
</body>
</html>

<footer> </footer>
