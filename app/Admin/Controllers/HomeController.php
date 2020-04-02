<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Form\Tab;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index(Request $request, Content $content)
    {
        $class_order = Category::query()->with(['orders' => function($query) use ($request) {
            $query->withOrder($request->date);
        }])->get();
        $source_orders = Order::query()->withOrder($request->date)->get()->groupBy('from');
        return $content
            ->title('首页')
            ->view('admin.home.index', [
                'orders' => $class_order,
                'source_orders' => $source_orders
            ]);
    }

    public function orderStatistics(Request $request)
    {
        $orders = Order::withOrder($request->input('date', 'today'))
            ->selectRaw("cid,count(*) as total_order,count('date_pay') as total_pay_order,sum('pay_price') as total_price")
            ->groupBy('cid')
            ->paginate();
        return response()->json($orders);
    }
}
