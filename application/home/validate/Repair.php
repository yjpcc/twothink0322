<?php
 
namespace app\home\validate;
use think\Validate; 

class Repair extends Validate{
     
    protected $rule = [ 
        ['title', 'require', '标题不能为空'],
        ['name', 'require', '报修人姓名不能为空'],
        ['tel', 'require|/^1\d{10}$/', '电话不能为空|电话格式错误'],
        ['address', 'require', '地址不能为空'],
        ['des', 'require', '描述不能为空'],
    ];
}