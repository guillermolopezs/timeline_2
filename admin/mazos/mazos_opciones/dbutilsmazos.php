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
function insertarMazo($conDb, $nombre, $descripcion)
{
    try {
        $sql = "INSERT INTO MAZOS(NOMBRE,DESCRIPCION) VALUES (:NOMBRE,:DESCRIPCION)";
        $stmt = $conDb->prepare($sql);
        $stmt->bindParam(':NOMBRE', $nombre);
        $stmt->bindParam(':DESCRIPCION', $descripcion);
        $stmt->execute();
    } catch (PDOException $ex) {
        echo ("Error en insertarCarta" . $ex->getMessage());
    }
    return $conDb->lastInsertId();
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
function borrarMazo($conDb, $id)
{
    try {
        $sql = "DELETE FROM MAZOS WHERE ID=:ID";
        $stmt = $conDb->prepare($sql);
        $stmt->bindParam(':ID', $id);
        $stmt->execute();
        $result = $stmt->rowCount();
    } catch (PDOException $ex) {
        echo ("Error en borrarMazos" . $ex->getMessage());
    }
    return $result;
}

function modificarCarta($conDb, $nombre, $fecha, $imagen, $mazo)
{
    $result = 0;
    try {
        $sql = "UPDATE MAZO SET NOMBRE=:nombre WHERE FECHA=:fecha AND IMAGEN=:imagen AND ID_MAZO=:mazo";
        $stmt = $conDb->prepare($sql);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->bindParam(':imagen', $imagen, PDO::PARAM_STR);
        $stmt->bindParam(':mazo', $mazo, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->rowCount();
    } catch (PDOException $ex) {
        echo ("Error en modificarCarta" . $ex->getMessage());
    }
    return $result;
}
function modificarMazoNombre($conDb, $nombre, $mazo)
{
    $result = 0;
    try {
        $sql = "UPDATE MAZOS SET NOMBRE=:nombre WHERE ID=:mazo";
        $stmt = $conDb->prepare($sql);
        $stmt->bindParam(':mazo', $mazo, PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->rowCount();
    } catch (PDOException $ex) {
        echo ("Error en modificarCarta" . $ex->getMessage());
    }
    return $result;
}
function modificarMazo($conDb, $nombre, $descripcion, $mazo)
{
    $result = 0;
    try {
        $sql = "UPDATE MAZOS SET NOMBRE=:nombre, DESCRIPCION=:descripcion WHERE ID=:mazo";
        $stmt = $conDb->prepare($sql);
        $stmt->bindParam(':mazo', $mazo, PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->rowCount();
    } catch (PDOException $ex) {
        echo ("Error en modificarMazo" . $ex->getMessage());
    }
    return $result;
}
function modificarMazoDescripcion($conDb, $descripcion, $mazo)
{
    $result = 0;
    try {
        $sql = "UPDATE MAZOS SET DESCRIPCION=:descripcion WHERE ID=:mazo";
        $stmt = $conDb->prepare($sql);
        $stmt->bindParam(':mazo', $mazo, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->rowCount();
    } catch (PDOException $ex) {
        echo ("Error en modificarCarta" . $ex->getMessage());
    }
    return $result;
}
