var rootPath = "/tracker/";

function editRoleResponse(evt)
{
    var reply = evt.target.responseText;
    var obj = JSON.parse(reply);
    if(!parseInt(obj.error))
    {
        var tid = document.getElementById("tid");
        var ruolo = document.getElementById("ruolo");
        var mids = document.getElementById("mids");
        var smids = document.getElementById("smids");
        tid.value = obj.tid;
        ruolo.value = obj.name;
        resetMultipleSelected(mids);
        resetMultipleSelected(smids);
        if(typeof obj.mids !== "undefined" && obj.mids !== null )
        {
            for(var i=0;i<mids.options.length;i++)
            {
                for(var j=0;j<obj.mids.length;j++)
                {
                    if(mids.options[i].value === obj.mids[j].mid)
                    {
                        $('#mids option:eq('+i+')').prop('selected', true).change();
                    }
                }
            }
        }
        if(typeof obj.smids !== "undefined" && obj.smids !== null )
        {
            for(var i=0;i<smids.options.length;i++)
            {
                for(var j=0;j<obj.smids.length;j++)
                {
                    if(smids.options[i].value === obj.smids[j].smid)
                    {
                        $('#smids option:eq('+i+')').prop('selected', true).change();
                    }
                }
            }
        }
    }
}

function editRole(tid)
{
    var fd = new FormData();
    fd.append("tid", tid);
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('load', editRoleResponse, false);
    xhr.open("POST", rootPath + "get/ruolo.php");
    xhr.send(fd);
}

function deleteRoleResponse(evt)
{
    var reply = evt.target.responseText;
    var obj = JSON.parse(reply);
    if(!parseInt(obj.error))
    {
        location.reload();
    }
}

function deleteRole(tid)
{
    var fd = new FormData();
    fd.append("tid", tid);
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('load', deleteRoleResponse, false);
    xhr.open("POST", rootPath + "set/delete_ruolo.php");
    xhr.send(fd);
}
