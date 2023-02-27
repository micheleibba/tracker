var rootPath = "/tracker/";

function deleteUserResponse(evt)
{
    var reply = evt.target.responseText;
    var obj = JSON.parse(reply);
    if(!parseInt(obj.error))
    {
        alert("Utente eliminato correttamente.");
        location.reload();
    } 
}

function deleteUser(uid)
{
    if(confirm("Sei sicuro di voler eliminare questo cliente?"))
    {
        var fd = new FormData();
        fd.append("uid", uid);
        var xhr = new XMLHttpRequest();
        xhr.addEventListener('load', deleteUserResponse, false);
        xhr.open("POST", rootPath + "set/delete_cliente.php");
        xhr.send(fd);
    }
}