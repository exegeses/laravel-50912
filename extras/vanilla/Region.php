<?php

class Region
{
    private $regID;
    private $regNombre;

    public function listarRegiones()
    {
        $link = Conexion::conectar();
        $sql = "SELECT regID, regNombre
                    FROM regiones";

        $stmt = $link->prepare($sql);
        $stmt->execute();

        $regiones = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $regiones;
    }

    public function agregarRegion()
    {
        $regNombre = $_POST['regNombre'];
        $link = Conexion::conectar();
        $sql = "INSERT INTO regiones
                                    ( regNombre )
                                VALUE
                                    ( :regNombre )";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':regNombre', $regNombre);
        $stmt->execute();
        return true;
    }

}