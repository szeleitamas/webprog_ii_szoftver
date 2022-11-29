<h2>Regisztráció</h2>
<form action="<?= SITE_ROOT ?>regisztral" method="post">
    <label for="csnev">Családi név:</label><input type="text" name="csnev" id="csnev" required><br>
    <label for="unev">Utónév:</label><input type="text" name="unev" id="unev" required><br>
    <label for="login">Felhasználó:</label><input type="text" name="login" id="login" required><br>
    <label for="password">Jelszó:</label><input type="password" name="password" id="password" required><br>
    <label for="jog">Jogosultság:</label><select name="jog" id="jog" required>
        <option value="__1">Admin</option><br>
        <option value="_1_">Regisztrált felhasználó</option><br>
    <input type="submit" value="Küldés">
</form>
<h2><br><?= (isset($viewData['uzenet']) ? $viewData['uzenet'] : "") ?><br></h2>
