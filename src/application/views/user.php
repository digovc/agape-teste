<link rel="stylesheet" href="/static/css/user.css">

<div class="container">
    <div class="center">
        <div class="image"></div>
        <br />

        <div>
            <input type="text" class="form-control" placeholder="Nome" name="name" />
            <br />
            <input type="text" class="form-control" placeholder="Login" name="login" />
            <br />
            <input type="email" class="form-control" placeholder="Email" name="email" />
            <br />
            <input type="checkbox" class="form-control" placeholder="Ativo" name="isEnabled" />
            <br />
            <input type="checkbox" class="form-control" placeholder="Administrador" name="isAdmin" />
            <br />

            <br />
            <button type="submit" class="btn btn-default" click="save()">
                Salvar
            </button>
            <button type="button" class="btn btn-default">
                Cancelar
            </button>
        </div>
    </div>
</div>

<script src="/static/js/user.js"></script>