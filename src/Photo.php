<?php

//  CREATE TABLE Photo(
//  idPicture INT NOT NULL AUTO_INCREMENT ,
//  idProduct INT NOT NULL ,
//  caption VARCHAR( 255 ) NOT NULL ,
//  img LONGBLOB NOT NULL ,
//  PRIMARY KEY ( idpicture ) ,
//  FOREIGN KEY ( idProduct ) REFERENCES Product( idProduct );
//  )

class Photo {

    private $idPicture;
    private $idProduct;
    private $caption;
    private $img;

    public function __construct($idPicture = -1, $idProduct = -1, $caption = '', $img = '') {
        $this->setIdProduct($idProduct);
        $this->setCaption($caption);
        $this->setImg($img);
    }

    public function sevaToDB(mysqli $conn) {
        $sql = "INSERT INTO Photo (idProduct, caption,img) VALUES "
                . "('{$this->idPicture}','{$this->caption}','{$this->img}')";
        $result = $conn->query($sql);
        if ($result === true) {
            $this->id = $conn->insert_id;
            return true;
        }
        return false;
    }

    public static function LoadOnePhotoFromDB(mysqli $conn, $idProduct) {
        $query = "SELECT * FROM Photo WHERE idProduct=" . $idProduct . " ORDER BY RAND() LIMIT 1";
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            foreach ($result as $row) {
                $photo = new Photo;
                $photo->idPicture = $row['idPicture'];
                $photo->idProduct = $row['idProduct'];
                $photo->caption = $row['caption'];
                $photo->img = $row['img'];
            }
            return $photo;
        }
        return false;
    }

    public static function loadAllPhotoFromBD(mysqli $conn) {
        $photos = [];
        $query = "SELECT * FROM Photo";
        $res = $connection->query($query);
        if ($res && $res->num_rows >= 1) {
            foreach ($res as $row) {
                $row = $res->fetch_assoc();
                $photo = new Photo;
                $photo->idPicture = $row['idPicture'];
                $photo->idProduct = $row['idProduct'];
                $photo->caption = $row['caption'];
                $photo->img = $row['img'];
                $photos[] = $photo;
            }
        }
    }

    public function clearDirectory() {
        if (is_file($this->img)) {
            $fp = fopen($this->img, 'r');
            $fileinfo = fstat($fp);
            unlink($this->img);
            return true;
        }
        return false;
    }

    public function deleteFromDB(mysqli $conn) {
        $query = "DELETE FROM Photo WHERE idPicture=" . $this->idPictureure;
        $result = $conn->query($query);
        $this->clearDirectory();

        return $result;
    }

    public function getIdPicture() {
        return $this->idPicture;
    }

    public function getIdProduct() {
        return $this->idProduct;
    }

    public function getCaption() {
        return $this->caption;
    }

    public function getImg() {
        return $this->img;
    }

    public function setIdProduct($idProduct) {
        $this->idProduct = $idProduct;
        return $this;
    }

    public function setCaption($caption) {
        $this->caption = $caption;
        return $this;
    }

    public function setImg($img) {
        $this->img = $img;
        return $this;
    }

}
