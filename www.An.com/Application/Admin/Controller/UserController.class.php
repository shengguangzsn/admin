<?php

namespace Admin\Controller;

class UserController extends BaseController{

	public function index(){

		//定义数组
		$Name = [];
		$parameter = [];
		//定义关键词
		$keywords = I('keywords');
		//判断数组和关键词
		if (!empty($keywords)) {
			$Name['user_name'] = ['like',"%{$keywords}%"];
			$parameter['keywords'] = $keywords;
		}
		//计算所有的数据量
		$coun = M('users')->where($Name)->count();
		//定义 页码
		$PageNum = 2;
		//新建一个分页
		$Page = new \Think\Page($coun,$PageNum,$parameter);
		
		//传递数据
		$this->assign('page',$Page->show());
	
		//查询出所有的数
		$find = M('users')->order('id desc')->where($Name) ->Page(I('get.p',1),$PageNum)->select();
	
		//传递数据
		$this -> assign('find',$find);
	
		$this -> display();

	}
	public function add(){

		//判断是否提交数据
		if (IS_POST) {
		//定义规则
		$vali = [
			['user_name','require','用户名不能为空'],
			['user_name','2,8','用户名长度为2-8位',1,'length'],
			['user_name','user_name','用户名已存在',1,'unique'],
			['password','require','密码不能为空'],
			['password','6,12','密码长度为6-12位',1,'length'],
			['password','password2','请确认密码一致',1,'confirm'],
		];

		//创建规则并使用
		$sql = M('users')->validate($vali) ->create();
		//判断规则
		if ($sql === false) {
			return $this -> error(M('users')->getError());
		}

		//密码加密
		$sql['password'] = md5($sql['password']);

		//添加数据
		$add = M('users')->add($sql);

		//判断是否添加成功
		if (empty($add)) {
			return $this ->error('添加失败');
		}
			return $this -> success('添加成功',U('index'));


		}
		$this -> display();
	}
	public function edit(){

		//判断get到的id如果不为空
		if (!I('get.id')) {
				return $this -> error('参数错误');
		}
		//查询出get到的id并且传递出去
		$find = M('users')->find(I('get.id'));
		
		$this -> assign('find',$find);

		//判断IS_POST
		if (IS_POST) {
		
		//定义规则
		$vali =[
			['password','require','密码不能为空'],
			['password','password2','确认密码是否一致',1,'confirm'],
			['password','6,12','密码长度为6-12位',1,'length'],
		];

		//创建规则并且使用
		$create = M('users')->validate($vali)->create();

		//判断规则
		if ($create === false) {
				return $this->error(M('users')->getError());
		}

		$create['password'] = md5($create['password']);

		//保存数据
		$save = M('users')->where(['id'=>I('get.id')])->save($create);

		//判断是否修改成功
		if (empty($save)) {
			return $this->error('修改失败');
				}		
			return $this ->success('修改成功',U('index'));
		}



		$this -> display();		
	}
	public function delete(){
		//判断get到的id是否为空
		if (empty(I('get.id'))) {
			return $this->error('参数错误');
		}
		//查询出get到的id 并且删除
		$find = M('users')->where(['id'=>I('get.id')])->delete();
		//判断是否删除成功
		if (empty($find)) {
			return $this->error('删除失败');
		}
			return $this->success('删除成功',U('index'));

		$this -> display();
	}
}