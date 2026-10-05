var xmlHttp

//----------------------Start Customer Information-------------------------------------
function showCustomerAddress(field,str1,str2,str3)
{ 
var str=str1+str2+str3;
/*if (str2.length<6) { 
	alert('That entry does not exist.'); 
 	str2.value=""; 
	str2.focus();
	return false; 
} */

var url="getcustomer.php?sid=" + Math.random() + "&q=" + str
xmlHttp=GetXmlHttpObject(stateChanged)
xmlHttp.open("GET", url , true)
xmlHttp.send(null)
} 

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById("txtHint").innerHTML=xmlHttp.responseText 
} 
} 
//----------------End Customer Information -----------------------------------

//--------------------- For Product List---------------------------------------
function showProduct(field,str1)
{ 
var strPro=str1;
var url="getproduct.php?sid=" + Math.random() + "&p=" + strPro
xmlHttp=GetXmlHttpObject(ProstateChanged)
xmlHttp.open("GET", url , true)
xmlHttp.send(null)
} 

function ProstateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById("txtPro").innerHTML=xmlHttp.responseText 
} 
} 
//----------------------End Product List -------------------------------------

//----------------------Start Last Request Information-------------------------------------
function showLastRequest(last1,last2,last3)
{ 
var strLast=last1+last2+last3;

var url="getlastreq.php?sid=" + Math.random() + "&l=" + strLast
xmlHttp=GetXmlHttpObject(LastRequestStateChanged)
xmlHttp.open("GET", url , true)
xmlHttp.send(null)
} 

function LastRequestStateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById("txtLast").innerHTML=xmlHttp.responseText 
} 
} 
//----------------End Last Request Information -----------------------------------




function GetXmlHttpObject(handler)
{ 
var objXmlHttp=null

if (navigator.userAgent.indexOf("Opera")>=0)
{
alert("This example doesn't work in Opera") 
return 
}
if (navigator.userAgent.indexOf("MSIE")>=0)
{ 
var strName="Msxml2.XMLHTTP"
if (navigator.appVersion.indexOf("MSIE 5.5")>=0)
{
strName="Microsoft.XMLHTTP"
} 
try
{ 
objXmlHttp=new ActiveXObject(strName)
objXmlHttp.onreadystatechange=handler 
return objXmlHttp
} 
catch(e)
{ 
alert("Error. Scripting for ActiveX might be disabled") 
return 
} 
} 
if (navigator.userAgent.indexOf("Mozilla")>=0)
{
objXmlHttp=new XMLHttpRequest()
objXmlHttp.onload=handler
objXmlHttp.onerror=handler 
return objXmlHttp
}
} 