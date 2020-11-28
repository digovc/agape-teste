function login() {
	const login = $("#loginInput").val();

	if (login == null || login.length < 1) {
		showError("Login inválido.");
	}

	const password = $("#passwordInput").val();

	if (password == null || password.length < 1) {
		showError("Senha inválida.");
	}

	const url = "/index.php/api/session/login";

	const data = {
		login,
		password,
	};

	$.post(url, JSON.stringify(data)).done(loginCb).fail(showError);
}

function loginCb(response) {
	if (response.ok) {
		const token = response.token;
		sessionStorage.setItem("token", token);
		location.pathname = "/index.php/views/users";
	}
}

function goToRecovery() {
	location.pathname = "/index.php/views/recoverystep1";
}
