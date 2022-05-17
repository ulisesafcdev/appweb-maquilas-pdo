<?php

$page = $_SERVER['PHP_SELF'];

try {
    $conn = new PDO("mysql:host=localhost;dbname=pruebas;", "root", "ulisesafcdev", array(
        PDO::ATTR_PERSISTENT => TRUE,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
    
    if(isset($_POST['submit'])){
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        
        $query = "INSERT INTO maquilas(nombre_empresa, direccion, telefono) VALUES(:nombre, :direccion, :telefono)";
        $stm = $conn->prepare($query);
        $stm->bindParam(":nombre", $nombre);
        $stm->bindParam(":direccion", $direccion);
        $stm->bindParam(":telefono", $telefono);
        $stm->execute();
    }
    
    $query = "SELECT * FROM maquilas";
    $stm = $conn->prepare($query);
    $stm->execute();

} catch (PDOException $e) {
    die("Fallo al conectar con la BBDD: " . $e->getMessage());
}

?>

<!DOCTYPE>
<html lang="es">

<head>
	<title>Listado Maquilas SV</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
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
	       padding: 4px 12px;
	   }
	   #datos > thead {
	       background-color: #B5EAEA;
	   }
	   #datos > tbody {
	       background-color: #EDF6E5;
	   }
	   #btndelete,
	   #btnupdate{
	       width: auto;
	       padding: 3px 6px;
	       display: inline-block;
	       border-radius: 3px;
	       border: 1px solid black;
	       color: white;
	       cursor: pointer;
	   }
	   #btnbuscar{
	       padding: 6px 16px;
	       display: inline-block;
	       border-radius: 3px;
	       color: white;
	       cursor: pointer;
	   }
	   #btnbuscar{
	       background-color: #222;
	   }
	   #btnbuscar:hover{
	       background-color: #333;
	   }
	   #btndelete {
	       background-color: #9C0F48;
	   }
	   #btnupdate {
	       background-color: #233E8B;
	   }
	   #btnregistro{
	       background-color: #66DE93;
	       padding: 6px 18px;
	       border: none;
	       outline: none;
	       cursor: pointer;
	       border-radius: 5px;
	       text-transform: uppercase;
	   }
	   #btnregistro:hover{
	       background-color: #36DE93;
	   }
	   form * input{
	       outline: none;
	   }
	</style>
</head>

<body>
	<h1>Maquilas en El Salvador</h1>
	<p>
		Listado de maquilas registradas en EL SALVADOR
	</p>
	<hr>
	<form action="busqueda.php" method="get">
		<fieldset>
			<legend>Buscar por</legend>
			<table>
				<tr>
					<td>Referencia</td>
					<td><input type="text" name="buscar" size="50" required="required"></td>
				</tr>
				<tr>
					<td><input type="submit" value="Buscar" id="btnbuscar"></td>
				</tr>
			</table>
		</fieldset>
	</form>
	<hr>
	<table id="datos">
		<thead>
			<tr>
				<th>ID</th>
				<th>NOMBRE MAQUILA</th>
				<th>DIRECION</th>
				<th>TELEFONO</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($fila = $stm->fetch()) { ?>
			<tr>
				<td><?= $fila['id'] ?></td>
				<td><?= $fila['nombre_empresa'] ?></td>
				<td><?= $fila['direccion'] ?></td>
				<td><?= $fila['telefono'] ?></td>
				<td>
					<a href="data-id-delete.php?id=<?= $fila['id'] ?>" id="btndelete"><i class="bi bi-trash3"></i></a>
					<a href="data-id-update.php?id=<?= $fila['id'] ?>" id="btnupdate"><i class="bi bi-file-check"></i></a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<hr>
	<h3>Formulario de Registro de Maquilas</h3>
	<p>
		Todos los campos son obligatorios*
	</p>
	
	<form action="<?= $page ?>" method="post">
		<fieldset>
			<legend>Datos de la empresa</legend>
			<table id="registro">
				<tr>
					<td>Nombre de la empresa</td>
					<td><input type="text" name="nombre" size="100" required="required"></td>
				</tr>
				<tr>
					<td>Direccion de la empresa</td>
					<td><input type="text" name="direccion" size="100" required="required"></td>
				</tr>
				<tr>
					<td>Telefono de la empresa</td>
					<td><input type="text" name="telefono" required="required"></td>
				</tr>
				<tr>
					<td><input type="submit" value="Guardar" id="btnregistro" name="submit"></td>
				</tr>
			</table>
		</fieldset>
	</form>
	<hr>
	<br>
	<br>
	<br>
	<p>
		Desarrollado por <a href="www.twitter.com/ulisesafcdev" target="blank">@ulisesafcdev</a>
	</p>
</body>

</html>