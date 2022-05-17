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
    die("Fallo al conectar con la BBDD: " . $e->getMessage());
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
	   #btndelete{
	       width: auto;
	       padding: 6px 16px;
	       border-radius: 3px;
	       color: white;
	       text-decoration: none;
	       text-transform: uppercase;
	   }
	   #btndelete{
	       background-color: #EB5353;
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
		Vista previa del registro a eliminar. Antes de eliminar recordar que ya no podras recuperar el registro.
	</p>
	
	<hr>
	<br>
	<a href="maquilas.php" id="btn">Regresar a inicio</a>
	<br>
	<br>
	<hr>
	<table id="datos">
		<thead>
			<tr>
				<th>NOMBRE EMPRESA</th>
				<th>DIRECCION</th>
				<th>TELEFONO</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($fila = $stm->fetch()) { ?>
			<tr>
				<td><?= $fila['nombre_empresa'] ?></td>
				<td><?= $fila['direccion'] ?></td>
				<td><?= $fila['telefono'] ?></td>
				<td><a href="delete.php?id=<?= $fila['id'] ?>" id="btndelete">Eliminar</a></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
	<hr>
</body>
</html>