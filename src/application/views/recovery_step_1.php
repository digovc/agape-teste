<link rel="stylesheet" href="/static/css/recovery_step_1.css">

<div class="container limited">
    <div class="center">
        <div class="image"></div>
        <br />

        <div>
            <input id="emailInput" type="email" class="form-control" placeholder="Email" />
            <br />
            
            <button type="submit" class="btn btn-default" onclick="recovery()">
                Recuperar a senha
            </button>
            
            <button type="button" class="btn btn-default" onclick="goToLogin()">
                Cancelar
            </button>
        </div>
    </div>
</div>

<script src="/static/js/recovery_step_1.js"></script>