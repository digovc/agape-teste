function changePasword() {
	const query = new URLSearchParams(location.search);
	const token = query.get("token");

	if (token == null || token.length < 1) {
		showError("Token inválido.");
	}

	const password = $("#passwordInput").val();

	if (password == null || password.length < 1) {
		showError("Senha inválida.");
	}

	const url = "/index.php/api/account/change_password";

	const data = {
		token,
		password,
	};

	$.post(url, JSON.stringify(data)).done(changePaswordCb).fail(showError);
}

function changePaswordCb(response) {
	if (response.ok) {
		alert("Senha alterada com sucesso.");
		goToLogin();
	}
}
