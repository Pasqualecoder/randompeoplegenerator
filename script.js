function apriGenera() {
    var gen = document.getElementById("gen");
    var del = document.getElementById("delete");
    var run = document.getElementById("run");

    del.setAttribute("hidden", "");
    run.setAttribute("hidden", "");

    gen.removeAttribute("hidden");
    gen.setAttribute("required", "");
}

function apriCancella() {
    var gen = document.getElementById("gen");
    var del = document.getElementById("delete");
    var run = document.getElementById("run");

    gen.setAttribute("hidden", "");
    run.setAttribute("hidden", "");

    del.removeAttribute("hidden");
    del.setAttribute("required", "");
}

function apriRun() {
    var gen = document.getElementById("gen");
    var del = document.getElementById("delete");
    var run = document.getElementById("run");

    gen.setAttribute("hidden", "");
    del.setAttribute("hidden", "");
    
    run.removeAttribute("hidden");
    run.setAttribute("required", "");
}

function seiSicuro() {
    sicuro = confirm("Questa azione è irreversibile. Sei sicuro di voler eliminare tutti i dati presenti?");
    if (!sicuro) {
        location.reload();
    }
}