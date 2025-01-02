<style type="text/css">
    div.div1{
        background-color:  #5086c1;
        width: 100%;
		height: 20%;
    }
	table.tabla1{
		font-family: Cursive;
		font-size: 60px;
	}
	div.dos{
        width: 100%;
        height: 50px;
        background-color: #dcffff;
	}
	div.formulario{
		background-color: #b2dafa;
		text-align: center;
		border: 6px dashed  #5086c1;
		width: 40%;
		margin-left: auto;
		margin-right:auto;
	}
	button.btn1{
		margin-top: 50px;
        border-radius: 5px;
        text-align: center;
        width: 40%;
		height: 7%;
        font-size: 20px;
        font-family: Cursive;
        background-color: #5086c1;
        color: #ffffff; 
		border: 0px solid; 
        float: center; 
		}
	button.btn2{
        border-radius: 5px;
        text-align: center;
        width: 95%;
        height: 50px;
        font-size: 70%;
        font-family: Cursive;
        background-color: #5086c1;
        color: #ffffff;  
        border: 0px solid;
        float: center;		
		}
	table.productos{
		font-size: 25;
		text-align: center;
		font-family: Arial;
		background-color: # ;
		width: 90%;
		margin-left: auto;
		margin-right:auto;
	}
	form{
		font-size: 25px;
	}
	input{
		font-size: 25px;
		width: 60%;
		font-family: "Times New Roman", Times, serif;
	}
	input.i1{
		font-size: 25px;
		width: 80%;
		font-family: "Times New Roman", Times, serif;
		text-align:center;
	}
	textarea.c1{
		font-size: 25px;
		width: 60%;
		font-family: "Times New Roman", Times, serif;
		text-align: justify;
		width: 80%;
		height: 100%;
	}
	h2{
	color: #000000;
	font-family: Cursive;
	font-size: 60px;
	}
	div.cerrar{
		text-align: center;
		width: 100%;
	}
	a.btn3{
        border-radius: 5px;
        text-align: center;
        width: 30%;
		height: 10%;
        font-size: 20px;
        font-family: Cursive;
        background-color: #b2dafa;
        color: #000000;
        border: 4px dashed #5086c1;
		text-decoration: none;
		padding: 15px 25px;
		}
	th.tabla{
		border: 6px solid #5086c1;
	}
	td.tabla{
		border: 6px solid #5086c1;
	}
</style>
<?php
session_start();
ob_start();
include 'conexion.php';

