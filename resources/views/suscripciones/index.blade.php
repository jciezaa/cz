@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Suscripciones</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Plan</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="suscripcionesTable"></tbody>
    </table>
</div>

<script>
    async function loadSuscripciones() {
        const response = await fetch('/api/suscripciones');
        const suscripciones = await response.json();
        const table = document.getElementById('suscripcionesTable');
        table.innerHTML = suscripciones.map(suscripcion => `
            <tr>
                <td>${suscripcion.usuario.nombre}</td>
                <td>${suscripcion.plan.nombre}</td>
                <td>${suscripcion.fecha_inicio}</td>
                <td>${suscripcion.fecha_fin || 'N/A'}</td>
                <td>${suscripcion.estado}</td>
                <td>
                    <button class="btn btn-warning">Editar</button>
                    <button class="btn btn-danger">Eliminar</button>
                </td>
            </tr>
        `).join('');
    }
    loadSuscripciones();
</script>
@endsection
