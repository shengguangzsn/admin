<?php

	namespace Admin\Controller;

	class LoginController extends \Think\Controller{

		public function index(){

				//判断用户提交的数据
			if (IS_POST) {
				$username = I('username');
				$password = I('password');
				$code 	  = I('code');

				if (empty($username)) {
					return $this -> error('用户名不能为空');
				}
				if (empty($password)) {
					return $this -> error('密码不能为空');
				}
				if (empty($code)) {
					return $this -> error('验证码不能为空');
				}	
					//链接上验证码 再判断验证码是否正确与用户提交的验证码
				$Verify = new \Think\Verify;
					if ( ! $Verify -> check($code)) {
						return $this -> error('验证码不正确');
					}
				
					//判断用户
					$user = M('Users') -> where(['username'=>$username])->find();
						if (empty($user)) {
							return $this -> error('该用户不存在');
						}

					//比对密码 解析加密后再比对	
					if (md5($password) != $user['password']) {
							return $this -> error('密码错误');
					}

					unset($user['password']);
					//保存登录状态
					session('admin',$user);
					

					//跳转页面
					return $this -> success('登录成功',U('index/index'));
			}


			$this -> display();
		}
			//验证码设置
		public function Verify(){
			$config =[
				'imageH' => 45,
				'imageW' =>	100,
				'length' =>	4,
				'codeSet'	=>	'345678ABCDEFGHIJKLMNOPQRSTUVWZYX',
				'useCurve'  =>  NULL,
				'fontSize'  =>  15,   
			];

			$Verify = new \Think\Verify($config);
			$Verify -> entry();

		}

		public function logout()
		{
			session('admin','null');
			$this -> success('成功退出登录',U('index'));
		}

	}

