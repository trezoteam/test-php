<div class="pagecontent container py-5">
    <div class="text-right">
        <h4 class="font-weight-light mb-1">Olá <?= $this->getView("user")['name']; ?>, seja bem vindo(a)!</h4>
        <a href="<?= DIRPAGE; ?>login/logout/" class="text-info"><i class="ion-log-out"></i> Desconectar</a>
    </div>
    <div class="row mt-4">
        <div class="list-group col-3">
            <a class="list-group-item list-group-item-action" href="<?= DIRPAGE; ?>dashboard/">Visão Geral</a>
            <a class="list-group-item list-group-item-action" href="<?= DIRPAGE; ?>dashboard/quiz/listar">Ver Tópicos</a>
            <a class="list-group-item list-group-item-action" href="<?= DIRPAGE; ?>dashboard/quiz/cadastrar">Cadastrar Tópicos</a>
        </div>
        <div class="col">
            <div class="pl-3">
                <div class="h5 border-bottom border-top py-3 text-center mb-4 bg-light"><?= $this->getView("dashboardTitle"); ?></div>
                <?= $this->addContent($this->getView("content")); ?>
            </div>
        </div>
    </div>
</div>
