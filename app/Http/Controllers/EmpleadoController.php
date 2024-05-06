<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Nos sirve para eliminar imagen desde el storage

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos['empleados'] = Empleado::paginate(1);
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validacion de los campos
        $campos = [
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'correo' => 'required|email',
            'imagen' => 'required|max:10000|mimes:jpeg,png,jpg',
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            'foto.required' => 'La imagen es requerida'
        ];

        $this->validate($request, $campos, $mensaje);



        // $datosEmpleado = request()->all();
        $datosEmpleado = request()->except('_token');
        if ($request->hasFile('imagen')) { // Si hay una imagen el en envio del formulario
            $datosEmpleado['imagen'] = $request->file('imagen')->store('uploads', 'public'); // La inserto en la carpeta uploads (ya me genera un token unico)
        }
        Empleado::insert($datosEmpleado);
        return redirect('empleado')->with('mensaje', 'Empleado agregado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $empleado = Empleado::findOrFail($id);
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {


        // Validacion de los campos
        $campos = [
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'correo' => 'required|email',

        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
        ];

        // Valida que si es que hay una nueva imagen
        if ($request->hasFile('imagen')) {
            $campos = ['imagen' => 'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje = ['foto.required' => 'La imagen es requerida'];
        }

        $this->validate($request, $campos, $mensaje);


        $datosEmpleado = request()->except('_token', '_method');

        if ($request->hasFile('imagen')) { // Si hay una imagen el en envio del formulario
            $empleado = Empleado::findOrFail($id);
            Storage::delete('public/' . $empleado->imagen);
            $datosEmpleado['imagen'] = $request->file('imagen')->store('uploads', 'public'); // La inserto en la carpeta uploads (ya me genera un token unico)
        }

        Empleado::where('id', '=', $id)->update($datosEmpleado);

        $empleado = Empleado::findOrFail($id);
       //return view('empleado.edit', compact('empleado'));
       return redirect('empleado')->with('mensaje', 'Empleado Modificado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        if (Storage::delete('public/' . $empleado->imagen)) { // Borra fisicamente la imagen
            Empleado::destroy($id);
        }
        return redirect('empleado')->with('mensaje', 'Empleado Borrado');
    }
}
