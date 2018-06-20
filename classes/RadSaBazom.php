<?php

require_once "Konekcija.php";

abstract class RadSaBazom {

    public static $tabela = "";
    
    function kolone() {
        $kolone = "";
        $nazivKljuca = static::$imeKljuca;
        foreach ($this as $k => $v) {
            if ($k == $nazivKljuca) {
                continue;
            }
            $kolone .= "{$k}='{$v}',";
        }
        $kolone = rtrim($kolone, ",");
        return $kolone;
    }
    
    public static function izbrisi($id) {
        $pdo = Konekcija::getInstance();
        $nazivTabele = static::$tabela;
        $nazivKljuca = static::$imeKljuca;
        $st = $pdo->prepare("delete from {$nazivTabele} where {$nazivKljuca} = :id");
        $st->bindParam(":id", $id);
        $st->execute();
    }

    public function izmeni($id) {
        $pdo = Konekcija::getInstance();
        $nazivTabele = static::$tabela;
        $nazivKljuca = static::$imeKljuca;
        $query = "update {$nazivTabele} set ". $this->kolone() ." where {$nazivKljuca} = ". $this->$nazivKljuca; 
        $pdo->exec($query);
    }

    public function unesi() {
        $pdo = Konekcija::getInstance();
        $nazivTabele = static::$tabela;
        $nazivKljuca = static::$imeKljuca;
        $query = "insert into {$nazivTabele} set " . $this->kolone();
        $pdo->exec($query);
        $this->$nazivKljuca = $pdo->lastInsertId();
    }

    public static function prikaziPonudu($id) {
        $pdo = Konekcija::getInstance();
        $nazivTabele = static::$tabela;
        $nazivKljuca = static::$imeKljuca;
        $nazivKlase = get_called_class();
        $st = $pdo->prepare("select * from {$nazivTabele} where {$nazivKljuca} = :id");
        $st->bindParam(":id", $id);
        $st->setFetchMode(PDO::FETCH_CLASS, $nazivKlase);
        $st->execute();
        return $st->fetch();
    }

    public static function prikaziSvePonude() {
        $pdo = Konekcija::getInstance();
        $nazivTabele = static::$tabela;
        $nazivKlase = get_called_class();
        $st = $pdo->prepare("select * from {$nazivTabele}");
        $st->setFetchMode(PDO::FETCH_CLASS, $nazivKlase);
        $st->execute();
        return $st->fetchAll();
    }

    public static function poslednjiId(){
        $pdo = Konekcija::getInstance();
        $nazivTabele = static::$tabela;
        $st = $pdo->query("select * from {$nazivTabele}");
        $all = $st->fetchAll(PDO::FETCH_ORI_LAST);
        $lastId = $all[sizeof($all)-1][0];
        return $lastId;
    }
}
