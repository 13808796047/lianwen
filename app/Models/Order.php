<?php

namespace App\Models;

use Carbon\Carbon;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use Traits\CheckOrderHelper;
    use DefaultDatetimeFormat;
    use SoftDeletes;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function report()
    {
        return $this->hasOne(Report::class);
    }

    public function scopeWithOrder($query, $order)
    {
        switch ($order) {
            case "yesterday":
                $query->yesterdayOrder();
                break;
            case 'month':
                $query->monthOrder();
                break;
            case 'pre_month':
                $query->preMonthOrder();
                break;
            default:
                $query->todayOrder();
        }
    }

    public function scopeTodayOrder($query)
    {
        return $query->whereBetween('date_pay', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()]);
    }

    public function scopeYesterdayOrder($query)
    {
        return $query->whereBetween('date_pay', [Carbon::now()->subDay()->startOfDay(), Carbon::now()->subDay()->endOfDay()]);
    }

    public function scopeMonthOrder($query)
    {
        return $query->whereBetween('date_pay', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
    }

    public function scopePreMonthOrder($query)
    {
        return $query->whereBetween('date_pay', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]);
    }

    //分类
    public function category()
    {
        return $this->belongsTo(Category::class, 'cid');
    }

    protected static function boot()
    {
        parent::boot();
        // 监听模型创建事件，在写入数据库之前触发
        static::creating(function($model) {
            // 如果模型的 no 字段为空
            if(!$model->orderid) {
                // 调用 findAvailableNo 生成订单流水号
                $model->orderid = static::findAvailableNo();
                // 如果生成失败，则终止创建订单
                if(!$model->orderid) {
                    return false;
                }
            }
        });
    }

    public static function findAvailableNo()
    {
        // 订单流水号前缀
        $prefix = date('Ymd');
        for($i = 0; $i < 10; $i++) {
            // 随机生成 6 位的数字
            $no = $prefix . str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            // 判断是否已经存在
            if(!static::query()->where('orderid', $no)->exists()) {
                return $no;
            }
        }
        \Log::warning('find order no failed');

        return false;
    }

}
