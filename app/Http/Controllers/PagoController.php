<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::with('usuario')->get();
        return view('pagos.index', compact('pagos'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        return view('pagos.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'monto' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string',
            'fecha' => 'required|date',
        ]);
    
        // Excluyendo `_token` del array de datos
        $data = $request->except('_token');
    
        Pago::create($data);
    
        return redirect()->route('pagos.index')->with('success', 'Pago registrado correctamente');
    }
    
}
