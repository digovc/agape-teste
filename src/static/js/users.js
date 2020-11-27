const query = new URLSearchParams(window.location.search);
const index = query.get("index") ?? 0;

function addUser(user) {
	const tr = document.createElement("tr");
	addUserColumn(tr, user.name);
	addUserColumn(tr, user.login);
	addUserColumn(tr, user.email);
	addUserColumn(tr, user.isEnabled);
	addUserColumn(tr, user.isAdmin);
	addUserColumnAction(tr, "Editar", () => alterUser(user.id));
	addUserColumnAction(tr, "Remover", () => removeUser(user.id));
	$(".tbody").appendChild(tr);
}

function addUserColumn(tr, value) {
	const td = document.createElement("td");
	td.innerText = value;
	tr.appendChild(td);
}

function addUserColumnAction(tr, title, callback) {
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

function alterUser(userId) {
	location.pathname = "/index.php/views/user?id=" + userId;
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

function removeUser(userId) {}

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
		users.forEach((user) => addUser(user));
	}
}

window.onload = initPage;
