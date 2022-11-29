function kategoriak() {
  $.post(
    "muveletek_ajax_model.php",
    { op: "kategoria" },
    function (data) {
      $("<option>").val("0").text("Válasszon ...").appendTo("#kategoriaselect");
      var lista = data.lista;
      for (i = 0; i < lista.length; i++)
        $("<option>")
          .val(lista[i].id)
          .text(lista[i].kategoria)
          .appendTo("#kategoriaselect");
    },
    "json"
  );
}

function nevek() {
  $("#nevselect").html("");
  $("#verzioselect").html("");
  $(".adat").html("");
  var kategoriaid = $("#kategoriaselect").val();
  if (kategoriaid != 0) {
    $.post(
      "muveletek_ajax_model.php",
      { op: "nev", id: kategoriaid },
      function (data) {
        $("<option>").val("0").text("Válasszon ...").appendTo("#nevselect");
        var lista = data.lista;
        for (i = 0; i < lista.length; i++)
          $("#nevselect").append(
            '<option value="' + lista[i].id + '">' + lista[i].nev + "</option>"
          );
      },
      "json"
    );
  }
}

function verziok() {
  $("#verzioselect").html("");
  $("#helyselect").html("");
  $(".adat").html("");
  var nevid = $("#nevselect").val();
  if (nevid != 0) {
    $.post(
      "muveletek_ajax_model.php",
      { op: "verzio", id: nevid },
      function (data) {
        $("<option>").val("0").text("Válasszon ...").appendTo("#verzioselect");
        var lista = data.lista;
        for (i = 0; i < lista.length; i++)
          $("<option>")
            .val(lista[i].id)
            .text(lista[i].verzio)
            .appendTo("#verzioselect");
      },
      "json"
    );
  }
}

function helyek() {
  $("#helyselect").html("");
  $(".adat").html("");
  var verzioid = $("#verzioselect").val();
  if (verzioid != 0) {
    $.post(
      "muveletek_ajax_model.php",
      { op: "hely", id: verzioid },
      function (data) {
        $("<option>").val("0").text("Válasszon ...").appendTo("#helyselect");
        var lista = data.lista;
        for (i = 0; i < lista.length; i++)
          $("<option>")
            .val(lista[i].id)
            .text(lista[i].hely)
            .appendTo("#helyselect");
      },
      "json"
    );
  }
}

function hely() {
  $(".adat").html("");
  var helyid = $("#helyselect").val();
  if (helyid != 0) {
    $.post(
      "muveletek_ajax_model.php",
      { op: "info", id: helyid },
      function (data) {
        $("#ipcim").text(data.ipcim);
        $("#tipus").text(data.tipus);
      },
      "json"
    );
  }
}

$(document).ready(function () {
  kategoriak();

  $("#kategoriaselect").change(nevek);
  $("#nevselect").change(verziok);
  $("#verzioselect").change(helyek);
  $("#helyselect").change(hely);

  $(".adat").hover(
    function () {
      $(this).css({ color: "white", "background-color": "black" });
    },
    function () {
      $(this).css({ color: "black", "background-color": "white" });
    }
  );
});
