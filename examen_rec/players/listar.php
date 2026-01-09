<?php
require_once("../dbutils.php");
$db = conectarDB();
$players = getTodosPlayers($db);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listar Players</title>
</head>
<body>
    <h1>Lista de PLAYERS</h1>
    <p><a href="../index.php">Volver al inicio</a></p>
    
    <p>
        <a href="insertar.php">Insertar</a> | 
        <a href="modificar.php">Modificar</a> | 
        <a href="borrar.php">Borrar</a>
    </p>
    
    <table border="1">
        <tr><th>ID</th><th>NOMBRE</th><th>EMAIL</th></tr>
        <?php foreach($players as $p) { ?>
        <tr>
            <td><?php echo $p['ID']; ?></td>
            <td><?php echo $p['NOMBRE']; ?></td>
            <td><?php echo $p['EMAIL']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
