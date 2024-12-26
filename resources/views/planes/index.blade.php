@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Planes</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Periodicidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="planTable"></tbody>
    </table>
</div>

<script>
    async function loadPlanes() {
        const response = await fetch('/api/planes');
        const planes = await response.json();
        const table = document.getElementById('planTable');
        table.innerHTML = planes.map(plan => `
            <tr>
                <td>${plan.nombre}</td>
                <td>${plan.precio}</td>
                <td>${plan.periodicidad}</td>
                <td>
                    <button class="btn btn-warning">Editar</button>
                    <button class="btn btn-danger">Eliminar</button>
                </td>
            </tr>
        `).join('');
    }
    loadPlanes();
</script>
@endsection
