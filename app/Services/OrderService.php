<?php


namespace App\Services;


use App\Exceptions\InvalidRequestException;
use App\Models\Category;
use App\Models\Order;

class OrderService
{
    public function add($user, $category, $uploader, $request, $fileWords, $wordHandler)
    {
        $order = \DB::transaction(function() use ($user, $category, $uploader, $request, $fileWords, $wordHandler) {
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
                dd($content);
                $result = $wordHandler->save($content, 'files', $user->id);
                $words = count_words($content);
            }
            if(!$words <= $category->min_words && $words >= $category->max_words) {
                throw new InvalidRequestException("检测字数必须在" . $category->min_words . "与" . $category->max_words . "之间");
            }
            switch ($category->price_type) {
                case Category::PRICE_TYPE_THOUSAND:
                    $price = round($category->price * ceil($words * 1.05 / 1000), 2);
                    break;
                case Category::PRICE_TYPE_MILLION:
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
        return $order;
    }
}
