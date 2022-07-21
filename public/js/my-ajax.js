
var div = 'showresult';
var loadingmessage = '<img src="http://samane88.com/loading.gif" alt="loading"  width="200"  style="text-align: center"/> لطفا کمي صبر کنيد...';
function Ajaxrequest(){
    var xmlHttp;
    try{
        // Firefox, Opera 8.0+, Safari
        xmlHttp=new XMLHttpRequest();
        return xmlHttp;
        }
        catch (e){
            try{
                // Internet Explorer
                xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
                return xmlHttp;
                }
                catch (e){
                    try{
                        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
                        return xmlHttp;
                        }
                        catch (e){
                            alert("مرورگر شما از آژاکس پشتيباني نمي کند!");
                            return false;
            }
        }
    }
}
function formget(form, url) {
    var poststr = getFormValues(form);
    postData(url, poststr);
}
function postData(url, parameters){
    var xmlHttp = Ajaxrequest();
    xmlHttp.onreadystatechange =  function(){
        if(xmlHttp.readyState > 0 && xmlHttp.readyState < 4){
            document.getElementById(div).innerHTML=loadingmessage;
            }
            if (xmlHttp.readyState == 4) {
                document.getElementById(div).innerHTML=xmlHttp.responseText;
                }
                }
                xmlHttp.open("POST", url, true);
                xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlHttp.setRequestHeader("Content-length", parameters.length);
                xmlHttp.setRequestHeader("Connection", "close");
                xmlHttp.send(parameters);
}
function getFormValues(formobj)
{
    var str = "";
    var valueArr = null;
    var val = "";
    var cmd = "";
    for(var i = 0;i < formobj.elements.length;i++)
    {
        switch(formobj.elements[i].type)
        {
            case "hidden":
            str += formobj.elements[i].name +
            "=" + encodeURI(formobj.elements[i].value) + "&";
            break;
            case "text":
                str += formobj.elements[i].name +
                    "=" + encodeURI(formobj.elements[i].value) + "&";
                break;
            case "textarea":
                str += formobj.elements[i].name +
                    "=" + encodeURI(formobj.elements[i].value) + "&";
                break;
            case "email":
                str += formobj.elements[i].name +
                    "=" + encodeURI(formobj.elements[i].value) + "&";
                break;
            case "number":
                str += formobj.elements[i].name +
                    "=" + encodeURI(formobj.elements[i].value) + "&";
                break;
                 case "select-one":
            str += formobj.elements[i].name +
            "=" + formobj.elements[i].options[formobj.elements[i].selectedIndex].value + "&";
            break;




        }
        }
str = str.substr(0,(str.length - 1));
return str;
}
