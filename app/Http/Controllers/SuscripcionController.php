<?php

namespace App\Http\Controllers;

use App\Models\Suscripcion;
use Illuminate\Http\Request;

class SuscripcionController extends Controller
{
    public function index()
    {
        return Suscripcion::with(['usuario', 'plan'])->get();
    }
    
    public function store(Request $request)
    {
        $suscripcion = Suscripcion::create($request->all());
        return response()->json(['message' => 'Suscripción creada', 'suscripcion' => $suscripcion]);
    }
    
    public function show($id)
    {
        return Suscripcion::with(['usuario', 'plan'])->findOrFail($id);
    }
    
    public function update(Request $request, $id)
    {
        $suscripcion = Suscripcion::findOrFail($id);
        $suscripcion->update($request->all());
        return response()->json(['message' => 'Suscripción actualizada', 'suscripcion' => $suscripcion]);
    }
    
    public function destroy($id)
    {
        Suscripcion::destroy($id);
        return response()->json(['message' => 'Suscripción eliminada']);
    }
    
}
