var rootPath = "/";
var urlPathRegex = /http[s]*:\/\/[^\/]+(\/.+)/;

function stampa(value)
{
    console.log(value);
}

function resetSelected(select)
{
    for(var i = 0; i < select.options.length; i++)
    {
        select.options[i].selected = false;
    }
}

function resetMultipleSelected(select)
{

    for(var i = 0; i < select.options.length; i++)
    {
        $(select).find('option:eq(' + i + ')').prop('selected', false).change();
    }
}

function selectMultipleSelected(select,i)
{
    $(select).find('option:eq(' + i + ')').prop('selected', true).change();
}

function selectMultipleSelectedByValue(select,value)
{
    $(select).find('option[value="' + value + '"]').prop('selected', true).change();
    //$('#' + selectId + ' option[value="' + value + '"]').prop('selected', true).change();
}

function get_today_date()
{
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = dd + '/' + mm + '/' + yyyy;
    return today;
}

function convert_timestamp_in_string(timestamp)
{
    var date = new Date(timestamp*1000);
    var formattedTime = date.getDate() + '/' + (date.getMonth()+1) + '/' + date.getFullYear();

    return formattedTime;
}

function getIndexFromValue(select,value)
{
    var index;
    for(var i = 0; i < select.options.length; i++)
    {
        if(parseInt(select.options[i].value) === parseInt(value))
        {
            index = i;
        }
    }
    return index;
}

function gotoLink(link)
{
    location.href = link;
}

function stampaMessaggioStandard(messaggio)
{
    swal({
        text: messaggio,
        button: {
          text: "OK",
          value: true,
          visible: true,
          className: "btn btn-primary"
        }
      });
      var modalClass = document.getElementsByClassName("swal-overlay");
      modalClass[0].scrollTop = 0;
}

function stampaMessaggioSuccesso(titolo,messaggio)
{
    swal({
        title: titolo,
        text: messaggio,
        icon: 'success',
        button: {
          text: "Continua",
          value: true,
          visible: true,
          className: "btn btn-primary"
        }
      });
}

function showFieldById(id)
{
    var field = document.getElementById(id);
    field.style.display = "";
}
function unShowFieldById(id)
{
    var field = document.getElementById(id);
    field.style.display = "none";
}

function showFieldsByClassName(ClassName)
{
    var fields = document.getElementsByClassName(ClassName);
    for(var i=0;i<fields.length;i++)
    {
        fields[i].style.display = "";
    }
}
function unShowFieldsByClassName(ClassName)
{
    var fields = document.getElementsByClassName(ClassName);
    for(var i=0;i<fields.length;i++)
    {
        fields[i].style.display = "none";
    }
}
