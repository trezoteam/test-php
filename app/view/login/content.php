<div class="container d-flex h-75">
    <div class="row align-self-center justify-content-center w-100">
        <h1 class="display-4 mb-5 col-12 text-center">Acesse sua conta</h1>
        <form class="col-5 align-content-center" method="post" action="<?= DIRPAGE; ?>login/submit">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="ion-android-mail"></i></div>
                </div>
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="input-group my-4">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="ion-asterisk"></i></div>
                </div>
                <input type="password" name="pass" class="form-control" placeholder="Senha">
            </div>
            <div class="alert mb-4 d-none <?= $this->getView("login_message_class"); ?>"><?= $this->getView("login_message"); ?></div>
            <div class="text-right">
                <button type="submit" class="btn btn-success px-5"><i class="ion-log-in"></i> Entrar</button>
            </div>
        </form>
    </div>
</div>
