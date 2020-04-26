<?php


namespace App\Services;


use App\Exceptions\InvalidRequestException;
use App\Handlers\FileUploadHandler;
use App\Handlers\FileWordsHandle;
use App\Handlers\OrderApiHandler;
use App\Handlers\WordHandler;
use App\Jobs\OrderPendingMsg;
use App\Models\Category;
use App\Models\File;
use App\Models\Order;

class OrderService
{
    public function add($request)
    {
        $order = \DB::transaction(function() use ($request) {
            $category = Category::findOrFail($request->cid);
            $user = \Auth()->user();
            $fileWordsHandler = app(FileWordsHandle::class);
            $fileUploadHandle = app(FileUploadHandler::class);
            $wordHandler = app(WordHandler::class);
            if($request->type == 'file') {
                if($fileId = $request->file_id) {
                    $result = File::find($fileId);
                }
                if($result->type == 'docx') {
                    $content = read_docx($result->path);
                    $words_count = $fileWordsHandler->getWords($request->title, $request->writer, $result->path);
                    $words = $words_count['data']['wordCount'];
                    if($category->classid == 4) {
                        $result = $fileUploadHandle->saveTxt($content, 'files', $user->id);
                    }
                } else {
                    $content = remove_spec_char(convert2utf8(file_get_contents($result->path)));
                    $words = count_words(remove_spec_char(convert2utf8($content)));
                    if($category->classid == 3) {
                        $result = $wordHandler->save($content, 'files', $user->id);
                    }
                }
            } else {
                $content = remove_spec_char($request->input('content', ''));
                $words = count_words($content);
                if($category->classid == 4) {
                    $result = $fileUploadHandle->saveTxt($content, 'files', $user->id);
                }
                if($category->classid == 3) {
                    $result = $wordHandler->save($content, 'files', $user->id);
                }
            }
            if(!$words >= $category->min_words && !$words <= $category->max_words) {
                throw new InvalidRequestException("检测字数必须在" . $category->min_words . "与" . $category->max_words . "之间", 422);
            }
            switch ($category->price_type) {
                case Category::PRICE_TYPE_THOUSAND:
                    $price = round($category->price * ceil($words * $user->redix / 1000), 2);
                    break;
                case Category::PRICE_TYPE_MILLION:
                    $price = round($category->price * ceil($words * $user->redix / 10000), 2);
                    break;
                default:
                    $price = $category->price;
            }
            //创建订单
            $order = new Order([
                'cid' => $request->cid,
                'title' => $request->title,
                'writer' => $request->writer,
                'date_publish' => $request->date_publish,
                'words' => ceil($words * $user->redix),
                'price' => $price,
                'paper_path' => $result['path'],
                'from' => $request->from,
                'content' => '',
            ]);
            $order->user()->associate($user);
            $order->save();
            $order->orderContent()->create([
                'content' => $content
            ]);
            return $order;
        });
        return $order;
//        $order = \DB::transaction(function() use ($user, $category, $uploader, $request, $fileWords, $wordHandler) {
//            if($file = $request->file) {
//                if(!in_array($file->getClientOriginalExtension(), ['doc', 'docx'])) {
//                    //读取文件内容
////                    $content = remove_spec_char(convert2utf8(file_get_contents($file)));
////                    if($category->classid == 4) {//只有classid==4时才是docx
////                        $result = $uploader->save($file, 'files', $user->id);//存本地
////                    } else {
////                        $result = $wordHandler->save($content, 'files', $user->id);
////                    }
//                    $words = count_words(remove_spec_char(convert2utf8($content)));
//                } else {
//                    $result = $uploader->save($file, 'files', $user->id);//存本地
//                    $content = read_docx($result['path']);
//                    $words_count = $fileWords->getWords($request->title, $request->writer, $result['path']);
//                    $words = $words_count['data']['wordCount'];
////                    if($category->classid == 4) {
////                        $content = read_docx($result['real_path']);
////                        $result = $uploader->saveTxt($content, 'files', $user->id);
////                    }
//                }
//            } else {
//                $content = remove_spec_char($request->input('content', ''));
//                $words = count_words($content);
//                if($category->classid == 4 || $category->classid == 2) {
//                    $result = $uploader->saveTxt($content, 'files', $user->id);
//                } else {
//                    $result = $wordHandler->save($content, 'files', $user->id);
//                }
//            }
//            if(!$words <= $category->min_words && $words >= $category->max_words) {
//                throw new InvalidRequestException("检测字数必须在" . $category->min_words . "与" . $category->max_words . "之间");
//            }
//            switch ($category->price_type) {
//                case Category::PRICE_TYPE_THOUSAND:
//                    $price = round($category->price * ceil($words * 1.05 / 1000), 2);
//                    break;
//                case Category::PRICE_TYPE_MILLION:
//                    $price = round($category->price * ceil($words * 1.05 / 10000), 2);
//                    break;
//                default:
//                    $price = $category->price;
//            }
//
//            //创建订单
//            $order = new Order([
//                'cid' => $request->cid,
//                'title' => $request->title,
//                'writer' => $request->writer,
//                'date_publish' => $request->date_publish,
//                'words' => ceil($words * 1.05),
//                'price' => $price,
//                'paper_path' => $result['path'],
//                'from' => $request->from,
//                'content' => $content,
//            ]);
//            $order->user()->associate($user);
//            $order->save();
//
//            return $order;
//        });
//        return $order;
    }

    public function getPdf($api_orderid)
    {
        $apiHandler = app(OrderApiHandler::class);
        return $apiHandler->extractReportPdf($api_orderid);
    }
}
