@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <a href="{{ url('empleado/create') }}" class="btn btn-success">Registrar nuevo empleado</a>
        <br>
        <br>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->id }}</td>

                        <td>
                            <img src="{{ asset('storage') . '/' . $empleado->imagen }}" alt="" width="100"
                                class="img-thumbnail img-fluid">

                        </td>

                        <td>{{ $empleado->nombre }}</td>
                        <td>{{ $empleado->apellido }}</td>
                        <td>{{ $empleado->correo }}</td>
                        <td>
                            <a href="{{ url('/empleado/' . $empleado->id . '/edit') }}"" class="btn btn-warning"> Editar
                            </a>
                            |
                            <form action="{{ url('/empleado/' . $empleado->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Borrar" onclick="return confirm('¿Quieres Borrar?')"
                                    class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        {!! $empleados->links() !!}
    </div>
@endsection
