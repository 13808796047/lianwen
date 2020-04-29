<?php

namespace App\Admin\Actions\Order;

use App\Jobs\CheckOrderStatus;
use App\Jobs\getOrderStatus;
use App\Jobs\UploadCheckFile;
use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;

class BatchQueue extends BatchAction
{
    public $name = '批量启动队列';

    public function handle(Collection $collection)
    {
        foreach($collection as $model) {
            switch ($model->status) {
                case 1:
                    dispatch(new UploadCheckFile($model));
                    break;
                case 3:
                    dispatch(new getOrderStatus($model));
                    break;
                case 4:
                    dispatch(new CheckOrderStatus($model));
                    break;
            }
        }
        return $this->response()->success('启动成功...')->refresh();
    }

}
