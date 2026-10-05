

function toggleMenu(objID) {
	if (!document.getElementById) 
	return; 
	var ob = document.getElementById(objID).style; 
	ob.display = (ob.display == 'block')? 'none': 'block';
}

/*
var currentlyOpen = null;

function toggleMenu(objID) {
  if (!document.getElementById) return;
  if (currentlyOpen != null) {
    currentlyOpen.display = 'none';
    currentlyOpen = null;
  }
  var ob = document.getElementById(objID).style;
  if (ob.display == 'block') {
    ob.display = 'none';
  } else {
    ob.display = 'block';
    currentlyOpen = ob;
  }
}
*/
