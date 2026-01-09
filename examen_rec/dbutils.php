<?php
function conectarDB() {
    $db = new PDO("mysql:host=localhost;dbname=BD_GAMES", "root", "");
    return $db;
}

// PLAYERS
function getTodosPlayers($db) {
    $stmt = $db->query("SELECT * FROM PLAYERS");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPlayerPorId($db, $id) {
    $stmt = $db->prepare("SELECT * FROM PLAYERS WHERE ID = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function insertarPlayer($db, $nombre, $email) {
    $stmt = $db->prepare("INSERT INTO PLAYERS(NOMBRE, EMAIL) VALUES (?, ?)");
    $stmt->execute([$nombre, $email]);
    return $db->lastInsertId();
}

function modificarPlayer($db, $id, $nombre) {
    $stmt = $db->prepare("UPDATE PLAYERS SET NOMBRE = ? WHERE ID = ?");
    $stmt->execute([$nombre, $id]);
    return $stmt->rowCount();
}

function borrarPlayer($db, $id) {
    $stmt = $db->prepare("DELETE FROM PLAYERS WHERE ID = ?");
    $stmt->execute([$id]);
    return $stmt->rowCount();
}

// GAMES
function getTodosGames($db) {
    $stmt = $db->query("SELECT * FROM GAMES");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getGamePorId($db, $id) {
    $stmt = $db->prepare("SELECT * FROM GAMES WHERE ID = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function insertarGame($db, $nombre, $descripcion, $categoria) {
    $stmt = $db->prepare("INSERT INTO GAMES(NOMBRE, DESCRIPCION, CATEGORIA) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $descripcion, $categoria]);
    return $db->lastInsertId();
}

function modificarGame($db, $id, $descripcion) {
    $stmt = $db->prepare("UPDATE GAMES SET DESCRIPCION = ? WHERE ID = ?");
    $stmt->execute([$descripcion, $id]);
    return $stmt->rowCount();
}

function borrarGame($db, $id) {
    $stmt = $db->prepare("DELETE FROM GAMES WHERE ID = ?");
    $stmt->execute([$id]);
    return $stmt->rowCount();
}

// PARTIDAS
function getTodasPartidas($db) {
    $stmt = $db->query("SELECT * FROM PARTIDAS");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPartidaPorId($db, $id) {
    $stmt = $db->prepare("SELECT * FROM PARTIDAS WHERE ID = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function insertarPartida($db, $id_player, $id_game, $puntuacion) {
    $stmt = $db->prepare("INSERT INTO PARTIDAS(ID_PLAYER, ID_GAME, PUNTUACION) VALUES (?, ?, ?)");
    $stmt->execute([$id_player, $id_game, $puntuacion]);
    return $db->lastInsertId();
}

function modificarPartida($db, $id, $puntuacion) {
    $stmt = $db->prepare("UPDATE PARTIDAS SET PUNTUACION = ? WHERE ID = ?");
    $stmt->execute([$puntuacion, $id]);
    return $stmt->rowCount();
}

function borrarPartida($db, $id) {
    $stmt = $db->prepare("DELETE FROM PARTIDAS WHERE ID = ?");
    $stmt->execute([$id]);
    return $stmt->rowCount();
}

// ESTADISTICAS
function contarPlayers($db) {
    return $db->query("SELECT COUNT(*) FROM PLAYERS")->fetchColumn();
}

function contarGames($db) {
    return $db->query("SELECT COUNT(*) FROM GAMES")->fetchColumn();
}

function contarPartidas($db) {
    return $db->query("SELECT COUNT(*) FROM PARTIDAS")->fetchColumn();
}

function jugadoresConNPartidas($db, $n) {
    $stmt = $db->prepare("SELECT COUNT(*) FROM PLAYERS WHERE ID IN (SELECT ID_PLAYER FROM PARTIDAS GROUP BY ID_PLAYER HAVING COUNT(*) = ?)");
    $stmt->execute([$n]);
    return $stmt->fetchColumn();
}

function jugadoresConMasDeNPartidas($db, $n) {
    $stmt = $db->prepare("SELECT COUNT(*) FROM PLAYERS WHERE ID IN (SELECT ID_PLAYER FROM PARTIDAS GROUP BY ID_PLAYER HAVING COUNT(*) > ?)");
    $stmt->execute([$n]);
    return $stmt->fetchColumn();
}
?>
