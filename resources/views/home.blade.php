@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="app">
        <div class="container px-5 mx-auto">

            <main class="flex">
                <aside class="w-1/5">
                    <ul>
                        <li>
                            <router-link to="/home/account">Cuenta</router-link>
                        </li>
                        <li>
                            <router-link to="/home/buy-assets">Comprar</router-link>
                        </li>
                        <li>
                            <router-link to="/home/sell-assets">Vender</router-link>
                        </li>
                        <li>
                            <router-link to="/home/graphics">Gráficas</router-link>
                        </li>
                        <li>
                            <router-link to="/home/porfolio-value">Valor cuenta</router-link>
                        </li>
                    </ul>
                </aside>
                <div class="flex-1">
                    <router-view></router-view>
                </div>

            </main>

        </div>
    </div>

</div>
@endsection