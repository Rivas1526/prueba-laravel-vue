@extends('layouts.app')

@section('content')
    {{-- Vista de bienvenida  --}}
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a class="text-white" href="{{ url('/home') }}">Home</a>
                @else
                    <a class="text-white" href="#" data-toggle="modal" data-target="#login">Login</a>

                    @if (Route::has('register'))
                        <a class="text-white" href="#" data-toggle="modal" data-target="#registro">Registro</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h4 class="text-dark">Corrige antes de continuar</h4>
                    <ul>
                        @foreach ($errors->all() as $error )
                            <li class="text-dark">{{ $error }}</li>
                        @endforeach
                    </ul>           
                </div>
            @endif
            <div class="title m-b-md">
                Prueba | Laravel - Vue
            </div>            
        </div>
    </div>

    <!-- Modales -->
    @include('auth.login')
    @include('auth.register')
  
@endsection