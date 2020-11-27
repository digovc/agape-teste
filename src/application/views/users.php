<link rel="stylesheet" href="/static/css/users.css">

<div class="container">
    <div class="center">
        <div class="image"></div>

        <br />

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Ativo</th>
                    <th>Administrador</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>

        <button class="btn btn-default" click="newUser()">
            Novo
        </button>

        <button id="previousButton" class="btn btn-default" click="previousPage()">
            Página anterior
        </button>

        <button id="nextButton" class="btn btn-default" click="nextPage()">
            Próxima página
        </button>

        <button class="btn btn-default" click="logoff()">
            Sair
        </button>
    </div>
</div>

<script src="/static/js/users.js"></script>