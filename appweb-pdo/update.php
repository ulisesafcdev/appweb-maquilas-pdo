<?php

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$msj = null;

try {
    $conn = new PDO("mysql:host=localhost;dbname=pruebas;", "root", "ulisesafcdev", array(
        PDO::ATTR_PERSISTENT => TRUE,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
    
    $query = "UPDATE maquilas SET nombre_empresa = :nombre, direccion = :direccion, telefono = :telefono WHERE id = :id";
    
    $stm = $conn->prepare($query);
    $stm->bindParam(":nombre", $nombre);
    $stm->bindParam(":direccion", $direccion);
    $stm->bindParam(":telefono", $telefono);
    $stm->bindParam(":id", $id);
    
    if($stm->execute()){
        $msj = "Se actualizaron los datos del registro...";
    } else {
        $msj = "Fallo al actualizar los datos: " . $stm->errorCode();
    }
    
} catch (PDOException $e) {
    die("Fallo al conectar a la BBDD: " . $e->getMessage());
}


?>

<!DOCTYPE>
<html>
<head>
	<title>Resultado</title>
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
	   #btn{
	       width: auto;
	       padding: 6px 16px;
	       border-radius: 3px;
	       color: white;
	       text-decoration: none;
	       text-transform: uppercase;
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
	<h1><?= $msj ?></h1>
	<hr>
	<table id="datos">
		<thead>
			<tr>
				<th>NOMBRE EMPRESA</th>
				<th>DIRECCION</th>
				<th>TELEFONO</th>
			<tr>
		</thead>
		<tbody>
			<tr>
				<td><?= $nombre ?></td>
				<td><?= $direccion ?></td>
				<td><?= $telefono ?></td>
			</tr>
		</tbody>
	</table>
	<hr>
	<a href="maquilas.php" id="btn">Regresar a inicio</a>
</body>
</html>













