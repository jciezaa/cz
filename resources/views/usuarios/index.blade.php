@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Usuarios</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Método de Pago</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="userTable"></tbody>
    </table>
</div>

<script>
    async function loadUsers() {
        const response = await fetch('/api/usuarios');
        const users = await response.json();
        const table = document.getElementById('userTable');
        table.innerHTML = users.map(user => `
            <tr>
                <td>${user.nombre}</td>
                <td>${user.email}</td>
                <td>${user.metodo_pago}</td>
                <td>
                    <button class="btn btn-warning">Editar</button>
                    <button class="btn btn-danger">Eliminar</button>
                </td>
            </tr>
        `).join('');
    }
    loadUsers();
</script>
@endsection
