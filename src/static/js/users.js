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
	$(".tbody").appendChild(tr);
}

function addAccountColumn(tr, value) {
	const td = document.createElement("td");
	td.innerText = value;
	tr.appendChild(td);
}

function addAccountColumnAction(tr, title, callback) {
	const button = document.createElement("button");
	button.classList.appendChild("btn");
	button.classList.appendChild("btn-default");
	button.click = callback;
	button.innerText = title;

	const td = document.createElement("td");
	td.innerText = value;
	td.appendChild(button);

	tr.appendChild(td);
}

function alterAccount(accountId) {
	location.pathname = "/index.php/views/user?id=" + accountId;
}

function initPage() {
	if (index == 0) {
		$(".previousButton").hide();
	}

	retrieveUsers(index);
}

function logoff() {
	sessionStorage.removeItem("token");
	goToLogin();
}

function newUser() {
	location.pathname = "/index.php/views/user?id=new";
}

function nextPage() {
	const url = "/index.php/views/users?index=" + (index + 1);
	location.pathname = url;
}

function previousPage() {
	if (index > 0) {
		const url = "/index.php/views/users?index=" + (index - 1);
		location.pathname = url;
	}
}

function retrieveUsers(index) {
	const url = "/api/user/retrieve_users";
	const token = sessionStorage.getItem("token");

	if (token == null) {
		goToLogin();
		return;
	}

	const data = {
		token,
		index,
	};

	$.post(url, data).done(retrieveUsersCb).fail(showError);
}

function retrieveUsersCb(response) {
	if (response.ok) {
		const users = response.users;
		users.forEach((user) => addAccount(user));
	}
}

window.onload = initPage;
