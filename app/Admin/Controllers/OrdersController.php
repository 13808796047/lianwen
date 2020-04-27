<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Order\BatchQueue;
use App\Jobs\CheckOrderStatus;
use App\Jobs\CreateCheckOrder;
use App\Jobs\getOrderStatus;
use App\Jobs\StartCheck;
use App\Jobs\UploadCheckFile;
use App\Models\Category;
use App\Models\Enum\OrderEnum;
use App\Models\Order;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class OrdersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '订单';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());
        $grid->model()->orderBy('created_at', 'desc');
        $grid->filter(function($filter) {
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
        $grid->fixColumns(3);
        $grid->column('orderid', '订单号')->totalRow('合计');
        $grid->column('category.name', '分类');
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
        $grid->column('title', '标题');
        $grid->column('writer', '作者');
        $grid->column('words', '字数');
        $grid->column('pay_price', '支付金额')->totalRow(function($amount) {

            return "<span class='text-danger text-bold'><i class='fa fa-yen'></i> {$amount} 元</span>";

        });
        $grid->column('pay_type', '支付方式');
        $grid->column('from', '来源');
        $grid->column('created_at', '创建时间')->sortable();
        $grid->batchActions(function($batch) {
            $batch->add(new BatchQueue());
        });
        // 禁用创建按钮，后台不需要创建订单
        $grid->disableCreateButton();
        return $grid;
    }

//    protected function form()
//    {
//        $form = new Form(new Order());
//
//// 第一列占据1/2的页面宽度
//        $form->column(1 / 2, function($form) {
//            $form->select('status', '订单状态')->options([
//                0 => '待支付',
//                1 => '待检测',
//                2 => '排队中',
//                3 => '检测中',
//                4 => '检测完成',
//                5 => '暂停',
//                6 => '取消',
//                7 => '已退款',
//            ]);
//            $form->file('paper_path', '原文报告')->downloadable();
//            $form->text('title', '标题');
//            $form->text('writer', '作者');
//            $form->file('report_path', '检测报告')->downloadable();
//            $form->rate('rate', '重复率');
//        });
//        return $form;
//    }
    public function edit($id, Content $content)
    {
        return $content->header('编辑订单')
            ->body(view('admin.orders.edit', ['order' => Order::findOrFail($id)]));
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
        return $order;
    }

    public function downloadPaper(Order $order)
    {
        return response()->download($order->paper_path);
    }

    public function downloadReport(Order $order)
    {
//        return \Storage::download(storage_path() . '/app/' . $order->report_path);
        return response()->download(storage_path() . '/app/' . $order->report_path);
    }

    public function show($id, Content $content)
    {
        return $content->header('查看订单')
            ->description('详情')
            ->body(view('admin.orders.show', ['order' => Order::find($id)]));
    }


    public function repeatCheck(Request $request, Order $order, Content $content)
    {
        switch ($request->type) {
            case 'upload_file':
                dispatch(new UploadCheckFile($order));
                break;
            case 'create_order':
                dispatch(new CreateCheckOrder($order));
                break;
            case 'start_check':
                dispatch(new StartCheck($order));
                break;
            case 'get_order':
                dispatch(new getOrderStatus($order));
                break;
            default:
                dispatch(new CheckOrderStatus($order));
        }
        return redirect()->back();
    }
}
