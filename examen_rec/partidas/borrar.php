<?php
require_once("../dbutils.php");
$db = conectarDB();
$partida = null;

if(isset($_POST['buscar'])) {
    $partida = getPartidaPorId($db, $_POST['id']);
}

if(isset($_POST['borrar'])) {
    borrarPartida($db, $_POST['id']);
    echo "<p>Partida borrada correctamente</p>";
    $partida = null;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Borrar Partida</title>
</head>
<body>
    <h1>Borrar Partida</h1>
    <p><a href="listar.php">Volver a la lista</a></p>
    
    <form method="post">
        <p>ID: <input type="number" name="id" required></p>
        <p><button type="submit" name="buscar">Buscar</button></p>
    </form>
    
    <?php if($partida) { ?>
    <hr>
    <p>Partida encontrada: ID <?php echo $partida['ID']; ?> - Player <?php echo $partida['ID_PLAYER']; ?> - Game <?php echo $partida['ID_GAME']; ?> - Puntos <?php echo $partida['PUNTUACION']; ?></p>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $partida['ID']; ?>">
        <p><button type="submit" name="borrar" onclick="return confirm('¿Seguro?')">Borrar</button></p>
    </form>
    <?php } ?>
</body>
</html>
