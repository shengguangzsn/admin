<?php

namespace Admin\Controller;

class SpecController extends BaseController{
	public function index(){

		//定义两个空数组
		$Name = [];
		$query = [];
		$keywords = I('keywords');
		//判断
		if (!empty($keywords)) {
			$Name['spec_name'] = ['like',"%$keywords%"];
			$query['keywords'] = $keywords;
		}
		
		//定义总数据量
		$PageNum = M('spec')->where($Name)-> count();

		//定义页数
		$parameter = 3;

		//定义page
		$Page = new \Think\Page($PageNum,$parameter,$query);

		//传递数据
		$this -> assign('page',$Page->show());

		//查询出所有的数据
		$find = M('spec')->where($Name)->order('id desc')->Page(I('get.p',1),$parameter) ->select();

		//传递数据
		$this ->assign('list',$find);


		$this-> display();
	}
	public function add(){
		//找出所有的商品类型
		//

		if (IS_POST) {
			//定义规则
			$gz =[
				['spec_name','require','规格名不能为空'],
				['spec_name','spec_name','规格名已存在',1,'unique'],
			];
			//创建规则
			$sql  = M('spec')->validate($gz) -> create();
			//判断并使用
			if ($sql === false) {
				return $this->error(M('spec')->getError());
			}
			//	添加数据
			$res = M('spec') ->add();
			//判断是否添加成功
			if (empty($res)) {
				return $this->error('添加失败');
			}
				return $this->success('添加成功',U('index'));
		}
		$this -> display();
	}
	public function edit(){
		//判断get到的id不为空
		if (!I('get.id')) {
			return $this -> error('参数错误');
		}
		//查询出get到的id 并且传递数据
		$find =M('spec')->where(I('get.id'))->find(I('get.id'));

		$this->assign('find',$find);
		//判断is_post
		if (IS_POST) {
		//定义规则
		$vali = [
			['spec_name','require','规格名不能为空'],
			['spec_name','spec_name','规格名已存在',1,'unique'],
		];
		//创建规则并且使用规则
		$A = M('spec') ->validate($vali) -> create();
		//判断规则
		if ($A === false) {
			return $this ->error(M('spec')->getError()); 
		}
		//保存数据
		$B = M('spec')->where(['id'=>I('get.id')])->save();
		//判断是否修改成功
		if (empty($B)) {
			return $this->error('修改失败');
		}
			return $this->success('修改成功',U('index'));
		}

		$this ->display();

	}
	public function delete(){
		//判断get到的id是否为空
		if (empty(I('get.id'))) {
			return $this->error('参数错误');
		}
		//查询出get到的id并且删除
		$find =M('spec') -> where(['id'=>I('get.id')])->delete();
		//判断是否删除成功
		if (empty($find)) {
			return $this ->error('删除失败');
		}
			return $this->success('删除成功',U('index'));
		$this->display();
	}
}