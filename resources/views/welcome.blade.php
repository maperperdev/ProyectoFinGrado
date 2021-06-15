@extends('layouts.app')

@section('content')

<div class="container">
    <img src=" {{ asset('images/finance.jpg') }}" alt="" style="max-height: 100%;">
</div>
@endsection('content')

@section('footer')
<div id="app" class="flex mx-auto">

    <my-footer></my-footer>
</div>
@endsection('footer')