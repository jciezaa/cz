@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Pagos</h1>
    <a href="{{ route('pagos.create') }}" class="btn btn-primary mb-3">Registrar Pago</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Monto</th>
                <th>Método</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pagos as $pago)
                <tr>
                    <td>{{ $pago->id }}</td>
                    <td>{{ $pago->usuario->nombre }}</td>
                    <td>{{ $pago->monto }}</td>
                    <td>{{ $pago->metodo_pago }}</td>
                    <td>{{ $pago->fecha }}</td>
                    <td>{{ $pago->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
