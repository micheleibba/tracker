var rootPath = "/";

function editMenuResponse(evt)
{
    var reply = evt.target.responseText;
    var obj = JSON.parse(reply);  
    if(!parseInt(obj.error))
    {
        var mid = document.getElementById("mid");
        var titolo = document.getElementById("titolo");
        var path = document.getElementById("path");
        var mdi = document.getElementById("mdi");
        var prio = document.getElementById("prio");
        mid.value = obj.mid;
        titolo.value = obj.titolo;
        path.value = obj.path;
        mdi.value = obj.mdi;
        prio.value = obj.prio;
    }
}

function editMenu(mid)
{
    var fd = new FormData();
    fd.append("mid", mid);
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('load', editMenuResponse, false);
    xhr.open("POST", rootPath + "get/menu.php");
    xhr.send(fd);  
}

function deleteMenuResponse(evt)
{
    var reply = evt.target.responseText;
    var obj = JSON.parse(reply);  
    if(!parseInt(obj.error))
    {
        location.reload();
    }
}

function deleteMenu(mid)
{
    var fd = new FormData();
    fd.append("mid", mid);
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('load', deleteMenuResponse, false);
    xhr.open("POST", rootPath + "set/delete_menu.php");
    xhr.send(fd);  
}