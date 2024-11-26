
@extends('layout')

@section('title') User Dashboard @endsection
 
@section ('content')
<h3>Notification Details</h3>

<p>Order Number: {{ $notification['data']['order']['number'] }}</p>
<p>Created By : {{ $notification['data']['from']['full_name'] }}</p>
<p>Created By : {{ $notification['data']['from']['city'] }}</p>
<a href="{{ route('orders.show', $notification['data']['order']['id']) }}">View Order</a>
@endsection