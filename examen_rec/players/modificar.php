<?php
require_once("../dbutils.php");
$db = conectarDB();
$player = null;

if(isset($_POST['buscar'])) {
    $player = getPlayerPorId($db, $_POST['id']);
}

if(isset($_POST['modificar'])) {
    modificarPlayer($db, $_POST['id'], $_POST['nombre']);
    echo "<p>Player modificado correctamente</p>";
    $player = getPlayerPorId($db, $_POST['id']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modificar Player</title>
</head>
<body>
    <h1>Modificar Player (Nombre)</h1>
    <p><a href="listar.php">Volver a la lista</a></p>
    
    <form method="post">
        <p>ID: <input type="number" name="id" required></p>
        <p><button type="submit" name="buscar">Buscar</button></p>
    </form>
    
    <?php if($player) { ?>
    <hr>
    <p>Player encontrado: <?php echo $player['NOMBRE']; ?> (<?php echo $player['EMAIL']; ?>)</p>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $player['ID']; ?>">
        <p>Nuevo nombre: <input type="text" name="nombre" value="<?php echo $player['NOMBRE']; ?>" required></p>
        <p><button type="submit" name="modificar">Modificar</button></p>
    </form>
    <?php } ?>
</body>
</html>
