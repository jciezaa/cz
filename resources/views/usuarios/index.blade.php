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

<!-- Modal de edición -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    @csrf
                    @method('PUT') <!-- Este campo emula el método PUT -->
                    <div class="mb-3">
                        <label for="userName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="userName" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="userEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="userPayment" class="form-label">Método de Pago</label>
                        <input type="text" class="form-control" id="userPayment" name="metodo_pago" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let currentUserId = null;

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
                    <button class="btn btn-warning" onclick="editUser(${user.id}, '${user.nombre}', '${user.email}', '${user.metodo_pago}')">Editar</button>
                    <button class="btn btn-danger" onclick="deleteUser(${user.id})">Eliminar</button>
                </td>
            </tr>
        `).join('');
    }

    function editUser(id, nombre, email, metodo_pago) {
        currentUserId = id;
        document.getElementById('userName').value = nombre;
        document.getElementById('userEmail').value = email;
        document.getElementById('userPayment').value = metodo_pago;
        new bootstrap.Modal(document.getElementById('editUserModal')).show();
    }

    document.getElementById('editUserForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const payload = Object.fromEntries(formData.entries());
        const response = await fetch(`/api/usuarios/${currentUserId}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload),
        });
        if (response.ok) {
            alert('Usuario actualizado');
            loadUsers();
            bootstrap.Modal.getInstance(document.getElementById('editUserModal')).hide();
        }
    });

    async function deleteUser(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
            const response = await fetch(`/api/usuarios/${id}`, { method: 'DELETE' });
            if (response.ok) {
                alert('Usuario eliminado');
                loadUsers();
            }
        }
    }

    loadUsers();
</script>
@endsection
