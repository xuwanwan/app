<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/28
 * Time: 下午6:09
 */
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ProductOrder extends \Eloquent
{

    protected $table = 'product_order';
    protected $guarded = [];

    use SoftDeletingTrait;

    public function scopeOfStatus($query, $status) {
        return $query->whereStatus($status);
    }

    public function products() {
        return $this->belongsToMany('Product', 'order_product', 'order_id', 'product_id')->withPivot('num')->withTimestamps();
    }

    public function getOrderStatusAttribute() {
        $return = '';
        switch($this->status) {
            case 0:
                $return = '未付款';
                break;
            case 1:
                $return = '付款中';
                break;
            case 2:
                $return = '待发货';
                break;
            case 3:
                $return = '待收货';
                break;
            case 4:
                $return = '退款';
                break;
            case 5:
                $return = '已完成';
                break;
            default:
                $return = '未知';
                break;
        }

        return $return;
    }
}
