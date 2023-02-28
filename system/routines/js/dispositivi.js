var rootPath = "/tracker/";

function deleteDispositivoResponse(evt)
{
    var reply = evt.target.responseText;
    var obj = JSON.parse(reply);
    if(!parseInt(obj.error))
    {
        alert("Dispositivo eliminato correttamente.");
        location.reload();
    }
}

function deleteDispositivo(idd)
{
    if(confirm("Sei sicuro di voler eliminare questo dispositivo?"))
    {
        var fd = new FormData();
        fd.append("idd", idd);
        var xhr = new XMLHttpRequest();
        xhr.addEventListener('load', deleteDispositivoResponse, false);
        xhr.open("POST", rootPath + "set/delete_dispositivo.php");
        xhr.send(fd);
    }
}

function deleteRilevazioneResponse(evt)
{
    var reply = evt.target.responseText;
    var obj = JSON.parse(reply);
    if(!parseInt(obj.error))
    {
        alert("Rilevazione eliminata correttamente.");
        location.reload();
    }
}

function deleteRilevazione(idr)
{
    if(confirm("Sei sicuro di voler eliminare questa rilevazione?"))
    {
        var fd = new FormData();
        fd.append("idr", idr);
        var xhr = new XMLHttpRequest();
        xhr.addEventListener('load', deleteRilevazioneResponse, false);
        xhr.open("POST", rootPath + "set/delete_rilevazione.php");
        xhr.send(fd);
    }
}

function editDispositivoResponse(evt)
{
    var reply = evt.target.responseText;
    var obj = JSON.parse(reply);
    if(!parseInt(obj.error))
    {
        var idd = document.getElementById("idd");
        var idm = document.getElementById("idm");
        var nome = document.getElementById("nome");
        var coord_x = document.getElementById("coord_x");
        var coord_y = document.getElementById("coord_y");
        idd.value = obj.idd;
        idm.value = obj.idm;
        nome.value = obj.nome;
        coord_x.value = obj.coord_x;
        coord_y.value = obj.coord_y;
    }
}

function editDispositivo(idd)
{
    var fd = new FormData();
    fd.append("idd", idd);
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('load', editDispositivoResponse, false);
    xhr.open("POST", rootPath + "get/dispositivo.php");
    xhr.send(fd);
}
