<?php

namespace App\Http\Controllers\Api;

use App\Handlers\FileUploadHandler;
use App\Http\Requests\Api\OrderRequest;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //提交订单
    public function store(OrderRequest $request, FileUploadHandler $uploader)
    {
        $user = $request->user();

        if($request->type == 'file' && $file = $request->file) {
            //读取文件字数
            //计算价格
            //赋值
            $result = $uploader->save($file, 'docs', $user->id);
            if($result) {
                $data['paper_path'] = $result['path'];
                $content = file_get_contents($data['paper_path']);
            }
        } else {
            $content = $request->input('content');
        }
    }
}
