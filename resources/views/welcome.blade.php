@extends('layouts.app')

@section('content')

<div class="container">
    <img src=" {{ asset('images/finance.jpg') }}" alt="" style="max-height: 100%;">
</div>
@endsection('content')

@section('footer')
<div id="app" class="flex mx-auto">

    <my-footer>
        <template slot="salute-text">¡Pruebe nuestra aplicación!</template> 
    </my-footer>
</div>
@endsection('footer')