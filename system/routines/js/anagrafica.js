var rootPath = "/";

function editUserResponse(evt)
{
    var reply = evt.target.responseText;
    var obj = JSON.parse(reply);  
    if(!parseInt(obj.error))
    {
        var uid = document.getElementById("uid");
        var tid = document.getElementById("tid");
        var nome = document.getElementById("nome");
        var cognome = document.getElementById("cognome");
        var email = document.getElementById("email");
        var cellulare = document.getElementById("cellulare");
        var username = document.getElementById("username");
        var password = document.getElementById("password");
        uid.value = obj.utente.uid;
        tid.selectedIndex = getIndexFromValue(tid,obj.utente.tid);
        nome.value = obj.utente.nome;
        cognome.value = obj.utente.cognome;
        email.value = obj.utente.email;
        cellulare.value = obj.utente.cellulare;
        username.value = obj.login.username;
        password.value = "";
    }
}

function editUser(uid)
{
    var fd = new FormData();
    fd.append("uid", uid);
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('load', editUserResponse, false);
    xhr.open("POST", rootPath + "get/utente.php");
    xhr.send(fd);  
}

function deleteUserResponse(evt)
{
    var reply = evt.target.responseText;
    var obj = JSON.parse(reply);  
    if(!parseInt(obj.error))
    {
        location.reload();
    }
}

function deleteUser(uid)
{
    var fd = new FormData();
    fd.append("uid", uid);
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('load', deleteUserResponse, false);
    xhr.open("POST", rootPath + "set/delete_utente.php");
    xhr.send(fd);  
}
