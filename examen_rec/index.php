<?php
require_once("dbutils.php");
$db = conectarDB();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestión</title>
</head>
<body>
    <h1>Sistema de Gestión BD_GAMES</h1>
    
    <h2>Menú</h2>
    <ul>
        <li><a href="players/listar.php">Gestionar PLAYERS</a></li>
        <li><a href="games/listar.php">Gestionar GAMES</a></li>
        <li><a href="partidas/listar.php">Gestionar PARTIDAS</a></li>
    </ul>
    
    <h2>Resumen</h2>
    <table border="1">
        <tr><td>Total Players</td><td><?php echo contarPlayers($db); ?></td></tr>
        <tr><td>Total Games</td><td><?php echo contarGames($db); ?></td></tr>
        <tr><td>Total Partidas</td><td><?php echo contarPartidas($db); ?></td></tr>
        <tr><td>Jugadores con 2 partidas</td><td><?php echo jugadoresConNPartidas($db, 2); ?></td></tr>
        <tr><td>Jugadores con 3 partidas</td><td><?php echo jugadoresConNPartidas($db, 3); ?></td></tr>
        <tr><td>Jugadores con más de 3 partidas</td><td><?php echo jugadoresConMasDeNPartidas($db, 3); ?></td></tr>
    </table>
</body>
</html>
