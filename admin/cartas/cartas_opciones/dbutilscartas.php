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
        $sql = "SELECT * FROM MAZOS";
        $stmt = $conDb->query($sql);
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $vectorTotal[] = $fila;
        }
    } catch (PDOException $ex) {
        echo ("Error al conectar" . $ex->getMessage());
    }
    return $vectorTotal;
}
function getAllCartas($conDb)
{
    $vectorTotal = array();
    try {
        $sql = "SELECT * FROM CARTAS";
        $stmt = $conDb->query($sql);
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $vectorTotal[] = $fila;
        }
    } catch (PDOException $ex) {
        echo ("Error al conectar" . $ex->getMessage());
    }
    return $vectorTotal;
}

function getCarta($conDb, $id)
{
    try {
        $sql = "SELECT * FROM CARTAS WHERE ID=:id";
        $stmt = $conDb->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stmt->execute(array(":id" => $id));
        $fila = $stmt->fetchAll();
    } catch (PDOException $ex) {
        echo ("Error getCarta" . $ex->getMessage());
    }
    return $fila;
}

function insertarCarta($con, $nombre, $fecha, $imagen, $mazo)
{
    try {
        $sql = "INSERT INTO CARTAS(NOMBRE,FECHA,IMAGEN,ID_MAZO) VALUES (:NOMBRE,:FECHA,:IMAGEN,:ID_MAZO)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':NOMBRE', $nombre);
        $stmt->bindParam(':FECHA', $fecha);
        $stmt->bindParam(':IMAGEN', $imagen);
        $stmt->bindParam(':ID_MAZO', $mazo);
        $stmt->execute();
    } catch (PDOException $ex) {
        echo ("Error en insertarCarta" . $ex->getMessage());
    }
    return $con->lastInsertId();
}
function borrarCarta($con, $id)
{
    try {
        $sql = "DELETE FROM CARTAS WHERE ID=:ID";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':ID', $id);
        $stmt->execute();
        $result = $stmt->rowCount();
    } catch (PDOException $ex) {
        echo ("Error en borrarCarta" . $ex->getMessage());
    }
    return $result;
}

function modificarCarta($conDb, $id, $nombre, $fecha, $imagen, $mazo)
{
    $result = 0;
    try {
        $sql = "UPDATE CARTAS SET NOMBRE=:nombre, FECHA=:fecha, IMAGEN=:imagen, ID_MAZO=:mazo WHERE ID=:carta";
        $stmt = $conDb->prepare($sql);
        $stmt->bindParam(':mazo', $mazo, PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->bindParam(':imagen', $imagen, PDO::PARAM_STR);
        $stmt->bindParam(':carta', $id, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->rowCount();
    } catch (PDOException $ex) {
        echo ("Error en modificarMazo" . $ex->getMessage());
    }
    return $result;
}
