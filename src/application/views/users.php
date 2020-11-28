<link rel="stylesheet" href="/static/css/users.css">

<div class="container">
    <div class="center">
        <div class="image"></div>

        <br />

        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Ativo</th>
                    <th>Administrador</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>

        <br />

        <div class="btn-group">
            <button id="previousButton" class="btn btn-default" disabled onclick="previousPage()">
                Página anterior
            </button>

            <button id="nextButton" class="btn btn-default" disabled onclick="nextPage()">
                Próxima página
            </button>
        </div>

        <br />
        <br />

        <div class="btn-group">
            <button class="btn btn-default" onclick="newUser()">
                Novo
            </button>
            <button class="btn btn-default" onclick="logoff()">
                Sair
            </button>

        </div>

    </div>
</div>

<script src="/static/js/users.js"></script>