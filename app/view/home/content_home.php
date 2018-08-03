<div class="container d-flex pagecontent">
    <div class="row align-self-center justify-content-center w-100">
        <div class="mb-3 col-12 text-center">
            <h1 class="display-4 text-success"><?= SITE_TITLE; ?></h1>
            <h2 class="font-weight-light text-secondary">Seja bem vindo(a) ao nosso QUIZ.</h2>
            <span class="h5 font-weight-light mt-5 d-block text-secondary">Entre com seu nome e email para começar a responder. ;)</span>
        </div>
        <form class="col-5 align-content-center" method="post" action="<?= DIRPAGE; ?>home/submit">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="ion-person"></i></div>
                </div>
                <input type="text" name="name" class="form-control" placeholder="Nome">
            </div>
            <div class="input-group my-4">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="ion-android-mail"></i></div>
                </div>
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="alert mb-4 d-none <?= $this->getView("login_message_class"); ?>"><?= $this->getView("login_message"); ?></div>
            <div class="text-right">
                <button type="submit" class="btn btn-success px-5"><i class="ion-log-in"></i> Entrar</button>
            </div>
        </form>
    </div>
</div>
