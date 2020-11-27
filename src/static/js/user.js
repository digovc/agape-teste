const query = new URLSearchParams(location.search);
const accountId = query.get("accountId");

function goToUsers() {
	location.pathname = "/index.php/views/users";
}

function initPage() {
	if (accountId != "new" && accountId > 0) {
		const url = "index.php/api/user/retrieve_user";
		const token = sessionStorage.getItem("token");

		const data = {
			token,
			accountId,
		};

		$.post(url, data).done(retrieveCb).fail(showError);
	}
}

function retrieveCb(response) {
	if (response.ok) {
		const account = response.account;
		$(".nameInput").value(account.name);
		$(".loginInput").value(account.login);
		$(".emailInput").value(account.email);
		$(".passwordInput").value(account.password);
		$(".isEnabledInput").value(account.isEnabled);
		$(".isAdminInput").value(account.isAdmin);
	}
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

	const password = $(".passwordInput").value();

	if (password == null || password.length < 1) {
		showError("Senha inválida.");
	}

	const isEnabled = $(".isEnabledInput").value();
	const isAdmin = $(".isAdminInput").value();
	const id = accountId;

	if (id == "new") {
		id = 0;
	}

	const data = {
		id,
		name,
		login,
		email,
		password,
		isEnabled,
		isAdmin,
	};

	$.post(url, data).done(saveCb).fail(showError);
}

function saveCb(response) {
	if (response.ok) {
		alert("Usuário salvo com sucesso.");
		location.pathname = "/index.php/views/users";
	}
}

window.onload = initPage;
