<div class="container pagecontent">
    <div class="row w-100 pt-5 justify-content-center">
        <div class="mb-3 col-12 text-center">
            <h3 class="font-weight-light text-secondary"><?= $this->getView("topicTitle"); ?></h3>
            <div class="text-left py-3 px-3 rounded border bg-light shadow-sm text-secondary <?= (($this->getView("topicDescription") == null) ? "d-none" : ""); ?>"><?= $this->getView("topicDescription"); ?></div>
        </div>
        <?php if ($this->getView("quizId") != null) { ?>
            <form action="<?= $this->getView("quizSave"); ?>" method="post">
                <input type="hidden" name="id" value="<?= $this->getView("quizId"); ?>">
                <input type="hidden" name="started" value="<?= $this->getView("quizStart"); ?>">
                <ul class="col-12 text-left list-quiz">
                    <?= $this->getView("questionsList"); ?>
                </ul>
                <div class="alert mt-5 <?= $this->getView("mensagem_class"); ?>"><?= $this->getView("mensagem"); ?></div>
                <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-success w-50"><i class="ion-log-in"></i> Responder</button>
                </div>
            </form>
        <?php } ?>
        <ul class="col-12 col-md-6 mt-4 text-center list-quiz">
            <?= $this->getView("topicList"); ?>
        </ul>
    </div>
</div>
