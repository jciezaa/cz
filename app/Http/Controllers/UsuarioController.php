<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    return Usuario::all();
}

public function store(Request $request)
{
    $usuario = Usuario::create($request->all());
    return response()->json(['message' => 'Usuario creado', 'usuario' => $usuario]);
}

public function show($id)
{
    return Usuario::findOrFail($id);
}

public function update(Request $request, $id)
{
    $usuario = Usuario::findOrFail($id);
    $usuario->update($request->all());
    return response()->json(['message' => 'Usuario actualizado', 'usuario' => $usuario]);
}


public function destroy($id)
{
    Usuario::destroy($id);
    return response()->json(['message' => 'Usuario eliminado']);
}

}
