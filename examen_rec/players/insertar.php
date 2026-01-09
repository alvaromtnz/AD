<?php
require_once("../dbutils.php");

if(isset($_POST['insertar'])) {
    $db = conectarDB();
    insertarPlayer($db, $_POST['nombre'], $_POST['email']);
    echo "<p>Player insertado correctamente</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Insertar Player</title>
</head>
<body>
    <h1>Insertar Player</h1>
    <p><a href="listar.php">Volver a la lista</a></p>
    
    <form method="post">
        <p>Nombre: <input type="text" name="nombre" required></p>
        <p>Email: <input type="email" name="email" required></p>
        <p><button type="submit" name="insertar">Insertar</button></p>
    </form>
</body>
</html>
