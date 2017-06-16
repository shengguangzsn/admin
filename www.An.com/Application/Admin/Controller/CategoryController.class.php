<?php
	namespace Admin\Controller;

	class CategoryController extends BaseController{
			public function index(){
				//定义两个空数组和keywords关键词
				$Name = [];
				$baidu = [];
				$keyworeds = I('keywords');

				//判断 关键词如果不为空 
				if (!empty($keyworeds)) {
					$Name['cate_name'] = ['like',"%{$keyworeds}%"];
					$baidu['keywords'] = $keyworeds;
				}
				//计算总数据量
				$PageNum = M('category')->where($Name)->count();
				//设置页码数
				$PageY = 1;
				//定义Page
				$page = new \Think\Page($PageNum,$PageY);
				//传递page
				$this -> assign('page',$page->show());
				//查询出所有的数据
				$list = M('category')->where($Name) ->Page(I('p',1),$PageY)->select();
				
				//将查询出来的数据传递
				$this->assign('list',$list);

				$this->display();
			}

			public function add(){
				//判断是否接受到数据
				if (IS_POST) {
					//定义规则
					$vali = [
						['cate_name','require','分类名称不能为空'],
						['cate_name','cate_name','分类名称不能重复',1,'unique'],
					];
					//创建规则
					$data = M('category')->Validate($vali)->create();
					//使用判断规则
					if ($data === false) {
						return $this-> error(M('category')->getError());
					}
				//添加数据
					$add = M('category')->add();
				//判断是否添加成功
					if (empty($add)) {
						return $this->error('添加分类失败');
					}
						return $this->success('添加分类成功',U('index'));
				}
				//找出所有的数据
				$a_list = M('category')->select();
	
				//传递数据
				$this->assign('add',$a_list);


				$this ->display();
			}
			public function edit(){
					//判断如果get到的id不为空
					if (!I('get.id')) {
						return $this->error('参数错误');
					}
					//查询get到的Id并且传递出去
					$find = M('category') ->where(I('get.id'))->find();
				
					$this->assign('find',$find);

					//判断是否接收到数据
						if (IS_POST) {
						//定义规则
							$vali = [
								['cate_name','require','分类名称不能为空'],
								['cate_name','cate_name','分类名称不能重复',1,'unique'],
							];
						//创建规则
							$data = M('category')->Validate($vali)->create();

						//判断并使用规则
							if ($data === false) {
								return $this -> error(M('category')->getError());
							}
						//保存数据
							$res = M('category')->where(['id'=>I('get.id')])->save();
						
						//判断是否修改成功
							if (empty($res)) {
								return $this -> error('分类修改失败');
							}
								return $this -> success('分类修改成功',U('index'));
						}
					$this->display();
			}
			public function delete(){	
				//判断get到数据如果不为空
				if (empty(I('get.id'))) {
					return $this->error('参数错误');
				}
				//查询get到的数据并且删除
				$del = M('category')->where(['id'=>I('get.id')])->delete();
				
				//判断是否删除成功.
				if (empty($del)) {
						return $this->error('删除失败');
				}
						return $this->success('删除成功',U('index'));
			}
	}