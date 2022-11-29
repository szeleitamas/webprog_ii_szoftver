<?php
$url = "http://localhost/rest/szerver.php";
$result = "";
if(isset($_POST['id']))
{
    $_POST['id'] = trim($_POST['id']);
    $_POST['hely'] = trim($_POST['hely']);
    $_POST['tip'] = trim($_POST['tip']);
    $_POST['ip'] = trim($_POST['ip']);

    if($_POST['id'] == "" && $_POST['hely'] != "" && $_POST['tip'] != "" && $_POST['ip'] != "")
    {
        $data = Array("hely" => $_POST["hely"], "tip" => $_POST["tip"], "ip" => $_POST["ip"]);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
    }

    elseif($_POST['id'] == "")
    {
        $result = "Hiba: Hiányos adatok!";
    }
    elseif($_POST['id'] >= 1 && ($_POST['hely'] != "" || $_POST['tip'] != "" || $_POST['ip'] != ""))
    {
        $data = Array("id" => $_POST["id"], "hely" => $_POST["hely"], "tip" => $_POST["tip"], "ip" => $_POST["ip"]);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
    }
    elseif($_POST['id'] >= 1)
    {
        $data = Array("id" => $_POST["id"]);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
    }
    else
    {
        echo "Hiba: Rossz azonosító (Id): ".$_POST['id']."<br>";
    }
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$tabla = curl_exec($ch);
curl_close($ch);
?>

<?= $result ?>
<h1>Számítógépek:</h1>
<?= $tabla ?>
		<div id="flexbox-rest-urlap">
<br>
<fieldset>
    <legend>Adatok felvitele / törlése</legend>
    <form method="post">
        <h4>Adat törléshez adja meg az Id-t</h4>
        Id: <input type="text" name="id"><br><br>
        <h4>Adat felvitelhez adja meg az adatokat</h4>
        Hely: <input type="text" name="hely" maxlength="45"><br><br>
        Típus: <input type="text" name="tip" maxlength="45"><br><br>
        IP cím: <input type="text" name="ip" maxlength="12"><br><br>
        <input type="submit" value = "Küldés">
    </form>
</fieldset>
<fieldset>
    <legend>Adatok módosítása</legend>
    <form method="post">
        <h4>Adat módosításához adja meg az Id-t</h4>
        Id: <input type="text" name="id"><br><br>
        <h4>Adat meg a módosítandó adatot</h4>
        Hely: <input type="text" name="hely" maxlength="45"><br><br>
        Típus: <input type="text" name="tip" maxlength="45"><br><br>
        IP cím: <input type="text" name="ip" maxlength="12"><br><br>
        <input type="submit" value = "Küldés">
    </form>
</fieldset>

