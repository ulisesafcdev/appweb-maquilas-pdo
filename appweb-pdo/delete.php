<?php

$id = $_GET['id'];
$msj = "";

try {
    $conn = new PDO("mysql:host=localhost;dbname=pruebas;", "root", "ulisesafcdev", array(
        PDO::ATTR_PERSISTENT => TRUE,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
    
    $query = "DELETE FROM maquilas WHERE id = :id";
    
    $stm = $conn->prepare($query);
    $stm->bindParam(":id", $id);
    
    if($stm->execute()){
        $msj = "Se elimino correctamente...";
    } else {
        $msj = "No se pudo eliminar el registro...";
    }
} catch (PDOException $e) {
    die("Fallo al conectar con la BBDD: " . $e->getMessage());
}

?>

<!DOCTYPE>
<html>

<head>
	<title>Detalles</title>
	<style type="text/css">
	   *{
	       font-family: monospace;
	   }
	   
	   a{
	       background-color: #222;
	       color: #fff;
	       padding: 7px 15px;
	       border-radius: 3px;
	       text-decoration: none;
	       text-transform: uppercase;
	   }
	   
	   a:hover{
	       background-color: #333;
	   }
	</style>
</head>

<body>
	<h1><?= $msj ?></h1>
	<a href="maquilas.php">Regresar a inicio</a>
</body>

</html>