<?php
function conectarDB()
{
    try {
        $db = new PDO("mysql:host=localhost;dbname=timeline_db;charset=utf8mb4", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $ex) {
        echo ("Error al conectar" . $ex->getMessage());
    }
}

function getAllMazos($conDb)
{
    $vectorTotal = array();
    try {
        $sql = "SELECT * FROM MAZOS ";
        $stmt = $conDb->query($sql);
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $vectorTotal[] = $fila;
        }
    } catch (PDOException $ex) {
        echo ("Error al conectar" . $ex->getMessage());
    }
    return $vectorTotal;
}
function insertarPuntuacion($conDb, $nombre, $puntuacion, $mazo)
{
    try {
        $sql = "INSERT INTO RANKING(NOMBRE,PUNTUACION,MAZO) VALUES (:NOMBRE,:PUNTUACION,:MAZO)";
        $stmt = $conDb->prepare($sql);
        $stmt->bindParam(':NOMBRE', $nombre);
        $stmt->bindParam(':PUNTUACION', $puntuacion);
        $stmt->bindParam(':MAZO', $mazo);
        $stmt->execute();
    } catch (PDOException $ex) {
        echo ("Error en insertarCarta" . $ex->getMessage());
    }
    return $conDb->lastInsertId();
}
function getRanking($conDb)
{
    $vectorTotal = array();
    try {
        $sql = "SELECT * FROM RANKING ORDER BY PUNTUACION DESC LIMIT 10 ";
        $stmt = $conDb->query($sql);
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $vectorTotal[] = $fila;
        }
    } catch (PDOException $ex) {
        echo ("Error al conectar" . $ex->getMessage());
    }
    return $vectorTotal;
}

function modificarIniciales($conDb, $nombre, $id)
{
    $result = 0;
    try {
        $sql = "UPDATE RANKING SET NOMBRE=:nombre WHERE ID=:id";
        $stmt = $conDb->prepare($sql);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->rowCount();
    } catch (PDOException $ex) {
        echo ("Error en modificarMazo" . $ex->getMessage());
    }
    return $result;
}
