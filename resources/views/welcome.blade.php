@extends('layouts.app')

@section('content')

<div class="container mt-36">
    <img src=" {{ asset('images/finance.jpg') }}" alt="">
</div>
@endsection('content')

@section('footer')
<div id="app" class="flex mx-auto">

    <my-footer></my-footer>
</div>
@endsection('footer')