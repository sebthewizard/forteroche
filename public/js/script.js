window.onload = function() {
	
	tinymce.init({
    	selector: '#editserial',
		language: 'fr_FR'
  	});
	
	// function to close burger menu after a click on an element 
	$(function() { 
     	var navMain = $(".navbar-collapse");
     	navMain.on("click", "a", null, function () {
         	navMain.collapse('hide');
     	});
 	});
	
	var tnch = document.getElementById("textNotConnectedHome");
	if (tnch !== null) tnch.style.opacity = "1";
	var fr = document.getElementById("formRegister");
	if (fr !== null) fr.style.opacity = "1";
	var fc = document.getElementById("formConnect");
	if (fc !== null) fc.style.opacity = "1";
}
