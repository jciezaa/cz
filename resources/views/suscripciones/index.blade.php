@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Suscripciones</h1>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Usuario</th>
                <th>Plan</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="subscriptionTable"></tbody>
    </table>
</div>

<!-- Modal de edición -->
<div class="modal fade" id="editSubscriptionModal" tabindex="-1" aria-labelledby="editSubscriptionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubscriptionLabel">Editar Suscripción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSubscriptionForm">
                    <div class="mb-3">
                        <label for="subscriptionStart" class="form-label">Fecha Inicio</label>
                        <input type="date" class="form-control" id="subscriptionStart" name="fecha_inicio" required>
                    </div>
                    <div class="mb-3">
                        <label for="subscriptionEnd" class="form-label">Fecha Fin</label>
                        <input type="date" class="form-control" id="subscriptionEnd" name="fecha_fin">
                    </div>
                    <div class="mb-3">
                        <label for="subscriptionStatus" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="subscriptionStatus" name="estado" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let currentSubscriptionId = null;

    async function loadSubscriptions() {
        const response = await fetch('/api/suscripciones');
        const subscriptions = await response.json();
        const table = document.getElementById('subscriptionTable');
        table.innerHTML = subscriptions.map(subscription => `
            <tr>
                <td>${subscription.usuario.nombre}</td>
                <td>${subscription.plan.nombre}</td>
                <td>${subscription.fecha_inicio}</td>
                <td>${subscription.fecha_fin || 'N/A'}</td>
                <td>${subscription.estado}</td>
                <td>
                    <button class="btn btn-warning" onclick="editSubscription(${subscription.id}, '${subscription.fecha_inicio}', '${subscription.fecha_fin}', '${subscription.estado}')">Editar</button>
                    <button class="btn btn-danger" onclick="deleteSubscription(${subscription.id})">Eliminar</button>
                </td>
            </tr>
        `).join('');
    }

    function editSubscription(id, fecha_inicio, fecha_fin, estado) {
        currentSubscriptionId = id;
        document.getElementById('subscriptionStart').value = fecha_inicio;
        document.getElementById('subscriptionEnd').value = fecha_fin || '';
        document.getElementById('subscriptionStatus').value = estado;
        new bootstrap.Modal(document.getElementById('editSubscriptionModal')).show();
    }

    document.getElementById('editSubscriptionForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const payload = Object.fromEntries(formData.entries());
        const response = await fetch(`/api/suscripciones/${currentSubscriptionId}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload),
        });
        if (response.ok) {
            alert('Suscripción actualizada');
            loadSubscriptions();
            bootstrap.Modal.getInstance(document.getElementById('editSubscriptionModal')).hide();
        }
    });

    async function deleteSubscription(id) {
        if (confirm('¿Estás seguro de que deseas eliminar esta suscripción?')) {
            const response = await fetch(`/api/suscripciones/${id}`, { method: 'DELETE' });
            if (response.ok) {
                alert('Suscripción eliminada');
           
