<?php
require_once("../dbutils.php");

if(isset($_POST['insertar'])) {
    $db = conectarDB();
    insertarPartida($db, $_POST['id_player'], $_POST['id_game'], $_POST['puntuacion']);
    echo "<p>Partida insertada correctamente</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Insertar Partida</title>
</head>
<body>
    <h1>Insertar Partida</h1>
    <p><a href="listar.php">Volver a la lista</a></p>
    
    <form method="post">
        <p>ID Player: <input type="number" name="id_player" required></p>
        <p>ID Game: <input type="number" name="id_game" required></p>
        <p>Puntuación: <input type="number" name="puntuacion" value="0" required></p>
        <p><button type="submit" name="insertar">Insertar</button></p>
    </form>
</body>
</html>
