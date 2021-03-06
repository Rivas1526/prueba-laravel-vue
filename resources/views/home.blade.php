@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-new">
                    <div class="card-header text-center vino">Gestionar tareas</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- Renderizar componente en la vista blade --}}
                        <task-component></task-component>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
