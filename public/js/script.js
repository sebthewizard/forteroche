window.onload = function() {
	
	tinymce.init({
    	selector: '#editserial',
  	});
	
	// function to close burger menu after a click on an element 
	$(function() { 
     	var navMain = $(".navbar-collapse");
     	navMain.on("click", "a", null, function () {
         	navMain.collapse('hide');
     	});
 	});
	
	var helloRegisterText = document.getElementById("hello-register-container");
	helloRegisterText.style.top = "0";
}
