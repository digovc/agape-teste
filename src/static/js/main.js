function goToLogin() {
	location.pathname = "/index.php/views/login";
}

function showError(error) {
	alert(error);
	throw new Error(error);
}
