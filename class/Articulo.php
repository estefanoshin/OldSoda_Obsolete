<?php
require 'Corte.php';
class Articulo extends Corte
{
	private $artID;
	private $art;
	private $cant;
	private $descrip;
	private $img;

	private $talleID;
	private $colorID;

    public function getArtID()
    {
        return $this->artID;
    }
    public function setArtID($artID)
    {
        $this->artID = $artID;
    }
    public function getArt()
    {
        return $this->art;
    }
    public function setArt($art)
    {
        $this->art = $art;
    }
    public function getCant()
    {
        return $this->cant;
    }
    public function setCant($cant)
    {
        $this->cant = $cant;
    }
    public function getDescrip()
    {
        return $this->descrip;
    }
    public function setDescrip($descrip)
    {
        $this->descrip = $descrip;
    }
    public function getImg()
    {
        return $this->img;
    }
    public function setImg($img)
    {
        $this->img = $img;
    }


    public function getTalleID()
    {
        return $this->talleID;
    }
    public function setTalleID($talleID)
    {
        $this->talleID = $talleID;
    }
    public function getColorID()
    {
        return $this->colorID;
    }
    public function setColorID($colorID)
    {
        $this->colorID = $colorID;
    }

    //---------------------------------------------------------

    public function createArt($dato)
    {
        $link = Conexion::conectar();

        $sql = 
        "INSERT INTO `articulo` (`art`, `cant`, `descrip`, `img`, `talleID`, `colorID`)
        VALUES (:art, :cant, :descrip, :img, :talleID, :colorID);";

        $stmt = $link->prepare($sql);

        $stmt->bindValue(":art",$dato['art']);
        $stmt->bindValue(":cant",$dato['cant']);
        $stmt->bindValue(":descrip",$dato['descrip']);
        $stmt->bindValue(":img",$dato['img']);

        $stmt->bindValue(":talleID",$dato['talleID']);
        $stmt->bindValue(":colorID",$dato['colorID']);

        $stmt->execute();

        return true;
    }

    public function readArt()
    {
        $link = Conexion::conectar();
        $sql = "SELECT artID, art, cant, descrip, img, talleID, colorID FROM articulo";
        $stmt = $link->prepare($sql);
        $stmt->execute();

        $listadoArt = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($stmt->rowCount() == 0)
        {
            echo  '<h2>No existen articulos en la base de datos, por favor ingrese alguno</h2>';
            return $listadoArt;
        }
        else
        {
            return $listadoArt;
        }
    }
    
    public function updateArt($dato)
    {
        $link = Conexion::conectar();

        $sql =
        "UPDATE articulo
        SET art = :art, cant = :cant, descrip = :descrip, img = :img, talleID = :talleID, colorID = :colorID
        WHERE artID = :artID";
        $stmt = $link->prepare($sql);

        $stmt->bindValue(":art",$dato['art']);
        $stmt->bindValue(":cant",$dato['cant']);
        $stmt->bindValue(":descrip",$dato['descrip']);
        $stmt->bindValue(":img",$dato['img']);

        $stmt->bindValue(":talleID",$dato['talleID']);
        $stmt->bindValue(":colorID",$dato['colorID']);
        $stmt->bindValue(":artID",$dato['artID']);

        $stmt->execute();

        $stmt = $link->prepare($sql);

        return true;
    }

    public function deleteArt($id)
    {
        $link = Conexion::conectar();

        $sql = "DELETE FROM articulo WHERE artID = :artID";
        $stmt = $link->prepare($sql);

        $stmt->bindValue(':artID', $id);

        $stmt->execute();

        $stmt = $link->prepare($sql);

        return true;
    }

    public function buscarArtPorID($id)
    {
        $link = Conexion::conectar();
        $sql = "SELECT art, cant, descrip, img, talleID, colorID FROM articulo WHERE artID =".$id;

        $stmt = $link->prepare($sql);
        $stmt->execute();

        $datoArt = $stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt->rowCount() == 0)
        {
            echo  '<h2>No existen modelo en la base de Datos</h2>';
            return $datoArt;
        }
        else
        {
            return $datoArt;
        }
    }
}