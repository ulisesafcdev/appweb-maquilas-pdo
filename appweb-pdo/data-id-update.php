<?php

$id = $_GET['id'];

try {
    $conn = new PDO("mysql:host=localhost;dbname=pruebas;", "root", "ulisesafcdev", array(
        PDO::ATTR_PERSISTENT => TRUE,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
    
    $query = "SELECT * FROM maquilas WHERE id = :id";
    
    $stm = $conn->prepare($query);
    $stm->bindParam(":id", $id);
    $stm->execute();
    
} catch (PDOException $e) {
    die("Fallo al conectar a la BBDD: " . $e->getMessage());
}

?>

<!DOCTYPE>
<html>
<head>
	<title>Registro</title>
	<style type="text/css">
	   *{
	       font-family: monospace;
	   }
	   #datos {
	       text-align: center;
	   }
	   #datos > tr, td, th {
	       border: none;
	       border-collapse: collapse;
	       padding: 10px 12px;
	   }
	   #datos > thead {
	       background-color: #B5EAEA;
	   }
	   #datos > tbody {
	       background-color: #EDF6E5;
	   }
	   #btn,
	   #btnupdate{
	       width: auto;
	       padding: 6px 16px;
	       border-radius: 3px;
	       border: none;
	       color: white;
	       text-decoration: none;
	       text-transform: uppercase;
	       cursor: pointer;
	   }
	   #btnupdate{
	       background-color: #2155CD;
	   }
	   #btn{
	       background-color: #222;
	   }
	   #btn:hover{
	       background-color: #333;
	   }
	</style>
</head>

<body>
	<h1>Detalles del registro</h1>
	<p>
		Datos del registro que puedes editar. Antes de editar recuerda que estas cambiando los datos y no podran recuperarse una vez guardado los cambios.
	</p>
	
	<hr>
	<br>
	<a href="maquilas.php" id="btn">Regresar a inicio</a>
	<br>
	<br>
	<hr>
	<form action="update.php" method="post">
		<?php while ($fila = $stm->fetch()) { ?>
		<fieldset>
			<legend>Actualizar datos</legend>
			<table>
				<tr>
					<td><input type="hidden" name="id" value="<?= $fila['id'] ?>"></td>
				</tr>
				<tr>
					<td>Nombre de la empresa:</td>
					<td><input type="text" name="nombre" value="<?= $fila['nombre_empresa'] ?>" size="100"></td>
				</tr>
				<tr>
					<td>Direccion de la empresa:</td>
					<td><input type="text" name="direccion" value="<?= $fila['direccion'] ?>" size="100"></td>
				</tr>
				<tr>
					<td>Telefono:</td>
					<td><input type="text" name="telefono" value="<?= $fila['telefono'] ?>"></td>
				</tr>
				<tr>
					<td><input type="submit" value="Actualizar" id="btnupdate"></td>
				</tr>
			</table>
		</fieldset>
		<?php } ?>
	</form>
	<hr>
</body>
</html>