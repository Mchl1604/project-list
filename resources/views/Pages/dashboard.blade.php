@extends('layouts.userApp')

@section('title', 'Projects')

@section('content')
    <div class="dashboard-header mt-3 text-center">
        <h1 class="dashboard-title green-font "></i>Welcome Back </h1>
        <p class="dashboard-subtitle text-white">Here's a quick overview of your system</p>
       
    </div>
  <h2 class="green-font mt-5">Project Overview</h2>
   <div class="row">
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="card-title">Total Projects: {{ $pendingCount + $ongoingCount + $completedCount }} </h5>
          
                    <div class="status-chart-wrap chart-card-body">
                        <canvas id="statusChart"></canvas>
                    </div>
                    
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="card-title">Completed Projects</h5>
          <div class="chart-card-body status-chart-wrap">
            <canvas id="completedProjectsChart"></canvas>
          </div>
        </div>
      </div>
    </div>
   </div>

   <h2 class="green-font mt-3">System Overview</h2>
    <div class="card mb-4">
      <div class="card-body">
                <h5 class="card-title">Total Projects and Total Users</h5>
                <div class="system-chart-wrap">
                    <canvas id="systemStatsChart"></canvas>
                </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    const ctx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'In Progress', 'Completed'],
            datasets: [{
                label: 'Project Status',
                data: [{{ $pendingCount }}, {{ $ongoingCount }}, {{ $completedCount }}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(75, 192, 192, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            radius: '95%',
            plugins: {
                legend: {
                    position: 'right',
                    fullSize: false,
                    labels: {
                        boxWidth: 10,
                        boxHeight: 10,
                        padding: 10,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: {
                            size: 11
                        },
                        color: '#ffffff'
                    }
                },
                title: {
                    display: false,
                    text: 'Project Status Distribution',
                    color: '#ffffff'
                },
                tooltip: {
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff'
                }
            }
        },
    });

    const completedCtx = document.getElementById('completedProjectsChart').getContext('2d');
    const completedProjectsChart = new Chart(completedCtx, {
        type: 'bar',
        data: {
            labels: @json($completionMonth->pluck('month')),
            datasets: [{
                label: 'Completed Projects',
                data: @json($completionMonth->pluck('count')),
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.18)',
                borderWidth: 2,
                tension: 0.1,
                fill: true,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: '#ffffff'
                    }
                },
                title: {
                    display: false,
                    text: 'Completed Projects by Month',
                    color: '#ffffff'
                },
                tooltip: {
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff'
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: '#ffffff'
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        color: '#ffffff'
                    }
                }
            }
        }
    });

      const systemStatsCtx = document.getElementById('systemStatsChart').getContext('2d');
    const systemStatsChart = new Chart(systemStatsCtx, {
        type: 'bar',
        data: {
            labels: ['Projects', 'Users'],
            datasets: [{
                data: [{{ $totalProjects }}, {{ $totalUsers }}],
                backgroundColor: [
                    'rgba(25, 135, 84, 0.85)',
                    'rgba(102, 51, 153, 0.85)'
                ],
                borderColor: [
                    'rgba(25, 135, 84, 1)',
                    'rgba(102, 51, 153, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            resizeDelay: 200,
            plugins: {
                legend: { display: false },
                title: {
                    display: false,
                    color: '#ffffff'
                },
                tooltip: {
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff'
                }
            },
            scales: {
                x: {
                    ticks: { color: '#ffffff' },
                    grid: { display: false }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        color: '#ffffff'
                    }
                }
            }
        }
    });
</script>
@endsection
