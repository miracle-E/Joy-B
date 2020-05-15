@extends('layouts.default')

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<title>Contact us</title>





<!-- End Content -->
@endsection