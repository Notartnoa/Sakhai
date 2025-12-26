<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Existing data
        $my_products = Product::where('creator_id', $userId)->get();
        $my_revenue = ProductOrder::where('creator_id', $userId)->where('is_paid', 1)->sum('total_price');
        $total_order_success = ProductOrder::where('creator_id', $userId)->where('is_paid', 1)->get();
        $total_order_pending = ProductOrder::where('creator_id', $userId)->where('is_paid', 0)->get();

        // Earning history data (last 30 days)
        $earningHistory = $this->getEarningHistory($userId, 30);

        // Earning history data (last 12 months)
        $monthlyEarningHistory = $this->getMonthlyEarningHistory($userId, 12);

        return view('admin.dashboard', [
            'my_products' => $my_products,
            'my_revenue' => $my_revenue,
            'total_order_success' => $total_order_success,
            'total_order_pending' => $total_order_pending,
            'earningHistory' => $earningHistory,
            'monthlyEarningHistory' => $monthlyEarningHistory,
        ]);
    }

    /**
     * Get daily earning history for the last N days
     * Uses paid_at if available, otherwise falls back to created_at
     */
    private function getEarningHistory(int $userId, int $days): array
    {
        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        // Get earnings grouped by date
        // COALESCE: gunakan paid_at, jika null gunakan created_at
        $earnings = ProductOrder::where('creator_id', $userId)
            ->where('is_paid', 1)
            ->whereRaw('COALESCE(paid_at, created_at) BETWEEN ? AND ?', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(COALESCE(paid_at, created_at)) as date'),
                DB::raw('SUM(total_price) as total'),
                DB::raw('COUNT(*) as orders')
            )
            ->groupBy(DB::raw('DATE(COALESCE(paid_at, created_at))'))
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        // Fill in missing dates with zero values
        $result = [
            'labels' => [],
            'data' => [],
            'orders' => [],
        ];

        for ($i = 0; $i < $days; $i++) {
            $date = Carbon::now()->subDays($days - 1 - $i);
            $dateString = $date->format('Y-m-d');
            $displayDate = $date->format('d M');

            $result['labels'][] = $displayDate;
            $result['data'][] = isset($earnings[$dateString]) ? (int) $earnings[$dateString]->total : 0;
            $result['orders'][] = isset($earnings[$dateString]) ? (int) $earnings[$dateString]->orders : 0;
        }

        return $result;
    }

    /**
     * Get monthly earning history for the last N months
     * Uses paid_at if available, otherwise falls back to created_at
     */
    private function getMonthlyEarningHistory(int $userId, int $months): array
    {
        $startDate = Carbon::now()->subMonths($months - 1)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        // Get earnings grouped by month
        // COALESCE: gunakan paid_at, jika null gunakan created_at
        $earnings = ProductOrder::where('creator_id', $userId)
            ->where('is_paid', 1)
            ->whereRaw('COALESCE(paid_at, created_at) BETWEEN ? AND ?', [$startDate, $endDate])
            ->select(
                DB::raw('YEAR(COALESCE(paid_at, created_at)) as year'),
                DB::raw('MONTH(COALESCE(paid_at, created_at)) as month'),
                DB::raw('SUM(total_price) as total'),
                DB::raw('COUNT(*) as orders')
            )
            ->groupBy(DB::raw('YEAR(COALESCE(paid_at, created_at))'), DB::raw('MONTH(COALESCE(paid_at, created_at))'))
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Create a lookup key
        $earningsLookup = [];
        foreach ($earnings as $earning) {
            $key = $earning->year . '-' . str_pad($earning->month, 2, '0', STR_PAD_LEFT);
            $earningsLookup[$key] = $earning;
        }

        // Fill in missing months with zero values
        $result = [
            'labels' => [],
            'data' => [],
            'orders' => [],
        ];

        for ($i = 0; $i < $months; $i++) {
            $date = Carbon::now()->subMonths($months - 1 - $i);
            $key = $date->format('Y-m');
            $displayMonth = $date->format('M Y');

            $result['labels'][] = $displayMonth;
            $result['data'][] = isset($earningsLookup[$key]) ? (int) $earningsLookup[$key]->total : 0;
            $result['orders'][] = isset($earningsLookup[$key]) ? (int) $earningsLookup[$key]->orders : 0;
        }

        return $result;
    }
}
