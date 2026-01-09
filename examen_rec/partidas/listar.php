<?php
require_once("../dbutils.php");
$db = conectarDB();
$partidas = getTodasPartidas($db);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listar Partidas</title>
</head>
<body>
    <h1>Lista de PARTIDAS</h1>
    <p><a href="../index.php">Volver al inicio</a></p>
    
    <p>
        <a href="insertar.php">Insertar</a> | 
        <a href="modificar.php">Modificar</a> | 
        <a href="borrar.php">Borrar</a>
    </p>
    
    <table border="1">
        <tr><th>ID</th><th>ID_PLAYER</th><th>ID_GAME</th><th>PUNTUACION</th></tr>
        <?php foreach($partidas as $p) { ?>
        <tr>
            <td><?php echo $p['ID']; ?></td>
            <td><?php echo $p['ID_PLAYER']; ?></td>
            <td><?php echo $p['ID_GAME']; ?></td>
            <td><?php echo $p['PUNTUACION']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
