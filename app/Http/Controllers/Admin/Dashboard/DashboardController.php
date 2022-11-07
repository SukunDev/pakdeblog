<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Carbon\Carbon;
use App\Models\Posts;
use App\Models\PostView;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $pageViewMonth = PostView::whereMonth('created_at', now()->month)
            ->orderBy('created_at', 'desc')
            ->get();
        $pageViewWeek = PostView::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ])->get();
        $dataChart = AppHelper::instance()->makeChartData($pageViewMonth);
        $popularPost = Posts::whereNotNull('published_at')
            ->latest('view_count')
            ->limit(5)
            ->get();
        return view('admin.index', [
            'title' => $title,
            'page_view_month' => $pageViewMonth,
            'page_view_week' => $pageViewWeek,
            'data_chart' => json_encode($dataChart),
            'jumlah_article' => Posts::whereNotNull('published_at')->count(),
            'popular_post' => $popularPost,
        ]);
    }
}
