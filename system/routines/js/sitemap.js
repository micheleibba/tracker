var rootPath = "/tracker/";

function editSitemapResponse(evt)
{
    var reply = evt.target.responseText;
    var obj = JSON.parse(reply);
    if(!parseInt(obj.error))
    {
        var smid = document.getElementById("smid");
        var titolo = document.getElementById("titolo");
        var path = document.getElementById("path");
        smid.value = obj.smid;
        titolo.value = obj.titolo;
        path.value = obj.path;
    }
}

function editSitemap(smid)
{
    var fd = new FormData();
    fd.append("smid", smid);
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('load', editSitemapResponse, false);
    xhr.open("POST", rootPath + "get/sitemap.php");
    xhr.send(fd);
}

function deleteSitemapResponse(evt)
{
    var reply = evt.target.responseText;
    var obj = JSON.parse(reply);
    if(!parseInt(obj.error))
    {
        location.reload();
    }
}

function deleteSitemap(smid)
{
    var fd = new FormData();
    fd.append("smid", smid);
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('load', deleteSitemapResponse, false);
    xhr.open("POST", rootPath + "set/delete_sitemap.php");
    xhr.send(fd);
}
