<link rel="stylesheet" href="/static/css/login.css">

<div class="container">
    <div class="center">
        <div class="image"></div>
        <br />

        <?php echo validation_errors(); ?>
        <?php echo form_open('login/create'); ?>
        <div>
            <input type="email" class="form-control" placeholder="Email" name="email" />
            <br />
            <input type="password" class="form-control" placeholder="Senha" name="password" />

            <br />
            <button type="submit" class="btn btn-default">
                Entrar
            </button>
            <button type="button" class="btn btn-default">
                Recuperar senha
            </button>
        </div>

        </form>
    </div>
</div>

<script src="/static/js/login.js"></script>