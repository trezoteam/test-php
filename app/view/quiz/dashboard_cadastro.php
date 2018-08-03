<form method="post" action="<?= DIRPAGE . $this->getView("save_url"); ?>">
    <input type="hidden" name="id" value="<?= $this->getView("data")['id']; ?>">
    <div class="form-group">
        <label>Título</label>
        <input type="text" name="name" class="form-control" placeholder="Título do Tópico" value="<?= $this->getView("data")['name']; ?>">
    </div>
    <div class="form-group">
        <label>Descrição</label>
        <textarea class="form-control" name="description" placeholder="..." rows="5"><?= $this->getView("data")['description']; ?></textarea>
        <small id="emailHelp" class="form-text text-muted">Adicione uma descrição sobre o tópico</small>
    </div>
    <div class="alert mb-4 d-none <?= $this->getView("mensagem_cadastro_class"); ?>"><?= $this->getView("mensagem_cadastro"); ?></div>
    <div class="text-right">
        <button type="submit" class="btn btn-success px-5"><i class="ion-plus-round"></i> Salvar Tópico</button>
    </div>
</form>
