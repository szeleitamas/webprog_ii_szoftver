<?php

class Muveletek_Ajax_Model
{
    public function get_data()
    {
        switch ($_POST['op']) {
            case 'kategoria':
                $eredmeny = array("lista" => array());
                try {
                    $dbh = new PDO('mysql:host=localhost;dbname=szoftver', 'root', '',
                        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
                    $stmt = $dbh->query("select id, kategoria from szoftver");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $eredmeny["lista"][] = array("id" => $row['id'], "kategoria" => $row['kategoria']);
                    }
                } catch (PDOException $e) {
                }
                echo json_encode($eredmeny);
                break;

            case 'nev':
                $eredmeny = array("lista" => array());
                try {
                    $dbh = new PDO('mysql:host=localhost;dbname=szoftver', 'root', '',
                        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
                    $stmt = $dbh->prepare("select id, nev from szoftver where id = :id");
                    $stmt->execute(array(":id" => $_POST["id"]));
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $eredmeny["lista"][] = array("id" => $row['id'], "nev" => $row['nev']);
                    }
                } catch (PDOException $e) {
                }
                echo json_encode($eredmeny);
                break;

            case 'verzio':
                $eredmeny = array("lista" => array());
                try {
                    $dbh = new PDO('mysql:host=localhost;dbname=szoftver', 'root', '',
                        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
                    $stmt = $dbh->prepare("select id, verzio from telepites where szoftverid = :id");
                    $stmt->execute(array(":id" => $_POST["id"]));
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $eredmeny["lista"][] = array("id" => $row['id'], "verzio" => $row['verzio']);
                    }
                } catch (PDOException $e) {
                }
                echo json_encode($eredmeny);
                break;

            case 'hely':
                $eredmeny = array("lista" => array());
                try {
                    $dbh = new PDO('mysql:host=localhost;dbname=szoftver', 'root', '',
                        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
                    $stmt = $dbh->prepare("select id, hely from gep where id = :id");
                    $stmt->execute(array(":id" => $_POST["id"]));
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $eredmeny["lista"][] = array("id" => $row['id'], "hely" => $row['hely']);
                    }
                } catch (PDOException $e) {
                }
                echo json_encode($eredmeny);
                break;

            case 'info':
                $eredmeny = array("tipus" => "", "ipcim" => "");
                try {
                    $dbh = new PDO('mysql:host=localhost;dbname=szoftver', 'root', '',
                        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
                    $stmt = $dbh->prepare("select ipcim, tipus from gep where id = :id");
                    $stmt->execute(array(":id" => $_POST["id"]));
                    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $eredmeny = array("tipus" => $row['tipus'], "ipcim" => $row['ipcim']);
                    }
                } catch (PDOException $e) {
                }
                echo json_encode($eredmeny);
                break;
        }
    }
}