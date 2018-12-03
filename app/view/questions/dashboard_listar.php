<div class="text-right mb-4">
    <a href="<?= DIRPAGE . "dashboard/questions/cadastrar/{$this->getView('quiz_id')}"; ?>" class="btn btn-success px-4"><i class="ion-plus-round"></i> Adicionar Questão</a>
</div>
<ul class="content-list">
    <?= $this->getView("contentList"); ?>
</ul>