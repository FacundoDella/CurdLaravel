<h1>{{ $modo }} empleado</h1>

@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li> {{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif

<div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="{{ isset($empleado->nombre) ? $empleado->nombre : old('nombre') }}"
        id="nombre" class="form-control">
</div>
<div class="form-group"><label for="apellido">Apellido</label>
    <input type="text" name="apellido"
        value="{{ isset($empleado->apellido) ? $empleado->apellido : old('apellido') }}" id="apellido"
        class="form-control">

</div>
<div class="form-group"><label for="imagen">{{ $imagen }}</label>
    @if (isset($empleado->imagen))
        <img src="{{ asset('storage') . '/' . $empleado->imagen }}" alt="" id="imagen" width="100"
            class="img-thumbnail img-fluid">
    @endif
    <input type="file" name="imagen" value="" class="form-control">

</div>
<div class="form-group"><label for="correo">Correo</label>
    <input type="text" name="correo" value="{{ isset($empleado->correo) ? $empleado->correo : old('correo') }}"
        id="correo" class="form-control">
</div>
<br>
<input type="submit" value="{{ $modo }} datos" class="btn btn-success">
<a href="{{ url('/empleado') }}" class="btn btn-primary">Volver</a>
