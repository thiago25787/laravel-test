@if(Session::has('success'))
    <div class="alert alert-success text-center">
        {{ __(Session::get('success')) }}
    </div>
@endif

@if(Session::has('danger'))
    <div class="alert alert-danger text-center">
        {{ __(Session::get('danger')) }}
    </div>
@endif

@if(Session::has('warning'))
    <div class="alert alert-warning text-center">
        {{ __(Session::get('warning')) }}
    </div>
@endif

@if(Session::has('info'))
    <div class="alert alert-info text-center">
        {{ __(Session::get('info')) }}
    </div>
@endif
