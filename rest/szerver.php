<?php

$eredmeny = "";
try {
	$dbh = new PDO('mysql:host=localhost;dbname=szoftver', 'root', '',
				  array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
	switch($_SERVER['REQUEST_METHOD']) {
		case "GET":
				$sql = "SELECT * FROM gep";     
				$sth = $dbh->query($sql);
				$eredmeny .= "<table style=\"border-collapse: collapse;\"><tr><th></th><th>Hely</th><th>Típus</th><th>IP cím</th></tr>";
				while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
					$eredmeny .= "<tr>";
					foreach($row as $column)
						$eredmeny .= "<td style=\"border: 1px solid black; padding: 3px;\">".$column."</td>";
					$eredmeny .= "</tr>";
				}
				$eredmeny .= "</table>";
			break;

		case "POST":
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$sql = "insert into gep values (0, :hely, :tip, :ip)";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute(Array(":hely"=>$data["hely"], ":tip"=>$data["tip"], ":ip"=>$data["ip"]));				
				$newid = $dbh->lastInsertId();
				$eredmeny .= $count." beszúrt sor: ".$newid;
			break;

		case "PUT":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$modositando = "id=id"; $params = Array(":id"=>$data["id"]);
				if($data['hely'] != "") {$modositando .= ", hely = :hely"; $params[":hely"] = $data["hely"];}
				if($data['tip'] != "") {$modositando .= ", tipus = :tip"; $params[":tip"] = $data["tip"];}
				if($data['ip'] != "") {$modositando .= ", ipcim = :ip"; $params[":ip"] = $data["ip"];}
				$sql = "update gep set ".$modositando." where id=:id";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute($params);
				$eredmeny .= $count." módositott sor. Azonosítója:".$data["id"];
			break;

		case "DELETE":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$sql = "delete from gep where id=:id";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute(Array(":id" => $data["id"]));
				$eredmeny .= $count." sor törölve. Azonosítója:".$data["id"];
			break;
	}
}
catch (PDOException $e) {
	$eredmeny = $e->getMessage();
}
echo $eredmeny;
