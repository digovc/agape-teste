function logoff() {
	sessionStorage.removeItem("token");
	goToLogin();
}
