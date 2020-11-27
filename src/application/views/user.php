<link rel="stylesheet" href="/static/css/user.css">

<div class="container">
    <div class="center">
        <div class="image"></div>
        <br />

        <div>
            <input id="nameInput" type="text" class="form-control" placeholder="Nome" />
            <br />
            <input id="loginInput" type="text" class="form-control" placeholder="Login" />
            <br />
            <input id="emailInput" type="email" class="form-control" placeholder="Email" />
            <br />
            <input id="passwordInput" type="password" class="form-control" placeholder="Senha" />
            <br />
            <input id="isEnabledInput" type="checkbox" class="form-control" placeholder="Ativo" />
            <br />
            <input id="isAdminInput" type="checkbox" class="form-control" placeholder="Administrador" />
            <br />

            <button type="submit" class="btn btn-default" click="save()">
                Salvar
            </button>

            <button type="button" class="btn btn-default" click="goToUsers()">
                Cancelar
            </button>
        </div>
    </div>
</div>

<script src="/static/js/user.js"></script>