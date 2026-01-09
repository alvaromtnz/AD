<?php
require_once("../dbutils.php");
$db = conectarDB();
$game = null;

if(isset($_POST['buscar'])) {
    $game = getGamePorId($db, $_POST['id']);
}

if(isset($_POST['modificar'])) {
    modificarGame($db, $_POST['id'], $_POST['descripcion']);
    echo "<p>Game modificado correctamente</p>";
    $game = getGamePorId($db, $_POST['id']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modificar Game</title>
</head>
<body>
    <h1>Modificar Game (Descripción)</h1>
    <p><a href="listar.php">Volver a la lista</a></p>
    
    <form method="post">
        <p>ID: <input type="number" name="id" required></p>
        <p><button type="submit" name="buscar">Buscar</button></p>
    </form>
    
    <?php if($game){ ?>
    <hr>
    <p>Game encontrado: <?php echo $game['NOMBRE']; ?> (<?php echo $game['CATEGORIA']; ?>)</p>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $game['ID']; ?>">
        <p>Nueva descripción: <input type="text" name="descripcion" value="<?php echo $game['DESCRIPCION']; ?>" required></p>
        <p><button type="submit" name="modificar">Modificar</button></p>
    </form>
    <?php } ?>
</body>
</html>
