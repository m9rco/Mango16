<?php
namespace models\Admin;
use Illuminate\Database\Eloquent\Model;
class User extends Model
{
	protected $table = 'user';
 	public $timestamps = false; //指定是否模型应该被戳记时间。


    /**
     * 限制查找只包括受欢迎的用户。
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePopular($query)
    {
        return $query->where('id', '=', 1);
    }

    /**
     * 限制查找只包括活跃的用户。
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

}

