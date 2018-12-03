<div class="row justify-content-center">
    <div class="col">
        <div class="bg-info text-white rounded py-3 px-3 text-center">
            <h5 class="font-weight-light">Respostas Usuários</h5>
            <h5><?= $this->getView("totalRespostasUsuarios"); ?></h5>
        </div>
    </div>
    <div class="col">
        <div class="bg-info text-white rounded py-3 px-3 text-center">
            <h5 class="font-weight-light">Acertos Usuários</h5>
            <h5><?= $this->getView("totalRespostasCertas"); ?></h5>
        </div>
    </div>
    <div class="col">
        <div class="bg-info text-white rounded py-3 px-3 text-center">
            <h5 class="font-weight-light">Erros Usuários</h5>
            <h5><?= $this->getView("totalRespostasErradas"); ?></h5>
        </div>
    </div>

    <div class="col-12 pb-4">
    </div>

    <div class="col">
        <div class="bg-light border text-secondary rounded py-3 px-3 text-center">
            <h5 class="font-weight-light">Usuários</h5>
            <h5><?= $this->getView("totalUsuarios"); ?></h5>
        </div>
    </div>
    <div class="col">
        <div class="bg-light border text-secondary rounded py-3 px-3 text-center">
            <h5 class="font-weight-light">Tópicos</h5>
            <h5><?= $this->getView("totalTopicos"); ?></h5>
        </div>
    </div>
    <div class="col">
        <div class="bg-light border text-secondary rounded py-3 px-3 text-center">
            <h5 class="font-weight-light">Questões</h5>
            <h5><?= $this->getView("totalQuestoes"); ?></h5>
        </div>
    </div>
    <div class="col">
        <div class="bg-light border text-secondary rounded py-3 px-3 text-center">
            <h5 class="font-weight-light">Respostas</h5>
            <h5><?= $this->getView("totalRespostas"); ?></h5>
        </div>
    </div>

    <div class="col-12 <?= (($this->getView("respostasIndefinidas") == null) ? "d-none" : ""); ?>">
        <div class="py-2 px-3 bg-light border mt-4 rounded">
            <h5 class="text-danger border-bottom pb-2 mb-0 text-center">Você não definiu a resposta correta das seguintes questões:</h5>
            <ul class="content-list"><?= $this->getView("respostasIndefinidas"); ?></ul>
        </div>
    </div>

    <div class="col-12">
        <div class="py-2 px-3 bg-light border mt-4 rounded">
            <h5 class="text-success border-bottom pb-2 mb-0 text-center">Ver respostas por usuário:</h5>
            <ul class="users-list"><?= $this->getView("respostasUsuarios"); ?></ul>
        </div>
    </div>



















</div>