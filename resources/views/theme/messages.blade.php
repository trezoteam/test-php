<div class="row">
    @if (Session::has('notice'))
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ Session::get('notice') }}
            </div>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ Session::get('error') }}
            </div>
        </div>
    @endif
</div>