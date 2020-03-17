<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidRequestException;
use App\Handlers\FileUploadHandler;
use App\Handlers\FileWordsHandle;
use App\Handlers\OrderApiHandler;
use App\Handlers\WordHandler;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Jobs\CheckOrderStatus;
use App\Models\Category;
use App\Models\Order;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpWord\IOFactory;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class OrdersController extends Controller
{
    //提交订单
    public function store(OrderRequest $request, OrderApiHandler $api, FileUploadHandler $uploader, FileWordsHandle $fileWords, WordHandler $wordHandler)
    {

        $user = $request->user();

        $category = Category::find($request->cid);
        if($category->status == 0) {
            return response()->json([
                'message' => '此检测通道已关闭!'
            ], 401);
        }
        $order = \DB::transaction(function() use ($user, $category, $uploader, $request, $fileWords, $wordHandler) {
//            dd($request->file->getClientOriginalExtension());
            if($file = $request->file) {
                if(!in_array($file->getClientOriginalExtension(), ['doc', 'docx'])) {
                    //读取文件内容
                    $content = remove_spec_char(convert2utf8(file_get_contents($file)));
                    $result = $wordHandler->save($content, 'files', $user->id);
                    $words = count_words(remove_spec_char(convert2utf8($content)));
                } else {
                    $result = $uploader->save($file, 'files', $user->id);//存本地
                    $words_count = $fileWords->getWords($request->title, $request->writer, $result['path']);
                    $words = $words_count['data']['wordCount'];
                }
            } else {
                $content = remove_spec_char($request->input('content', ''));
                $result = $wordHandler->save($content, 'files', $user->id);
                dd($result);
                $words = count_words($content);
            }

            if(!$words >= $category->min_word && $words <= $category->max_word) {
                throw new InvalidRequestException("检测字数必须在" . $category->min_word . "与" . $category->max_word . "之间");
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
                'content' => '',
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
