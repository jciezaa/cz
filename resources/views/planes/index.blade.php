@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Planes</h1>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
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

<!-- Modal de edición -->
<div class="modal fade" id="editPlanModal" tabindex="-1" aria-labelledby="editPlanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPlanLabel">Editar Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPlanForm">
                    <div class="mb-3">
                        <label for="planName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="planName" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="planPrice" class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="planPrice" name="precio" required>
                    </div>
                    <div class="mb-3">
                        <label for="planPeriod" class="form-label">Periodicidad</label>
                        <input type="text" class="form-control" id="planPeriod" name="periodicidad" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let currentPlanId = null;

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
                    <button class="btn btn-warning" onclick="editPlan(${plan.id}, '${plan.nombre}', ${plan.precio}, '${plan.periodicidad}')">Editar</button>
                    <button class="btn btn-danger" onclick="deletePlan(${plan.id})">Eliminar</button>
                </td>
            </tr>
        `).join('');
    }

    function editPlan(id, nombre, precio, periodicidad) {
        currentPlanId = id;
        document.getElementById('planName').value = nombre;
        document.getElementById('planPrice').value = precio;
        document.getElementById('planPeriod').value = periodicidad;
        new bootstrap.Modal(document.getElementById('editPlanModal')).show();
    }

    document.getElementById('editPlanForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const payload = Object.fromEntries(formData.entries());
        const response = await fetch(`/api/planes/${currentPlanId}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload),
        });
        if (response.ok) {
            alert('Plan actualizado');
            loadPlanes();
            bootstrap.Modal.getInstance(document.getElementById('editPlanModal')).hide();
        }
    });

    async function deletePlan(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este plan?')) {
            const response = await fetch(`/api/planes/${id}`, { method: 'DELETE' });
            if (response.ok) {
                alert('Plan eliminado');
                loadPlanes();
            }
        }
    }

    loadPlanes();
</script>
@endsection
