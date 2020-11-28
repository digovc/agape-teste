const query = new URLSearchParams(location.search);
const accountId = query.get("id");

function goToUsers() {
	location.pathname = "/index.php/views/users";
}

function initPage() {
	if (accountId != "new" && accountId > 0) {
		retrieve();
	}
}

function retrieve() {
	const url = "/index.php/api/user/retrieve_user";
	const token = sessionStorage.getItem("token");

	const data = {
		token,
		accountId,
	};

	$.post(url, JSON.stringify(data)).done(retrieveCb).fail(showError);
}

function retrieveCb(response) {
	if (response.ok) {
		const account = response.account;
		$("#nameInput").val(account.name);
		$("#loginInput").val(account.login);
		$("#emailInput").val(account.email);
		$("#passwordInput").val(account.password);
		$("#isEnabledInput").prop("checked", account.isEnabled == true);
		$("#isAdminInput").prop("checked", account.isAdmin == true);
	}
}

function save() {
	const name = $("#nameInput").val();

	if (name == null || name.length < 1) {
		showError("Nome inválido.");
	}

	const login = $("#loginInput").val();

	if (login == null || login.length < 1) {
		showError("Login inválido.");
	}

	const email = $("#emailInput").val();

	if (email == null || email.length < 1) {
		showError("Email inválido.");
	}

	const password = $("#passwordInput").val();

	if (password == null || password.length < 1) {
		showError("Senha inválida.");
	}

	const isEnabled = $("#isEnabledInput").prop("checked");
	const isAdmin = $("#isAdminInput").prop("checked");
	const id = accountId;

	const user = {
		id: id != "new" ? id : 0,
		name,
		login,
		email,
		password,
		isEnabled,
		isAdmin,
	};

	const token = sessionStorage.getItem("token");

	const data = {
		token,
		user,
	};

	const url = "/index.php/api/user/save";
	$.post(url, JSON.stringify(data)).done(saveCb).fail(showError);
}

function saveCb(response) {
	if (response.ok) {
		alert("Usuário salvo com sucesso.");
		location.href = "/index.php/views/users";
	}
}

window.onload = initPage;
