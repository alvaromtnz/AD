<?php
require_once("../dbutils.php");
$db = conectarDB();
$games = getTodosGames($db);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listar Games</title>
</head>
<body>
    <h1>Lista de GAMES</h1>
    <p><a href="../index.php">Volver al inicio</a></p>
    
    <p>
        <a href="insertar.php">Insertar</a> | 
        <a href="modificar.php">Modificar</a> | 
        <a href="borrar.php">Borrar</a>
    </p>
    
    <table border="1">
        <tr><th>ID</th><th>NOMBRE</th><th>DESCRIPCION</th><th>CATEGORIA</th></tr>
        <?php foreach($games as $g){ ?>
        <tr>
            <td><?php echo $g['ID']; ?></td>
            <td><?php echo $g['NOMBRE']; ?></td>
            <td><?php echo $g['DESCRIPCION']; ?></td>
            <td><?php echo $g['CATEGORIA']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
