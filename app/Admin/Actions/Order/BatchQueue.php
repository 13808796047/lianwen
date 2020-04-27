<?php

namespace App\Admin\Actions\Order;

use App\Jobs\UploadCheckFile;
use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;

class BatchQueue extends BatchAction
{
    public $name = '批量启动队列';

    public function handle(Collection $collection)
    {
        foreach($collection as $model) {
            if($model->status == 1) {
                dispatch(new UploadCheckFile($model));
            }
        }

        return $this->response()->success('启动成功...')->refresh();
    }

}
