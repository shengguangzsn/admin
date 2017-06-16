<?php

namespace Admin\Controller;

class BrandController extends BaseController{

	public function index(){
		//定义空数组
		$Name = [];
		$baidu = [];
		$keyworeds = I('keywords');

		//判断 关键词如果不为空 
		if (!empty($keyworeds)) {
			$Name['brand_name'] = ['like',"%{$keyworeds}%"];
			$baidu['keywords'] = $keyworeds;
		}
		// 计算总数据量
		$count = M('brand')->where($Name) ->count();

		//页码数
		$pageNun = 2;

		//新建一个分页
		$page = new \Think\Page($count,$pageNun);
		
		//传递数据
		$this->assign('page',$page->show());
	
		//查询出所有的数据
		$list = M('brand')->where($Name)->page(I('p',1),$pageNun)->order('id desc')->select();
	
		//传递
		$this->assign('list',$list);

		$this -> display();

	}
	public function add(){

		//判断是否收到数据
		if (IS_POST) {
			//定义规则
		$vali = [
			['brand_name','require','品牌名称不能为空'],
			['brand_name','brand_name','品牌名已存在',1,'unique'],
		];
			//创建规则并使用
		$data = M('brand') ->validate($vali) ->create();
			
			//判断规则
		if ($data === false ) {
				return $this -> error(M('brand')->getError());
		}
			//添加数据
		$add = M('brand')->add();
			
			//判断是否添加成功
		if (empty($add)) {
			return $this ->error('添加失败');
		}
			return $this ->success('添加成功',U('index'));
		}
		$this ->display();
	
	}
	public function edit(){

	//判断get到的Id如果不为空
		if (!I('get.id')) {
			return $this ->error('参数错误');
		}
	//查询出get到的id并且传递出去
		$find = M('brand')->where(I('get.id'))->find();

		$this->assign('find',$find);

		if (IS_POST) {
			//定义规则
			$vali= [
				['brand_name','require','品牌名不能为空'],
				['brand_name','brand_name','品牌名已存在',1,'unique'],
			];
			//创建并使用规则
			$sql = M('brand') ->validate($vali) -> create();
			//判断规则
			if ($sql === false) {
				return $this-> error(M('brand')->getError());
			}
			//保存规则
			$res = M('brand')->where(['id'=>I('get.id')])->save();
			//判断是否修改成功
			if (empty($res)) {
				 return $this ->error('修改失败');
			}
				return $this -> success('修改成功',U('index'));
			
		}
		
		$this ->display();

	}

	public function delete(){

		//判断get到的id是否为空
		if (empty(I('get.id'))) {
			return $this->error(' 参数错误');
		}
		
		//执行delete语句
		$del = M('brand') ->where(['id'=>I('get.id')])->delete();
		
		//判断是否删除成功
		if (empty($del)) {
			return $this ->error('删除失败');
		}
			return $this ->success('删除成功',U('index'));

	}

}