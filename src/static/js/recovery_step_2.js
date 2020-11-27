function changePasword() {
	const query = new URLSearchParams(window.location.search);
	const token = query.get("token");

	if (token == null || token.length < 1) {
		showError("Token inválido.");
	}

	const password = $(".passwordInput").value();

	if (password == null || password.length < 1) {
		showError("Senha inválida.");
	}

	const url = "/api/account/change_password";

	const data = {
		token,
		password,
	};

	$.post(url, data).done(recoveryCb).fail(showError);
}

function changePaswordCb(response) {
	if (response.ok) {
		alert("Senha alterada com sucesso.");
		goToLogin();
	}
}
