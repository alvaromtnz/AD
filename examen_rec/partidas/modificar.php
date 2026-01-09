<?php
require_once("../dbutils.php");
$db = conectarDB();
$partida = null;

if(isset($_POST['buscar'])) {
    $partida = getPartidaPorId($db, $_POST['id']);
}

if(isset($_POST['modificar'])) {
    modificarPartida($db, $_POST['id'], $_POST['puntuacion']);
    echo "<p>Partida modificada correctamente</p>";
    $partida = getPartidaPorId($db, $_POST['id']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modificar Partida</title>
</head>
<body>
    <h1>Modificar Partida (Puntuación)</h1>
    <p><a href="listar.php">Volver a la lista</a></p>
    
    <form method="post">
        <p>ID: <input type="number" name="id" required></p>
        <p><button type="submit" name="buscar">Buscar</button></p>
    </form>
    
    <?php if($partida) { ?>
    <hr>
    <p>Partida encontrada: Player <?php echo $partida['ID_PLAYER']; ?> - Game <?php echo $partida['ID_GAME']; ?></p>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $partida['ID']; ?>">
        <p>Nueva puntuación: <input type="number" name="puntuacion" value="<?php echo $partida['PUNTUACION']; ?>" required></p>
        <p><button type="submit" name="modificar">Modificar</button></p>
    </form>
    <?php } ?>
</body>
</html>
