<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <script type="text/javascript" src="./js/jquery.min.js"></script>
    <script type="text/javascript" src="./js/muveletek_ajax.js"></script>
    <title>Szoftver leltár</title>
    <style>
        #informaciosdiv {
            width: 400px;
        }
        #intezmenyinfo {
            float: right;
            border: 1px solid black;
            width: 190px;
            height: 100px;
        }
        .cimke {
            display: inline-block;
            width: 60px;
            text-align: right;
        }
        span {
            margin: 3px 5px;
        }
        label {
            display: inline-block;
            width: 70px;
            text-align: right;
        }
        select {
            width: 115px;
        }
    </style>
</head>
<body>
<h1>Szoftver leltár:</h1>
<div id="informaciosdiv">
    <div id="szoftverinfo">
        <span class="cimke">Típus:</span><span id="tipus" class="adat"></span
        ><br />
        <span class="cimke">IP cím:</span><span id="ipcim" class="adat"></span
        ><br />
    </div>
    <label for="kategoriacimke">Kategória:</label>
    <select id="kategoriaselect"></select>
    <br /><br />
    <label for="nevcimke">Név:</label>
    <select id="nevselect"></select>
    <br /><br />
    <label for="verziocimke">Verzió:</label>
    <select id="verzioselect"></select>
    <br /><br />
    <label for="helycimke">Hely:</label>
    <select id="helyselect"></select>
</div>
</body>
</html>

