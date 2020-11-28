const query = new URLSearchParams(location.search);
const index = query.get("index") ?? 0;

function addAccount(account) {
	const tr = document.createElement("tr");
	addAccountColumn(tr, account.name);
	addAccountColumn(tr, account.login);
	addAccountColumn(tr, account.email);
	addAccountColumn(tr, account.isEnabled);
	addAccountColumn(tr, account.isAdmin);
	addAccountColumnAction(tr, "Editar", () => alterAccount(account.id));
	$("#tbody").append(tr);
}

function addAccountColumn(tr, value) {
	if (value == 1) {
		value = "Sim";
	}

	if (value == 0) {
		value = "Não";
	}

	const td = document.createElement("td");
	td.innerText = value;
	tr.appendChild(td);
}

function addAccountColumnAction(tr, title, callback) {
	const button = document.createElement("button");
	button.classList.add("btn");
	button.classList.add("btn-default");
	button.onclick = callback;
	button.innerText = title;

	const td = document.createElement("td");
	td.appendChild(button);

	tr.appendChild(td);
}

function alterAccount(accountId) {
	location.href = "/index.php/views/user?id=" + accountId;
}

function initPage() {
	if (index > 0) {
		$("#previousButton").attr("disabled", false);
	}

	retrieveUsers(index);
}

function logoff() {
	sessionStorage.removeItem("token");
	goToLogin();
}

function newUser() {
	location.href = "/index.php/views/user?id=new";
}

function nextPage() {
	const url = "/index.php/views/users?index=" + (index + 1);
	location.href = url;
}

function previousPage() {
	if (index > 0) {
		const url = "/index.php/views/users?index=" + (index - 1);
		location.href = url;
	}
}

function retrieveUsers(index) {
	const url = "/index.php/api/user/retrieve_users";
	const token = sessionStorage.getItem("token");

	if (token == null) {
		goToLogin();
		return;
	}

	const data = {
		token,
		index,
	};

	$.post(url, JSON.stringify(data)).done(retrieveUsersCb).fail(showError);
}

function retrieveUsersCb(response) {
	if (!response.ok) {
		return;
	}

	if (response.users.length == 10) {
		$("#nextButton").attr("disabled", false);
	}

	const users = response.users;
	users.forEach((user) => addAccount(user));
}

window.onload = initPage;
