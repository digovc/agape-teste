function login() {
	const login = $(".loginInput").value();

	if (login == null || login.length < 1) {
		showError("Login inválido.");
	}

	const password = $(".passwordInput").value();

	if (password == null || password.length < 1) {
		showError("Senha inválida.");
	}

	const url = "/api/session/login";

	const data = {
		login,
		password,
	};

	$.post(url, data).done(loginCb).fail(showError);
}

function loginCb(response) {
	if (response.ok) {
		const token = response.token;
		sessionStorage.setItem("token", token);
		location.pathname = "/index.html/views/users";
	}
}

function goToRecovery() {
	location.pathname = "/index.php/views/recovery_step_1";
}
