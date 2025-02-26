<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard CZ Building</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js para gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Font Awesome para íconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            padding-top: 56px;
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            padding-top: 20px;
            background-color: #1A1A1A; /* Azabache */
            color: white;
            transition: width 0.3s;
        }
        .sidebar.collapsed {
            width: 60px;
        }
        .sidebar.collapsed .sidebar-text {
            display: none;
        }
        .sidebar a {
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .sidebar a:hover {
            background-color: #2E2E2E; /* Azabache más claro al hacer hover */
        }
        .sidebar .fas {
            margin-right: 10px;
            color: #FFA500; /* Ámbar para íconos */
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }
        .main-content.collapsed {
            margin-left: 60px;
        }
        .card {
            margin-bottom: 20px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        .card-header {
            background-color: #1A1A1A; /* Azabache */
            color: #FFA500; /* Texto ámbar */
            border-bottom: none;
            padding: 15px;
            border-radius: 10px 10px 0 0;
        }
        .card-body {
            padding: 20px;
        }
        .table {
            margin-top: 20px;
        }
        .table thead {
            background-color: #1A1A1A; /* Azabache */
            color: #FFA500; /* Texto ámbar */
        }
        .btn-toggle {
            background-color: #2E2E2E; /* Azabache más claro */
            border: none;
            color: #FFA500; /* Ámbar */
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-toggle:hover {
            background-color: #3E3E3E; /* Azabache más claro al hacer hover */
        }
        .navbar {
            background-color: #1A1A1A; /* Azabache */
        }
        .navbar-brand {
            color: #FFA500 !important; /* Texto ámbar */
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            margin-right: 10px;
            height: 30px;
        }
        .navbar-nav .nav-link {
            color: #FFA500 !important; /* Texto ámbar */
        }
        .navbar-nav .nav-link:hover {
            color: #FFD700 !important; /* Ámbar más claro al hacer hover */
        }
    </style>
</head>
<body>

    <!-- Barra de navegación superior -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://via.placeholder.com/150x50?text=CZ+Building" alt="CZ Building Logo"> <!-- Logotipo -->
                CZ Building
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user"></i> Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Barra lateral -->
    <div class="sidebar" id="sidebar">
        <a href="#"><i class="fas fa-home"></i><span class="sidebar-text">Inicio</span></a>
        <a href="#"><i class="fas fa-chart-line"></i><span class="sidebar-text">Reportes</span></a>
        <a href="#"><i class="fas fa-cog"></i><span class="sidebar-text">Configuración</span></a>
        <a href="#"><i class="fas fa-question-circle"></i><span class="sidebar-text">Ayuda</span></a>
        <button class="btn-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
    </div>

    <!-- Contenido principal -->
    <div class="main-content" id="mainContent">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Ventas Totales</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Usuarios Activos</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="usersChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Ingresos Mensuales</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de datos -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Últimas Transacciones</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2023-10-01</td>
                            <td>$100</td>
                            <td><span class="badge bg-success">Completado</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>2023-10-02</td>
                            <td>$200</td>
                            <td><span class="badge bg-warning">Pendiente</span></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>2023-10-03</td>
                            <td>$150</td>
                            <td><span class="badge bg-danger">Cancelado</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Script para gráficos -->
    <script>
        // Gráfico de ventas
        const salesChart = new Chart(document.getElementById('salesChart'), {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
                datasets: [{
                    label: 'Ventas',
                    data: [65, 59, 80, 81, 56, 55],
                    borderColor: '#FFA500', /* Ámbar */
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });

        // Gráfico de usuarios activos
        const usersChart = new Chart(document.getElementById('usersChart'), {
            type: 'bar',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
                datasets: [{
                    label: 'Usuarios',
                    data: [50, 60, 70, 80, 90, 100],
                    backgroundColor: '#FFA500', /* Ámbar */
                    borderColor: '#FFA500', /* Ámbar */
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });

        // Gráfico de ingresos mensuales
        const revenueChart = new Chart(document.getElementById('revenueChart'), {
            type: 'doughnut',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
                datasets: [{
                    label: 'Ingresos',
                    data: [300, 400, 500, 600, 700, 800],
                    backgroundColor: [
                        '#FFA500', /* Ámbar */
                        '#1A1A1A', /* Azabache */
                        '#FFD700', /* Ámbar claro */
                        '#2E2E2E', /* Azabache más claro */
                        '#FF8C00', /* Ámbar oscuro */
                        '#3E3E3E' /* Azabache más claro */
                    ],
                    borderColor: '#1A1A1A', /* Azabache */
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });

        // Función para colapsar/expandir la barra lateral
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('collapsed');
        }
    </script>
</body>
</html>