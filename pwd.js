function validate(pwd){
	var button = document.getElementById("register");
	if (!pwd.match("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})")){
		button.disabled = false;
	}
	else
		button.disabled = true;
}