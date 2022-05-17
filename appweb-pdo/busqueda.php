<?php

$buscar = $_GET['buscar'];
$msj = null;
try {
    $conn = new PDO("mysql:host=localhost;dbname=pruebas;", "root", "ulisesafcdev", array(
        PDO::ATTR_PERSISTENT => TRUE,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
    
    $query = "SELECT * FROM maquilas WHERE direccion LIKE :busqueda";
    
    $keyfind = "%".$buscar."%";
    
    $stm = $conn->prepare($query);
    $stm->bindParam(":busqueda", $keyfind);
    
    if ($stm->execute()) {
        $msj = "Resultado de la busqueda";
    } else {
        $msj = "Fallo al buscar el registro: " . $stm->errorCode();
    }
    
} catch (PDOException $e) {
    die("Fallo al conectar con la BBDD: " . $e->getMessage());
}

?>

<!DOCTYPE>
<html>
<head>
	<title>Resultado busqueda</title>
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
	   #btnbuscar, #btn{
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
	   #btndelete,
	   #btnupdate{
	       padding: 3px 6px;
	       display: inline-block;
	       border-radius: 3px;
	       color: white;
	       cursor: pointer;
	       text-decoration: none;
	   }
	   #btn{
	       background-color: darkcyan;
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
	</style>
</head>
<body>
	<h1><?= $msj ?></h1>
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
					<td><a href="maquilas.php" id="btn">Ver Todo</a></td>
				</tr>
				
			</table>
		</fieldset>
	</form>
	<hr>
	<table id="datos">
		<thead>
			<tr>
				<th>ID</th>
				<th>NOMBRE EMPRESA</th>
				<th>DIRECCION</th>
				<th>TELEFONO</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
			<?php while($fila = $stm->fetch()) { ?>
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
</body>
</html>