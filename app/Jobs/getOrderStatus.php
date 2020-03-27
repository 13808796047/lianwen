<?php

namespace App\Jobs;

use App\Handlers\OrderApiHandler;
use App\Models\Enum\OrderEnum;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class getOrderStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }


    public function handle()
    {
        $api = app(OrderApiHandler::class);
        $result = $api->getOrder($this->order->api_orderid);
        info('检测中....');
//        if($result->data->order->status == 7) {
//            $status = OrderEnum::INLINE;
//        } elseif($result->data->order->status == 9) {
//            $status = OrderEnum::CHECKED;
//            dispatch(new CheckOrderStatus($this->order))->delay(now()->addSecond(5));
//        } else {
//            $status = OrderEnum::CHECKING;
//            dispatch(new getOrderStatus($this->order))->delay(now()->addSecond(5));
//        }
        switch ($result->data->order->status) {
            case 7:
                $status = OrderEnum::INLINE;
                break;
            case 9:
                $status = OrderEnum::CHECKED;
                dispatch(new CheckOrderStatus($this->order))->delay(now()->addMinutes());
                break;
            default:
                $status = OrderEnum::CHECKING;
                dispatch(new getOrderStatus($this->order))->delay(now()->addMinutes());
        }
        \DB::transaction(function() use ($status) {
            $this->order->update([
                'status' => $status,
            ]);
        });
    }
}
