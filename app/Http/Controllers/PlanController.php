<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Plan::all();
    }
    
    public function store(Request $request)
    {
        $plan = Plan::create($request->all());
        return response()->json(['message' => 'Plan creado', 'plan' => $plan]);
    }
    
    public function show($id)
    {
        return Plan::findOrFail($id);
    }
    
    public function update(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $plan->update($request->all());
        return response()->json(['message' => 'Plan actualizado', 'plan' => $plan]);
 
    }

    
    public function destroy($id)
    {
        Plan::destroy($id);
        return response()->json(['message' => 'Plan eliminado']);
    }
    
}
