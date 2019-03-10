@extends('welcome')

@section('content')
    <div class="container">
        <h2 class="well">Welcome {{ $customer->customer_name }}!</h2>
        <h4 >Your Balance is: <strong>{{ $customer->customer_balance }}</strong></h4>
    </div>
    @endsection