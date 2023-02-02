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
