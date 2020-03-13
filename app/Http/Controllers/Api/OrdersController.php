<?php

namespace App\Http\Controllers\Api;

use App\Handlers\FileUploadHandler;
use App\Handlers\FileWordsHandle;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class OrdersController extends Controller
{
    //提交订单
    public function store(OrderRequest $request, FileUploadHandler $uploader, FileWordsHandle $fileWords)
    {

        $user = $request->user();

        $category = Category::find($request->cid);
        if($category->status == 0) {
            return response()->json([
                'message' => '此检测通道已关闭!'
            ]);
        }


        $order = \DB::transaction(function() use ($user, $category, $uploader, $request, $fileWords) {

            if($request->type == 'file' && $file = $request->file) {
                $result = $uploader->save($file, 'files', $user->id);
                if($result) {
                    if($result['ext'] == 'txt') {
                        //读取文件内容
                        $content = file_get_contents($result['path']);
                    } else {
                        $phpWord = \PhpOffice\PhpWord\IOFactory::load(public_path() . '/uploads/files/202003/13/1_1584106553_fBQMqLJQtb.docx');
                        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, "HTML");

                        dd($xmlWriter);
                        $result = $fileWords->getWords('111', '2222', $result['path']);
                        dd($result);
//                        dd(read_doc_from_antiword($result['path']));
//                        $content = read_docx($result['path']);
                    }
                    //统计字数
                    $content = remove_spec_char(convert2utf8($content));
                    $words = count_words(remove_spec_char(convert2utf8($content)));
                } else {
                    return [
                        'message' => '文件类型错误'
                    ];
                }
                //计算价格
            } else {
                $content = remove_spec_char($request->input('content'));
//                $data['content'] = $content;
                $words = count_words($content);
            }
            dd($content, $words);
            switch ($category->pricetype) {
                case 1:
                    $price = round($category->price * ceil($words / 1000), 2);
                    break;
                case 2:
                    $price = round($category->price * ceil($words / 10000), 2);
                    break;
                default:
                    $price = $category->price;
            }

            //创建订单
            $order = new Order([
                'cid' => $request->cid,
                'title' => $request->title,
                'writer' => $request->writer,
                'content' => $content,
                'date_publish' => $request->date_publish,
                'words' => $words,
                'price' => $price,
                'paper_path' => $result['path'],
                'from' => url()->current()
            ]);
            $order->user()->associate($user);
            dd($order);
            $order->save();
            return $order;
        });
        return new OrderResource($order);
    }
}
