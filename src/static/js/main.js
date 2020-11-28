function goToLogin() {
	location.href = "/index.php/views/login";
}

function showError(error) {
	if (error.responseJSON) {
		error = error.responseJSON.message;
	}

	if (error.statusText) {
		error = error.statusText;
	}

	alert(error);
	throw new Error(error);
}
