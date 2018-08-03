<form method="post" action="<?= DIRPAGE . $this->getView("save_url"); ?>">
    <input type="hidden" name="id" value="<?= $this->getView("data")['id']; ?>">
    <input type="hidden" name="quiz_id" value="<?= ($this->getView("quiz_id") != null) ? $this->getView("quiz_id") : $this->getView("data")['quiz_id']; ?>">
    <div class="form-group mb-4">
        <label>Questão</label>
        <textarea class="form-control" name="subject" placeholder="Descreva a questão..." rows="5"><?= $this->getView("data")['subject']; ?></textarea>
    </div>
    <div class="<?= (($this->getView("data")['id'] == null) ? 'd-none' : ''); ?>">
        <span class="font-weight-bold text-primary border-bottom d-block">Respostas</span>
        <ul class="answers mb-4">
            <?= $this->getView("listAnswers"); ?>
        </ul>
    </div>
    <div class="alert mb-4 d-none <?= $this->getView("mensagem_cadastro_class"); ?>"><?= $this->getView("mensagem_cadastro"); ?></div>
    <div class="text-right">
        <button type="button" class="btn btn-info px-2 mr-4 addAnswer <?= (($this->getView("data")['id'] == null) ? 'd-none' : ''); ?>"><i class="ion-plus-round"></i> Adicionar Resposta</button>
        <button type="submit" class="btn btn-success px-5"><i class="ion-plus-round"></i> Salvar Questão</button>
    </div>
</form>