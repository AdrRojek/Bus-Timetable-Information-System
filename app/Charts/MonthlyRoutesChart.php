<?php
namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\Route;
use Carbon\Carbon;

class MonthlyRoutesChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $this->type = 'bar';

        // Get the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Fetch data for the current month using the route_dates table
        $routeCounts = Route::selectRaw('DATE_FORMAT(route_dates.date, "%d %b") as label, COUNT(*) as count')
            ->join('route_dates', 'routes.id', '=', 'route_dates.route_id')
            ->whereMonth('route_dates.date', $currentMonth)
            ->whereYear('route_dates.date', $currentYear)
            ->groupBy('label')
            ->orderBy('route_dates.date') // Order by date for correct label sequence
            ->pluck('count', 'label');

        // Fill in missing days with 0
        $allDays = [];
        $startDate = Carbon::now()->startOfMonth();
        while ($startDate->month == $currentMonth) {
            $allDays[] = $startDate->format('d %b');
            $startDate->addDay();
        }
        $routeCounts = $routeCounts->union(array_fill_keys($allDays, 0)); // Combine with missing days

        // Prepare data for the chart
        $this->labels = $routeCounts->keys()->toArray(); // Convert keys to array
        $this->dataset('Number of Routes', 'bar', $routeCounts->values()->toArray()) // Convert values to array
            ->backgroundColor(['rgba(54, 162, 235, 0.5)']) // Array of colors
            ->color(['rgba(54, 162, 235, 1)']); // Array of colors
    }
}
