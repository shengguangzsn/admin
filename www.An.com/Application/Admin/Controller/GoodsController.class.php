<?php

namespace Admin\Controller;

class GoodsController extends BaseController{

	public function index(){
		$this->display();
	}
	public function add(){
		//查处所有的分类
		$cate = M('category')->select();

		//传递分类数据
		$this->assign('cate',$cate);

		$this->display();
	}
	public function edit(){
		$this->display();
	}
	public function delect(){

	}

}