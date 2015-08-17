@if(Session::has('flash_message_success'))
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i> Success</h4>
        {{ session('flash_message_success') }}
    </div>
@endif

@if(Session::has('flash_message_error'))
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        {{ session('flash_message_error') }}
    </div>
@endif

