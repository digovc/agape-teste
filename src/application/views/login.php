<link rel="stylesheet" href="/static/css/login.css">

<div class="container">
    <div class="center">
        <div class="image"></div>
        <br />

        <div>
            <input id="loginInput" type="text" class="form-control" placeholder="Login" />
            <br />
            <input id="passwordInput" type="password" class="form-control" placeholder="Senha" />
            <br />

            <button class="btn btn-default" click="login()">
                Entrar
            </button>
            <button class="btn btn-default" click="goToRecovery()">
                Recuperar senha
            </button>
        </div>
    </div>
</div>

<script src="/static/js/login.js"></script>