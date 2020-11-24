function goToLogin() {
	setTimeout(() => {
		location.pathname = "/index.php/login";
	}, 1500);
}

window.onload = () => goToLogin();
