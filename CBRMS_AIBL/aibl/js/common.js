function isNumberKey(evt,enabledot)
{
	if(!enabledot) enabledot=0;
 var charCode = (evt.which) ? evt.which : event.keyCode
	 //alert(charCode)
 if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=46 && enabledot==1)
	return false;
 else if (charCode > 31 && (charCode < 48 || charCode > 57) && enabledot==0)
	return false;

 return true;
}


function UserInput_validate()
{
	var msghdr = "Please enter value for the following fields:-\n";
  	var msg = "";
	var err = 0;
	var frm  =  document.frmCheque;

	if(frm.req_by.value=="")
	{
		msg += "-> Requested By\n";
		err++;
	}
	
	if((frm.ac_no_branch.value=="") ||(frm.ac_no_suffix.value=="") || (frm.ac_no_cus_no.value==""))
	{
		msg+= "-> Account No\n";
		err++;	
		if(frm.ac_no_branch.value=="")
		frm.ac_no_branch.focus();
		if(frm.ac_no_suffix.value=="")
		frm.ac_no_suffix.focus();
		if(frm.ac_no_cus_no.value=="")
		frm.ac_no_cus_no.focus();			
	}
	
	if((frm.ac_no_cus_no.value.length<8) || (frm.ac_no_suffix.value.length<3)|| (frm.ac_no_branch.value.length<4))	
	{
		msg += "-> Input Valid A/C No\n";
		err++;	
		if(frm.ac_no_branch.value.length<4)
		frm.ac_no_branch.focus();
		if(frm.ac_no_suffix.value.length<3)
		frm.ac_no_suffix.focus();
		if(frm.ac_no_cus_no.value.length<8)
		frm.ac_no_cus_no.focus();
	}
	if(frm.req_branch.value=="")	
	{
		msg += "-> Requester Branch\n";
		err++;		
	}
	if(frm.req_date.value=="")
	{
		msg+= "-> Request Date\n";
		err++;		
	}
	
	if(frm.cus_name.value=="")
	{
		msg+= "-> Name of Customer\n";		
		err++;
	}
			
	if(frm.ac_type.value=="")
	{
		msg+= "-> Account type\n";
		err++;						
	}
	
	
	
	
	var radio_choice = false;  	
	for (var i=0; i<frm.total_leaf.length; i++)    
	{      
		if (frm.total_leaf[i].checked) {        
			radio_choice = true;         
			//break;      
		}     
	}    
	if(!radio_choice)  {
		msg+= "-> Account Type / Total Leaves\n";
		err++;
	}
		
	
	
	if(frm.severity.value=="")
	{
		msg+= "-> Delivery Urgency\n";
		err++;						
	}
	
	/*if(frm.req_status.value=="")
	{
		msg+= "-> Status of Request\n";
		err++;						
	}*/
	
	
	if(err>0){
     alert(msghdr+msg);
     return false;
	 }
  
  return true;
}


function req_advance_ac_no_cus_no(currentField,nextField) {   
	if (currentField.value.length == 3)
        document.frmCheque[nextField].focus();
}

function req_advance_ac_no_cus_no(currentField,nextField) {   
	if (currentField.value.length == 3)
        document.frmCheque[nextField].focus();
}


function advance_ac_no_cus_no(currentField,nextField) {
    if (currentField.value.length == 4)
        document.frmSearch[nextField].focus();
}

function advance_ac_no_suffix(currentField,nextField) {   
	if (currentField.value.length == 4)
        document.frmSearch[nextField].focus();
}

function advance_req_cus_name(currentField,nextField) {   
	if (currentField.value.length == 9)
        document.frmCheque[nextField].focus();
}

function advance_req_date_ibb(currentField,nextField) {   
	if (currentField.value.length == 6)
        document.frmCheque[nextField].focus();
}
function advance_password(currentField,nextField) {   
	if (currentField.value.length == 3)
        document.frmUser[nextField].focus();
}

function copyField(srcField,destField) {
		document.frmCheque[destField].value=document.frmCheque[srcField].value;
		if (document.frmCheque[srcField].value.length == 6){
        	document.frmCheque[destField].focus();}
}


function get_branch_code(srcField,destField) {
		$sr=document.frmCheque[srcField].value;
		
		document.frmCheque[destField].value=$sr;
		;
       // document.frmCheque[nextField].focus();
}

function get_cus_info(srcField,destField) {
		$sr=document.frmCheque[srcField].value;
		
		document.frmCheque[destField].value=$sr;
		
       // document.frmCheque[nextField].focus();
}


function BranchNameSelect(field, s) {
if (typeof BranchNameSelect.fieldLength == 'undefined') BranchNameSelect.fieldLength = field.value.length;
if (field.value.length<BranchNameSelect.fieldLength) {
BranchNameSelect.fieldLength = field.value.length;
return;
}
var val = field.value.toLowerCase(); 
var opt = 1, firstone, howmany = 0; 
while (s.options[opt] && s.options[opt].value.substring(0,val.length) != val) ++opt; 
firstone = opt; 
while (s.options[opt] && s.options[opt++].value.substring(0,val.length) == val) ++howmany; 
if (!howmany) { 
//alert('That entry does not exist.'); 
//field.select(); 
field.value=""; 
s.selectedIndex = 0;
return false; 
} 
//s.size = 1; 
s.selectedIndex = firstone; 
//s.size = howmany; 
if (howmany == 1) {
field.value = s.options[s.selectedIndex].value.toUpperCase();
BranchNameSelect.fieldLength = field.value.length;
}
} 


