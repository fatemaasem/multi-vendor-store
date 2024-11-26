
@props([
    'type','name','value'=>'','required'=>''
    ])

<input type="{{$type}}" name="{{$name}}" class="form-control-file" id="{{$name}}" placeholder="Enter category {{$name}}" {{$required}} value="{{ old($name,$value )}}">
@error($name)
<div class="alert alert-danger mt-2" role="alert">
    {{ $message }}
</div>
@enderror