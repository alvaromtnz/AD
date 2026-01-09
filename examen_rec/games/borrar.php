<?php
require_once("../dbutils.php");
$db = conectarDB();
$game = null;

if(isset($_POST['buscar'])) {
    $game = getGamePorId($db, $_POST['id']);
}

if(isset($_POST['borrar'])) {
    borrarGame($db, $_POST['id']);
    echo "<p>Game borrado correctamente</p>";
    $game = null;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Borrar Game</title>
</head>
<body>
    <h1>Borrar Game</h1>
    <p><a href="listar.php">Volver a la lista</a></p>
    
    <form method="post">
        <p>ID: <input type="number" name="id" required></p>
        <p><button type="submit" name="buscar">Buscar</button></p>
    </form>
    
    <?php if($game){ ?>
    <hr>
    <p>Game encontrado: <?php echo $game['ID']; ?> - <?php echo $game['NOMBRE']; ?></p>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $game['ID']; ?>">
        <p><button type="submit" name="borrar" onclick="return confirm('¿Seguro?')">Borrar</button></p>
    </form>
    <?php } ?>
</body>
</html>
