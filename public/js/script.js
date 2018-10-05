window.onload = function() {
	
	tinymce.init({
    	selector: '#editserial',
		theme: "modern",
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | fullpage | fontselect fontsizeselect",
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
	
	var ca = document.getElementById("commentAdded");
	if (ca !== null) {
		var sc = document.getElementById("sendComment");
		var rect = sc.getBoundingClientRect();
		window.scroll({
			top: rect.top,
			left: 0,
			behavior: 'smooth'
		});
	}
	
	var cs = document.getElementById("commentSignaled");
	if (cs !== null) {
		var shc = document.getElementById("showComment");
		var rect = shc.getBoundingClientRect();
		window.scroll({
			top: rect.top,
			left: 0,
			behavior: 'smooth'
		});
	}
	
	var cp = document.getElementById("commentPage");
	if (cp !== null) {
		var pc = document.getElementById("pageComment");
		var rect = pc.getBoundingClientRect();
		window.scroll({
			top: rect.top,
			left: 0,
			behavior: 'smooth'
		});
	}
}
