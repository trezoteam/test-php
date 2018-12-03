<div class="modal fade" id="userEmailModal" tabindex="-1" role="dialog" aria-labelledby="userEmailModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Identifique-se!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="indentify" id="indentify" method="POST" action="{{route('quiz.answerSession')}}">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="name" id="nameUserQuiz" placeholder="Nome" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="email" name="email" id="emailUserQuiz" placeholder="E-mail" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12" id="errorMessage" style="display: none;">
                        <small style="color: red;">Informe os dados solicitados!</small>
                    </div>
                    <input type="hidden" name="quiz_id" id="quiz_id">
                </div>
                <div class="modal-footer">
                    <button type="button" id="storeUser" class="btn btn-primary">Responder
                </div>
            </form>
        </div>
    </div>
</div>