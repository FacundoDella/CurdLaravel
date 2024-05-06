@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ url('/empleado/' . $empleado->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            @include('empleado.form', ['modo' => 'Editar', 'imagen'=>''])
        </form>
    </div>
@endsection
