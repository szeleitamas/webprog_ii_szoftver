<?php

class Regisztral_Model
{
    public function get_data($vars)
    {
        $retData['eredmeny'] = "";
        try {
            $connection = Database::getConnection();
            $sql = "select id, csaladi_nev, utonev, jogosultsag from felhasznalok where bejelentkezes='".$vars['login']."'";
            $stmt = $connection->query($sql);
            if($felhasznalo = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                $retData['eredmeny'] = "ERROR";
                $retData['uzenet'] = "A felhasználói név már foglalt!";
            }
            else {
                $sqlInsert = "insert into felhasznalok(id, csaladi_nev, utonev, bejelentkezes, jelszo, jogosultsag)
                          values(0, :csaladinev, :utonev, :bejelentkezes, :jelszo, :jog)";
                $stmt = $connection->prepare($sqlInsert);
                $stmt->execute(array(':csaladinev' => $_POST['csnev'], ':utonev' => $_POST['unev'],
                    ':bejelentkezes' => $_POST['login'], ':jelszo' => sha1($_POST['password']), ':jog' => $_POST['jog']));
                if ($count = $stmt->rowCount()) {
                    $retData['eredmény'] = "OK";
                    $retData['uzenet'] = "A regisztráció sikeres";
                } else {
                    $retData['eredmeny'] = "ERROR";
                    $retData['uzenet'] = "A regisztráció nem sikerült!";
                }
            }
        }
        catch (PDOException $e) {
            $retData['eredmény'] = "ERROR";
            $retData['uzenet'] = "Adatbázis hiba: ".$e->getMessage()."!";
        }
        return $retData;
    }
}