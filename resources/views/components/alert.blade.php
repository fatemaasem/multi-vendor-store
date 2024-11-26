@props(['type','alert'
    ])
 @if(Session::has($alert))
    <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
        {{ Session::get($alert) }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif
