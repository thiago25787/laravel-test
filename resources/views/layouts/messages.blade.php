@if($errors->any())
    <div class="alert alert-danger text-center">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success text-center">
        {{ Session::get('success') }}
    </div>
@endif

@if(Session::has('danger'))
    <div class="alert alert-danger text-center">
        {{ Session::get('danger') }}
    </div>
@endif

@if(Session::has('warning'))
    <div class="alert alert-warning text-center">
        {{ Session::get('warning') }}
    </div>
@endif

@if(Session::has('info'))
    <div class="alert alert-info text-center">
        {{ Session::get('info') }}
    </div>
@endif
