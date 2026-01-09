<?php
require_once("../dbutils.php");

if(isset($_POST['insertar'])) {
    $db = conectarDB();
    insertarGame($db, $_POST['nombre'], $_POST['descripcion'], $_POST['categoria']);
    echo "<p>Game insertado correctamente</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Insertar Game</title>
</head>
<body>
    <h1>Insertar Game</h1>
    <p><a href="listar.php">Volver a la lista</a></p>
    
    <form method="post">
        <p>Nombre: <input type="text" name="nombre" required></p>
        <p>Descripción: <input type="text" name="descripcion" required></p>
        <p>Categoría: <input type="text" name="categoria" required></p>
        <p><button type="submit" name="insertar">Insertar</button></p>
    </form>
</body>
</html>
