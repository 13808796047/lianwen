<?php

namespace App\Admin\Controllers;


use App\Admin\Actions\BatchQueue;
use App\Admin\Actions\Grid\ResetOrderStatus;
use App\Admin\Actions\Grid\UploadOrderFile;
use App\Jobs\getOrderStatus;
use App\Jobs\UploadCheckFile;
use App\Models\Order;
use App\Models\User;
use Dcat\Admin\Color;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use Illuminate\Http\Request;

class OrderController extends AdminController
{
    protected function grid()
    {
        // 第二个参数为 `Column` 对象， 第三个参数是自定义参数

        return Grid::make(Order::with(['category']), function(Grid $grid) {
            $grid->id->sortable();
            $grid->paginate(10);
            $grid->export()->disableExportAll();
            $grid->quickSearch('title', 'orderid', 'api_orderid', 'userid');
            $grid->selector(function(Grid\Tools\Selector $selector) {
                $selector->select('status', '状态', [
                    0 => '未支付',
                    1 => '待检测',
                    2 => '排队中',
                    3 => '检测中',
                    4 => '检测完成'
                ]);
                $selector->select('pay_price', '支付价格', ['0-99', '100-199', '200-299'], function($query, $value) {
                    $between = [
                        [0, 99],
                        [100, 199],
                        [200, 299],
                    ];

                    $value = current($value);

                    $query->whereBetween('pay_price', $between[$value]);
                });
            });

            $grid->model()->orderBy('created_at', 'desc');
            $grid->column('orderid', '订单号')->display(function($orderid) {
                $order = Order::query()->where('orderid', $orderid)->first();
                return "<a href='orders/{$order->id}/download_report'>$orderid</a>";

            });
            $grid->column('category.name', '系统');
            // 展示关联关系的字段时，使用 column 方法
            $grid->column('userid', '买家')->display(function($userid) {
                return User::find($userid)->phone ?? '';
            });
            $grid->column('status', '状态')->using([
                0 => '未支付',
                1 => '待检测',
                2 => '排队中',
                3 => '检测中',
                4 => '检测完成'
            ])->dot([
                0 => 'danger',
                1 => 'info',
                2 => 'primary',
                3 => 'warning',
                4 => 'success',
            ]);
            $grid->column('title', '标题')->copyable()->width('200px');
//            $grid->model()->sum("pay_price");
            $grid->column('writer', '作者')->width('100px');
            $grid->column('words', '字数')->width('50px');
            $grid->column('pay_price', '支付金额')->width('100px');
//            $grid->column('pay_price', '支付金额')->totalRow(function($amount) {
//
//                return "<span class='text-danger text-bold'><i class='fa fa-yen'></i> {$amount} 元</span>";
//
//            });
            $grid->column('pay_type', '支付方式')->width('80px');
            $grid->column('from', '来源');
            $grid->column('created_at', '创建时间')->sortable();

            $grid->actions(function(Grid\Displayers\Actions $actions) {
                $actions->disableDelete();
                $actions->disableView();
            });
            $grid->batchActions(function($batch) {
                $batch->add(new BatchQueue('批量启动队列'));
            });
            // 禁用
            $grid->disableCreateButton();
//            $grid->actions(new ResetOrderStatus());
//            $grid->actions(new UploadOrderFile());
            $grid->filter(function(Grid\Filter $filter) {
                // 去掉默认的id过滤器
                $filter->disableIdFilter();
                // 在这里添加字段过滤器
                $filter->like('title', '标题');
                $filter->like('writer', '作者');
                $filter->like('orderid', '订单号');
                $filter->like('api_orderid', 'api订单ID');
                $filter->like('from', '来源');
                $filter->like('user.phone', '手机号');
                $filter->like('category.name', '检测系统');
                $filter->scope('1', '已支付')->where('status', 1);
                $filter->scope('3', '检测中')->where('status', 3);
                $filter->scope('4', '检测完成')->where('status', 4);
                $filter->scope('0', '未支付')->where('status', 0);
            });
        });
    }

    public function edit($id, Content $content)
    {
        return $content->header('编辑订单')->body(view('admin.orders.edit', ['order' => Order::find($id)]));
    }

    public function receved($id, Request $request)
    {
        $order = Order::findOrFail($id);
        $data = $request->all();
        $report_path = '';
        if($request->hasFile('file')) {
            $file = $request->file('file');
            if(!$file->isValid()) {
                abort(400, '无效的上传文件');
            }
            $path = 'downloads/report-' . $order->api_orderid . '.zip';
            \Storage::delete($path);
            $result = \Storage::putFileAs('downloads', $file, 'report-' . $order->api_orderid . '.zip');
            if($result) {
                $report_path = $path;
            }
        }
        $order->update([
            'status' => $data['status'],
            'rate' => $data['rate'],
            'report_path' => $report_path
        ]);
        if($order->status == 3) {
            dispatch(new getOrderStatus($order));
        } elseif($order->status == 1) {
            dispatch(new UploadCheckFile($order));
        }
        return response([
            'status' => 200,
            'data' => $order,
            'message' => '修改成功!',
            'redirect' => '/admin/orders'
        ]);
    }

    public function downloadPaper(Order $order)
    {
        return response()->download($order->paper_path);
    }

    public function downloadReport(Order $order)
    {
//        return \Storage::download(storage_path() . '/app/' . $order->report_path);
        return response()->download(storage_path() . '/app/' . $order->report_path, $order->writer . '-' . $order->title . '.zip');
    }
}
