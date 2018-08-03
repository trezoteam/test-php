<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?= $this->getDescription(); ?>">
        <link rel="url" href="<?= DIRPAGE; ?>"/>
        <title><?= $this->getTitle(); ?></title>
        <link href="<?= DIRCSS; ?>bootstrap-reboot.css" rel="stylesheet" type="text/css">
        <link href="<?= DIRCSS; ?>bootstrap.css" rel="stylesheet" type="text/css">
        <link href="<?= DIRCSS; ?>ionicons.css" rel="stylesheet" type="text/css">
        <link href="<?= DIRCSS; ?>site.css" rel="stylesheet" type="text/css">
        <script src="<?= DIRJS; ?>jquery.js" type="text/javascript"></script>
        <script src="<?= DIRJS; ?>bootstrap.js" type="text/javascript"></script>
        <script src="<?= DIRJS; ?>bootstrap.bundle.js" type="text/javascript"></script>
        <script src="<?= DIRJS; ?>site.js" type="text/javascript"></script>
        <?= $this->addHead(); ?>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <a class="navbar-brand" href="<?= DIRPAGE; ?>"><?= SITE_TITLE; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link loginBtn" href="<?= DIRPAGE; ?>">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= DIRPAGE; ?>login/">Painel Administrativo</a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php
        if ($this->addDashboard() != true) {
            $this->addContent($this->getView('content'));
        }
        ?>
        <div class="footer bg-dark py-4 mt-5">
            <div class="container text-center text-light">
                <?= SITE_TITLE . " - Autor: " . SITE_AUTHOR; ?>
                <span class="d-block mt-2">© Copyright <?= date("Y"); ?></span>
            </div>
        </div>
    </body>
</html>