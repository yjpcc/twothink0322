<?php
// +----------------------------------------------------------------------
// | TwoThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.twothink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 艺品网络
// +---------------------------------------------------------------------- 

namespace app\home\controller;

/**
 * 后台频道控制器 
 */

class Repair extends Home {

    /**
     * 频道列表 
     */
    public function index(){
        $repairs = db('repair')->paginate(5);
        $page = $repairs->render();
        $this->assign('repairs' ,$repairs);
        $this->assign('_page' , $page);
        $this->assign('meta_title' , '报修管理');
        return $this->fetch();
    }

    public function add(){
        if(request()->isPost()){
            $repair = model('repair');
            $post_data=\think\Request::instance()->post();
            //自动验证
            $validate = validate('repair');
            if(!$validate->check($post_data)){
            	return $this->error($validate->getError());
            }
            $data = $repair->create($post_data);
            if($data){ 
                    $this->success('新增成功', url('index/index'));
                    //记录行为
                    action_log('update_repair', 'repair', $data->id, UID);
            } else {
                $this->error($repair->getError());
            }
        } else {
            $this->assign('info',null);
            return $this->fetch('repair');
        }
    }


    public function edit($id = 0){
        if($this->request->isPost()){
        	$postdata = \think\Request::instance()->post();
            //自动验证
            $validate = validate('repair');
            if(!$validate->check($postdata)){
                return $this->error($validate->getError());
            }
            $repair = \think\Db::name("repair");
            $data = $repair->update($postdata);
            if($data !== false){ 
                $this->success('编辑成功', url('index')); 
            } else {
                $this->error('编辑失败');
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = \think\Db::name('repair')->find($id);

            if(false === $info){
                $this->error('获取配置信息错误');
            }
            $this->assign('info', $info);
            $this->meta_title = '编辑导航';
            return $this->fetch();
        }
    }

    /**
     * 删除频道
     * @author 艺品网络  <twothink.cn>
     */
    public function del(){


        $id = array_unique((array)input('id/a',0));
        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(\think\Db::name('repair')->where($map)->delete()){
            //记录行为
            action_log('update_repair', 'repair', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

    /**
     * 导航排序
     * @author 艺品网络  <twothink.cn>
     */
    public function sort(){
        if(request()->isGet()){
            $ids = input('ids');
            $pid = input('pid');

            //获取排序的数据
            $map = array('status'=>array('gt',-1));
            if(!empty($ids)){
                $map['id'] = array('in',$ids);
            }else{
                if($pid !== ''){
                    $map['pid'] = $pid;
                }
            }
            $list = \think\Db::name('Channel')->where($map)->field('id,title')->order('sort asc,id asc')->select();

            $this->assign('list', $list);
            $this->assign('meta_title','导航排序');
            return $this->fetch();
        }elseif (request()->isPost()){
            $ids = input('ids');
            $ids = explode(',', $ids);
            foreach ($ids as $key=>$value){
                $res = \think\Db::name('Channel')->where(array('id'=>$value))->setField('sort', $key+1);
            }
            if($res !== false){
                $this->success('排序成功！');
            }else{
                $this->error('排序失败！');
            }
        }else{
            $this->error('非法请求！');
        }
    }
}