<?php
    #$pdo = new PDO('mysql:host=localhost;dbname=jump', 'root', '');

    $pdo = new PDO('mysql:host=sheparvprivate.mysql.db;dbname=sheparvprivate', 'sheparvprivate', 'ocbzo65PXLyGh69RLXa', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    $pdo->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ );

    function getStones($pdoo) {
        $req = $pdoo->prepare("SELECT DISTINCT stone FROM inventory ORDER BY stone ASC");
        $req->execute();
        $res = $req->fetchAll();	
        $stones = array();
        $precious = array('Diamant', 'Emeraude', "Rubis", 'Saphir');
        foreach($res as $key=>$value) {
            foreach(explode("-", $value->stone) as $stone) {
                if(!in_array($stone, $stones)) {
                array_push($stones, $stone);
                }
            }
        }
        $stones = array_unique($stones);
        if (($key = array_search("", $stones)) !== false) {
            unset($stones[$key]);
        }
        if (($key = array_search("NULL", $stones)) !== false) {
            unset($stones[$key]);
        }
        foreach($precious as $stone) {
            echo('<option class="stone_option" value="'.$stone.'">'.$stone.'</option>');
        }
        echo('<option class="stone_option" disabled>'.'--------------------------------------------'.'</option>');
        foreach($stones as $stone) {
            if(!in_array($stone, $precious)) {
                echo('<option class="stone_option" value="'.$stone.'">'.$stone.'</option>');
            }
        }
        return $stones;
    }

    function getMetals($pdoo) {
        $req = $pdoo->prepare("SELECT DISTINCT metal FROM inventory ORDER BY metal ASC");
        $req->execute();
        $res = $req->fetchAll();	
        $metals = array();
        foreach($res as $key=>$value) {
            foreach(explode("-", $value->metal) as $metal) {
                if(!in_array($metal, $metals)) {
                    array_push($metals, $metal);
                }
            }
        }
        $metals = array_unique($metals);
        if (($key = array_search("", $metals)) !== false) {
            unset($metals[$key]);
        }
        if (($key = array_search("NULL", $metals)) !== false) {
            unset($metals[$key]);
        }
        sort($metals);
        foreach($metals as $metal) {
            echo('<option value="'.$metal.'">'.$metal.'</option>');
        }
        return $metals;
    }

    function getMetalsWithSelected($pdoo, $result) {

        function getOptionPropP($result, $value, $group) {
            $selected = "";
            if(in_array($value, explode('-', $result -> $group))) {
              echo("coucou");
              $selected = "selected";
            }
            return $selected;
        }

        $req = $pdoo->prepare("SELECT DISTINCT metal FROM inventory ORDER BY metal ASC");
        $req->execute();
        $res = $req->fetchAll();	
        $metals = array();
        foreach($res as $key=>$value) {
            foreach(explode("-", $value->metal) as $metal) {
                if(!in_array($metal, $metals)) {
                    array_push($metals, $metal);
                }
            }
        }
        $metals = array_unique($metals);
        if (($key = array_search("", $metals)) !== false) {
            unset($metals[$key]);
        }
        if (($key = array_search("NULL", $metals)) !== false) {
            unset($metals[$key]);
        }
        sort($metals);
        foreach($metals as $metal) {
            echo('<option value="'.$metal.'"'.getOptionPropP($result, $metal, "metal").'>'.$metal.'</option>');
        }
        return $metals;
    }

    function getDataList($pdoo, $param) {
        $req = $pdoo-> prepare("SELECT DISTINCT $param FROM inventory");
        $req->execute();
        $res = $req->fetchAll();
        var_dump($res);
        foreach($res as $value) {
            echo('<option value="'.$value->$param.'">');
        }
    }