function recovery() {
	const email = $("#emailInput").val();

	if (email == null || email.length < 1) {
		showError("Email inválido.");
	}

	const url = "/index.php/api/account/recovery";

	const data = {
		email,
	};

	$.post(url, JSON.stringify(data)).done(recoveryCb).fail(showError);
}

function recoveryCb(response) {
	if (response.ok) {
		alert("Instruções foram enviadas para o seu email.");
	}
}
