<?php

    function getDB() {

        $dsn = 'mysql:dbname=animech;host=localhost';
        $user = 'root';
        $pass = '';

        try {
            $dbh = new PDO($dsn, $user, $pass);
            $dbh->query('SET NAMES utf8');
        }catch(PDOException $e) {
            ('Error:'.$e->getMessage());
            ('接続できませんでした');
            die();
        } return $dbh;

    }

    function getURL() {
        return $_SERVER["REQUEST_URI"];
    }

    function getinfomation() {
        $urlarray = explode('/', getURL());
        $aninon = $urlarray[3];
        return $aninon;
    }
    

    function anime_title() {

        $sql = "SELECT aninon, title
                FROM anime_title
                WHERE 1";
        
        $stmt = getDB()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
        
    }

    function table_title($title) {

        echo('	

        <th style = "width:50px;height:26px;background-color:white;display:inline-block;
        padding:2px;font-size:12px;">
        <a href="/anime/title/'.$title["aninon"].'/" style = "text-decoration:none;" >'."".$title["title"].'
        </a></th>

        ');
    }


    function anitl() {
        
        $sql = "SELECT aninon, name, comment, createdy
                FROM anime_thread
                WHERE 1
                LIMIT 0,5";
        
        $stmt = getDB()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;

    }

    function table_titles($tl) {

        echo('	

        <p style = "border:ridge;width:100px;height:100px;background-color:white;margin-left:50px;display:inline-block;
        padding:2px;font-size:12px;">
        <a href="/anime/title/'.$tl["aninon"].'/" style = "text-decoration:none;" >'."".$tl["comment"].'
        </a></th></br>

        ');
    }

    function anititle() {

        $sql = "SELECT aninon, title
                FROM anime_title
                WHERE aninon = :aninon
                ORDER BY aninon";
        
        $stmt = getDB()->prepare($sql);
        $stmt->bindParam(':aninon', $aninon, PDO::PARAM_STR);
        $stmt->execute();
        $anititle = $stmt->fetchAll();

        return $anititle;
    }
    
    function getcommentlists() {
        
        $sql = "SELECT aninon, name, comment, updatady
                FROM anime_thread
                WHERE aninon = :aninon
                ORDER BY aninon";

        $stmt = getDB()->prepare($sql);
        $stmt->bindParam(':aninon', $aninon, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
        
    }

    function ani_TL($tl) {

        echo('	

        <p>'."".$tl["comment"].'</p>

        ');
    }

    function responselist($aninon) {

        $sql = "SELECT aninon, name, comment, updatedy
                FROM anime_thread
                WHERE aninon = :aninon
                ORDER BY aninon";
        
        $stmt = getDB()->prepare($sql);
        $stmt->bindParam(':aninon', $aninon, PDO::PARAM_STR);
        $stmt->execute();
        $responselist = $stmt->fetchAll();
        return $responselist;

    }

    function outputresponse($response) {
        $name  =$response["name"];

        echo('
            <span style = "font-size:18px;padding-left:35px;padding-bottom:20px;">
			'.$name."の掲示板".'
			
			</span>
        ');
    }

    function anicome($aninon) {

        $sql = "SELECT aninon, name, comment, createdy
                FROM anime_thread
                WHERE aninon = :aninon
                ORDER BY aninon";

        $stmt = getDB()->prepare($sql);
        $stmt->bindParam(':aninon', $aninon, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function response ($anicome) {

        $name = $anicome['name'];
        $comment = $anicome['comment'];
        $createdy = $anicome['createdy'];

        echo('
        <p style = "border:ridge;width:200px;height:100px;margin-left:50px;">'.$name.'.'.$comment.'</p>

        ');
    }
