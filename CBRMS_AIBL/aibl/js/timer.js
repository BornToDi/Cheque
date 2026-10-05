var timeSpent = 0;

function timer()
{
	setTimeout('timer()', 1000);
	if(!document.forms['tupdate']) return;	//Form doesn't exist
	if(!document.forms['tupdate'].elements['pause']) return;	//Form improperly loaded
	if(document.forms['tupdate'].elements['pause'].checked) return;	//Paused
	
	timeSpent++;
	
	var seconds = timeSpent%60;
	if(seconds < 10) seconds = "0" + seconds.toString();
	var minutes = (timeSpent-seconds)/60;
	document.forms['tupdate'].elements['timespent'].value = minutes + ":" + seconds;
}

window.onload = timer;
