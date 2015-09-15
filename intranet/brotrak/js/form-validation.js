function validate_form(form) {
	for (var i=0;i<form.length;i++) {
		if((form.elements[i].value==null || form.elements[i].value == "")) {
			if(form.elements[i].type != "hidden") {
				alert(form.elements[i].title);
				return false;
			}
		}
	}	
}