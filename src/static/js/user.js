const query = new URLSearchParams(location.search);
const accountId = query.get("accountId");

function goToUsers() {
	location.pathname = "/index.php/views/users";
}

function save() {
	const name = $(".nameInput").value();

	if (name == null || name.length < 1) {
		showError("Nome inválido.");
	}

	const login = $(".loginInput").value();

	if (login == null || login.length < 1) {
		showError("Login inválido.");
	}

	const email = $(".emailInput").value();

	if (email == null || email.length < 1) {
		showError("Email inválido.");
	}

	const isEnabled = $(".isEnabledInput").value();
	const isAdmin = $(".isAdminInput").value();
	const id = accountId;

	if (id == "new") {
		id = 0;
	}

	const account = {
		id,
		name,
		login,
		email,
		isEnabled,
		isAdmin,
	};

	$.post(url, account).done(saveCb).fail(showError);
}

function saveCb(response) {
	if (response.ok) {
		alert("Usuário salvo com sucesso.");
		location.pathname = "/index.php/views/users";
	}
}
