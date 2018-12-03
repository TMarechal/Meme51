<?php 

class Meme extends Model{

    public static function getAllImages(){
        $db = Database::getInstance();
        $sql = "select * from images";
        $images = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $images;
    }

    public static function Send($file_name){
        $db = Database::getInstance();
        $sql = $db->prepare("INSERT INTO images (
                                name,
                                date) VALUES (
                                :name, 
                                :date)"
        );
        
        $sql->bindValue(':name', $file_name, PDO::PARAM_STR);
        $sql->bindValue(':date', time(), PDO::PARAM_STR);
        $sql->execute();

        return true;
    }
}