function recovery() {
	const email = $(".emailInput").value();

	if (email == null || email.length < 1) {
		showError("Email inválido.");
	}

	const url = "/api/account/recovery";

	const data = {
		email,
	};

	$.post(url, data).done(recoveryCb).fail(showError);
}

function receoveryCb(response) {
	if (response.ok) {
		alert("Instruções foram enviadas para o seu email.");
	}
}
