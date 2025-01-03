<?php

include_once("municipio-model.php");
include_once("connectionDB.php");
class Escuela
{
    private string $nombre;
    private int $codigo;
    private string $direccion;
    private DateTime $hora_apertura;
    private DateTime $hora_cierre;
    private bool $comedor;
    private Municipio $municipio;


    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of codigo
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get the value of direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of hora_apertura
     */
    public function getHora_apertura($formated = true)
    {
        if ($formated) {
            return $this->hora_apertura->format('H:i');
        }

        return $this->hora_apertura;
    }

    /**
     * Set the value of hora_apertura
     *
     * @return  self
     */
    public function setHora_apertura($hora_apertura)
    {
        //Comprobamos si nos pasan un objeto DateTime o un string que representa un DateTime.
        if ($hora_apertura instanceof DateTime) {
            $this->hora_apertura = $hora_apertura;
        } else {
            $this->hora_apertura = new DateTime($hora_apertura);
        }

        return $this;
    }

    /**
     * Get the value of hora_cierre
     */
    public function getHora_cierre($formated = true)
    {
        if ($formated) {
            return $this->hora_cierre->format('H:i');
        }

        return $this->hora_cierre;
    }

    /**
     * Set the value of hora_cierre
     *
     * @return  self
     */
    public function setHora_cierre($hora_cierre)
    {
        if ($hora_cierre instanceof DateTime) {
            $this->hora_cierre = $hora_cierre;
        } else {
            $this->hora_cierre = new DateTime($hora_cierre);
        }

        return $this;
    }

    /**
     * Get the value of comedor
     */
    public function getComedor()
    {
        return $this->comedor;
    }

    /**
     * Set the value of comedor
     *
     * @return  self
     */
    public function setComedor($comedor)
    {
        $this->comedor = $comedor;

        return $this;
    }

    /**
     * Get the value of municipio
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * Set the value of municipio
     *
     * @return  self
     */
    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;

        return $this;
    }
}

class EscuelaModel
{
    public static function get_escuela($codigo)
    {
        $db = ConnectionDB::get();
        $sql = "SELECT cod_escuela, e.nombre, direccion, hora_apertura, hora_cierre, comedor, 
                       m.cod_municipio, m.nombre AS muni, m.latitud, m.longitud, m.altitud, m.cod_provincia  
                FROM escuela e INNER JOIN municipio m ON m.cod_municipio = e.cod_municipio WHERE e.cod_escuela = ?";
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $codigo, PDO::PARAM_INT);
        $escuela = null;
        try {
            $statement->execute();
            if ($row = $statement->fetch()) {
                $municipio = new Municipio($row['cod_municipio'], $row['muni'], $row['longitud'], $row['latitud'], $row['altitud'], $row['cod_provincia']);
                $escuela = new Escuela();
                $escuela->setCodigo($row['cod_escuela'])
                    ->setNombre($row['nombre'])
                    ->setDireccion($row['direccion'])
                    ->setHora_apertura($row['hora_apertura'])
                    ->setHora_cierre($row['hora_cierre'])
                    ->setComedor($row['comedor'] == 'S')
                    ->setMunicipio($municipio);
            } else {
                error_log("Escuela no encontrada. codigo=$codigo");
            }
        } catch (PDOException $th) {
            error_log("Error objeniendo escuela codigo=$codigo " . $th->getMessage());
        } finally {
            $statement = null;
            $db = null;
        }

        return $escuela;
    }

    public static function get_escuelas($cod_municipio = null, $nombre = '')
    {

        $db = ConnectionDB::get();
        $sql = "SELECT cod_escuela, e.nombre, direccion, hora_apertura, hora_cierre, comedor, 
                       m.cod_municipio, m.nombre AS muni, m.latitud, m.longitud, m.altitud, m.cod_provincia  
                FROM escuela e INNER JOIN municipio m ON m.cod_municipio = e.cod_municipio 
                WHERE (? IS NULL OR m.cod_municipio = ?) AND
                 e.nombre LIKE ? ORDER BY m.nombre, e.nombre DESC";
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $cod_municipio, PDO::PARAM_INT);
        $statement->bindValue(2, $cod_municipio, PDO::PARAM_INT);
        $statement->bindValue(3, '%' . $nombre . '%', PDO::PARAM_STR);

        $escuelas = [];
        try {
            $statement->execute();
            foreach ($statement as $row) {
                $municipio = new Municipio($row['cod_municipio'], $row['muni'], $row['longitud'], $row['latitud'], $row['altitud'], $row['cod_provincia']);
                $escuela = new Escuela();
                $escuela->setCodigo($row['cod_escuela'])
                    ->setNombre($row['nombre'])
                    ->setDireccion($row['direccion'])
                    ->setHora_apertura($row['hora_apertura'])
                    ->setHora_cierre($row['hora_cierre'])
                    ->setComedor($row['comedor'] == 'S')
                    ->setMunicipio($municipio);
                $escuelas[] = $escuela;
            }
        } catch (PDOException $th) {
            error_log("Error obteniendo escuelas " . $th->getMessage());
        } finally {
            $statement = null;
            $db = null;
        }

        return $escuelas;
    }

    public static function get_num_matriculas_escuela($escuela)
    {
        $db = ConnectionDB::get();
        $sql = "SELECT COUNT(*) FROM matricula WHERE cod_escuela=?";
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $escuela->getCodigo(), PDO::PARAM_INT);
        $matriculas = 0;
        try {
            $statement->execute();
            $matriculas = $statement->fetch()[0];
        } catch (PDOException  $th) {
            $matriculas = 0;
            error_log("Error obteniendo matriculas de escuela $escuela->getCodigo()");
        } finally {
            $statement = null;
            $db = null;
        }

        return $matriculas;
    }

    public static function alta_escuela($escuela) {}

    public static function baja_escuela($escuela)
    {
        $db = ConnectionDB::get();
        //Eliminamos las matriculas primero
        $sql = "DELETE FROM matricula WHERE cod_escuela = ?";
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $escuela->getCodigo(), PDO::PARAM_INT);
        $toret = false;
        try {
            $toret = $statement->execute();
            $statement = null;
            $sql = "DELETE FROM escuela WHERE cod_escuela = ?";
            $statement = $db->prepare($sql);
            $statement->bindValue(1, $escuela->getCodigo(), PDO::PARAM_INT);
            $toret = $statement->execute();
        } catch (PDOException $th) {
            error_log("Error eliminando escuela $escuela->getCodigo()");
            $toret = false;
        } finally {
            $statement = null;
            $db = null;
        }
        
        return $toret;
    }

    public static function actualizar_escuela($escuela) {}
}