if(!isset($_SESSION['username'])) {
	header("Location: Login.php");
	exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$action = $_POST['action'];
	
	if ($action == 'agregar') {
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
	$caracteristicas = $_POST['caracteristicas'];
    $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
    
    $query = "INSERT INTO ventas (producto, cantidad, precio,caracteristicas, imagen) VALUES ('$producto', '$cantidad', '$precio', '$caracteristicas', '$imagen')";
	
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Producto agregado exitosamente.');</script>";
    } else {
        echo "<script>alert('No se pudo realizar la operación. Inténtalo de nuevo.');</script>";
    }
		
	} elseif ($action == 'modificar'){
		$id = $_POST['id'];
		$producto = $_POST['producto'];
		$cantidad = $_POST['cantidad'];
		$precio = $_POST['precio'];
		$caracteristicas = $_POST['caracteristicas'];
		
		$stmt = $conn->prepare("UPDATE ventas SET producto=?, cantidad=?, precio=?, caracteristicas=? WHERE id=?");
		$stmt->bind_param("sdisi", $producto, $cantidad, $precio, $caracteristicas, $id);
		
		if($stmt->execute()) {
			echo "<script>alert('Producto Modificado exitosamente.'); 
			window.location.href='ventas.php'; </script>";
			exit();
		} else {
			echo "<script>alert('No se pudo realizar la operación. Inténtalo de nuevo.');</script>" . $conn->error;
		}
		
	} elseif ($action == 'eliminar') {
		$id = $_POST['id'];
		
		$stmt = $conn->prepare("DELETE FROM ventas WHERE id=?");
		$stmt->bind_param("i", $id);
		
		if ($stmt->execute()) {
			echo "<script>alert('Producto eliminado exitosamente.');</script>";
		} else {
			echo "<script>alert('No se pudo realizar la operación. Inténtalo de nuevo.');</script>" . $conn->error;
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

<body>
<div class="div1">
        <table class="tabla1">
            <tr>
                <td width="8%" height="100%"> <center> <img src="logo.png" width="100%" height="100%"> </center> </td>
	            <td width="2%" height="100%"> </td>
              <td width="65%" height="100%"> Productos de Limpieza </td>
	            <td width="30%" height="100%">
                </td>
          </tr>
        </table>
    </div>
<div class="dos">
</div>
   
<h2 align="center" colspan="2" padding-bottom: 50px> Bienvenid@, <?php echo htmlspecialchars($_SESSION['username']); ?> </h2>

    <!--Formulario para agregar una venta -->
        <div class="formulario">
        <br>
        <br>
        <form method="POST" action="ventas.php" enctype="multipart/form-data">
            <input type="hidden" name="action" value="agregar">
            Nombre del Producto: <input type="text" name="producto" required>
            <br>
            <br>
            Cantidad de Productos: <input type="number" name="cantidad" required>
            <br>
            <br>
            Precio del Producto:   <input type="number" name="precio" required>
            <br>
            <br>
            Características del Producto:   
            <br>
            <textarea name="caracteristicas" rows="8" cols="30" required> </textarea>
            <br>
            <br>
            <label> Imagen del Producto: </label>
            <br>
		<input type="file" name="imagen" required>
            <button type="submit" class="btn1" id="alta"> Agregar Venta </button>
    </form>
</div>
<br>
<br>
<br>
    
    <!-- Tabla para mostrar ventas y formularios para modificar/eliminar -->
    <table class="productos">
        <tr>
            <th class="tabla"> ID </th>
            <th class="tabla"> Producto </th>
            <th class="tabla"> Cantidad </th>
            <th class="tabla"> Precio </th>
            <th class="tabla"> 	Características </th>
            <th class="tabla"> Fecha </th>
            <th class="tabla"> Imagen </th>
            <th class="tabla"> Acciones </th>
        </tr>
        <?php while ($data = $result->fetch_assoc()): ?>
		<tr class="tabla">
            <form method="POST" action="ventas.php">
                <td class="tabla"><?php echo htmlspecialchars($data['id']); ?> </td>
                <td class="tabla"> <input type="text" class="i1" name="producto" value="<?php echo htmlspecialchars($data['producto']); ?>" required> </td>
                <td class="tabla"> <input type="number" class="i1" name="cantidad" value="<?php echo htmlspecialchars($data['cantidad']); ?>" required> </td>
                <td class="tabla"> <input type="number" class="i1" step="0.1" name="precio" value="<?php echo htmlspecialchars($data['precio']); ?>" required> </td>
                <td class="tabla"> <textarea type="text" name="caracteristicas" class="c1" required><?php echo htmlspecialchars($data['caracteristicas']); ?> </textarea> </td>
                <td class="tabla"> <?php echo htmlspecialchars($data['fecha']); ?> </td>
                <td class="tabla"> <img height="50%" width="90%" src="data:image/jpg;base64, <?php echo base64_encode($data['imagen'])?>"> </img> </td>
                <td class="tabla">
                    <input type="hidden" class="i1" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">
                    <br>
                    <button type="submit" name="action" value="modificar" class="btn2" id="modificar"> Modificar </button>
                    <br>
                    <br>
                    <button type="submit" name="action" value="eliminar" class="btn2" id="eliminar"> Eliminar </button>
                    <br>
                    <br>
                </td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <br>
    <div class="cerrar">
    <a href="Login.php" class="btn3"> Cerrar Sesión </a>
    </div>
    <br>
    <br>
</body>
</html>

<footer> </footer>