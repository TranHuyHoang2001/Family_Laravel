@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible" id="notification">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p><i class="icon fa fa-check"></i> Success!</p>
        {{session('success')}}
    </div>
@endif
@if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible" id="notification-error">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p><i class="icon fa fa-ban"></i> Error!</p>
        {{session('error')}}
    </div>
@endif
