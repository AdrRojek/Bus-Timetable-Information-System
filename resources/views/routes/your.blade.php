@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Routes</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th class="w-25 p-3">Dates</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($routes as $route)
                    @php
                        $futureDates = $route->routeDates->filter(function ($date) {
                            return $date->date->isToday() || $date->date->isFuture();
                        });
                    @endphp
                    @if ($futureDates->isNotEmpty())
                        <tr>
                            <td>{{ $route->name }}</td>
                            <td>{{ $route->description }}</td>
                            <td>
                                @foreach ($futureDates as $date)
                                    {{ $date->date->format('d-m-Y') }}<br>
                                @endforeach
                            </td>
                            
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="container">
        <h2>Statistics</h2>
        <p><strong>Number of routes in the current week:</strong> {{ $currentWeekRoutes }}</p>
        <p><strong>Total driving time in the current week:</strong> {{ $totalDurationHours }} hours {{ $totalDurationMinutes }} minutes</p>
    </div>

    <div class="container">
        <h2>Weekly Driving Hours Chart</h2>
        <canvas id="weeklyDrivingHoursChart" width="400" height="200"></canvas>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const weeklyHoursData = @json($weeklyHours); // Pass weeklyHours data to JavaScript
            const ctx = document.getElementById('weeklyDrivingHoursChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(weeklyHoursData),
                    datasets: [{
                        label: 'Total Driving Hours',
                        data: Object.values(weeklyHoursData),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                precision: 0
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
