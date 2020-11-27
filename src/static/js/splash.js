function goToLogin() {
	setTimeout(() => {
		location.pathname = "/index.php/views/login";
	}, 1500);
}

window.onload = () => goToLogin();
