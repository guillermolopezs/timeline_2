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
