<?php

namespace App\Http\Controllers\Api;

use App\Handlers\FileUploadHandler;
use App\Handlers\FileWordsHandle;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Category;
use App\Models\Order;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

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
                        $content = remove_spec_char(convert2utf8($content));
                        $words = count_words(remove_spec_char(convert2utf8($content)));
                    } else {
                        $words_count = $fileWords->getWords($request->title, $request->writer, $result['path']);
                        $words = $words_count['data']['wordCount'];
                        $content = read_doc_from_antiword($result['path']);
                    }

                } else {
                    throw new InternalErrorException('文件类型错误');
                }
                //计算价格
            } else {
                $content = remove_spec_char($request->input('content'));
                $words = count_words($content);
            }
            if(!$words >= $category->min_word && $words <= $category->max_word) {
                throw new InvalidArgumentException("检测字数必须在" . $category->min_word . "与" . $category->max_word . "之间");
            }
            switch ($category->price_type) {
                case 1:
                    $price = round($category->price * ceil($words * 1.05 / 1000), 2);
                    break;
                case 2:
                    $price = round($category->price * ceil($words * 1.05 / 10000), 2);
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
                'from' => config('app.url')
            ]);
            $order->user()->associate($user);
            $order->save();
            return $order;
        });
        return new OrderResource($order);
    }
}
