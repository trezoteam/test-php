<div>
    <h5 class="float-left">Usuário: <span class="text-secondary"><?= $this->getView("userName"); ?></span></h5>
    <span class="float-right text-secondary"><?= $this->getView('userStatistics')['topicos']; ?> Tópicos | <?= $this->getView('userStatistics')['respostas']; ?> Repostas | <?= $this->getView('userStatistics')['acertos']; ?> Acertos</span>
    <div class="clear"></div>
</div>
<table class="table table-bordered table-striped mt-4">
    <thead>
        <tr>
            <th scope="col" class="col-2">Tópico</th>
            <th scope="col" class="col-5">Questão</th>
            <th scope="col" class="col-3">Resposta</th>
            <th scope="col" class="col-2">Acerto</th>
        </tr>
    </thead>
    <tbody>
        <?= $this->getView('userListaRespostas'); ?>
    </tbody>
</table>