function BranchUserNameSelect(field,u) {
	
	if (field.value.length<3) { 
	alert('That entry does not exist.'); 
 	field.value=""; 
	field.focus();
	u.selectedIndex = 0;
	return false; 
} 

if (typeof BranchUserNameSelect.fieldLength == 'undefined') BranchUserNameSelect.fieldLength = field.value.length;
if (field.value.length<BranchUserNameSelect.fieldLength) {
BranchUserNameSelect.fieldLength = field.value.length;
return;
}
var val = field.value.toLowerCase(); 
var opt = 1, firstone, howmany = 0; 
while (u.options[opt] && u.options[opt].value.substring(0,val.length) != val) ++opt; 
firstone = opt; 
while (u.options[opt] && u.options[opt++].value.substring(0,val.length) == val) ++howmany; 
if (!howmany) { 
alert('That entry does not exist.'); 
//field.select(); 
field.value=""; 
u.selectedIndex = 0;
return false; 
} 
//s.size = 1; 
u.selectedIndex = firstone; 
//s.size = howmany; 
if (howmany == 1) {
field.value = u.options[u.selectedIndex].value.toUpperCase();
BranchUserNameSelect.fieldLength = field.value.length;
}
} 


function CusNameSelect(field, s) 
{
//document.frmCheque[destField].value=document.frmCheque[field].value;
if (typeof CusNameSelect.fieldLength == 'undefined') CusNameSelect.fieldLength = field.value.length;
if (field.value.length<CusNameSelect.fieldLength) {
CusNameSelect.fieldLength = field.value.length;
return;
}
var val = field.value.toLowerCase(); 
var opt = 1, firstone, howmany = 0; 
while (s.options[opt] && s.options[opt].value.substring(0,val.length) != val) ++opt; 
firstone = opt; 
while (s.options[opt] && s.options[opt++].value.substring(0,val.length) == val) ++howmany; 
if (!howmany) { 
//	alert('That entry does not exist.'); 
//field.select();
field.value=""; 
s.selectedIndex = 0;
return false; 
} 
//s.size = 1; 
s.selectedIndex = firstone; 
//s.size = howmany; 
if (howmany == 1) {
field.value = s.options[s.selectedIndex].value.toUpperCase();
CusNameSelect.fieldLength = field.value.length;
}
} 

function collecting_BranchNameSelect(field,s,b) {
if (field.value.length<4) { 
	alert('That entry does not exist.'); 
 	field.value=""; 
	field.focus();
	b.selectedIndex = 0;
	return false; 
} 
if (typeof collecting_BranchNameSelect.fieldLength == 'undefined') collecting_BranchNameSelect.fieldLength = field.value.length;
if (field.value.length<collecting_BranchNameSelect.fieldLength) {
collecting_BranchNameSelect.fieldLength = field.value.length;
return;
}
var val = field.value.toLowerCase(); 
var opt = 1, firstone, howmany = 0; 
while (s.options[opt] && s.options[opt].value.substring(0,val.length) != val) ++opt; 
firstone = opt; 
while (s.options[opt] && s.options[opt++].value.substring(0,val.length) == val) ++howmany; 
if (!howmany  || field.value.length<4) { 
//alert('That entry does not exist.'); 
//field.select(); 
field.value=""; 
field.focus();
s.selectedIndex = 0;
return false; 
} 
//s.size = 1; 
s.selectedIndex = firstone; 
//s.size = howmany; 
if (howmany == 1) {
field.value = s.options[s.selectedIndex].value.toUpperCase();
collecting_BranchNameSelect.fieldLength = field.value.length;
}
} 





/* this function will show image on icon on left and a messages on right of a field when a field is selected on a form*/
function showdiv_temp(desc_div,divimg)
{
	var tmp_arr = document.getElementsByTagName("div");
	for(var i = 0; i < tmp_arr.length; i++)
	{
		if(tmp_arr[i].className == "icon")
		{
			 tmp_arr[i].innerHTML = "&nbsp;&nbsp;&nbsp;";
		}
	}
	if(divimg != "")
	{
		var imgname = '<img src="js/aibl_icon.gif" border="0" alt="Locator" title="Locator"/>'
		eval("document.getElementById('"+divimg+"').innerHTML='"+imgname+"'");
	}
}

function showleft_icon(divimg)
{
	var tmp_arr = document.getElementsByTagName("div");
	for(var i = 0; i < tmp_arr.length; i++)
	{
		if(tmp_arr[i].className == "icon")
		{
			 tmp_arr[i].innerHTML = "&nbsp;";
		}
	}
	if(divimg != "")
	{
		var imgname = '<img src="js/icon.png" width="25" height="25" alt="Locator" title="Locator"/>'
		eval("document.getElementById('"+divimg+"').innerHTML='"+imgname+"'");
	}
}

checked=false;
function checkedAll () {
	//var aa= document.getElementById('frmChk');
	var aa= document.frmChk;
	 if (checked == false)
		  {
		   checked = true
		  }
		else
		  {
		  checked = false
		  }
		for (var i =0; i < aa.elements.length; i++) 
		 {
		 aa.elements[i].checked = checked;
		 }
		
	  }
	  
	function isChk() {
	var aa= document.frmChk;
	 
		 for (var i =0; i < aa.elements.length; i++) 
		 {
			if (aa.elements[i].checked){
			checked = true;       
			break; 
			 
			 }
		 }
		 if(!checked){
		 alert("Please make a selection from the list");
		 return false;
		 }
		 return true;
	  }


function PopSearchPrint(form) 
{ 
    var popName = "formpopup"
    var popStyle = "width=1000,height=570,location=no,resizable=yes";      
    form.action = "../aibl/popups/search_request_print.php"; 
	form.target = popName; 
    window.open("about:blank",popName,popStyle); 
} 
function PopSearchExcel(form) 
{         
    form.action = "../aibl/excel/search_excel.php"; 
 
}