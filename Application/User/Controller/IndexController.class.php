<?php
namespace User\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function login(){
        $this->show('hi');
    }


    /**
     * 用户注册
     * @author ancon<zhongfuzhong@gmail.com>
     */
    public function register(){
    	if (IS_POST) {
	    	$email = I('email');
	    	$username = I('username');
	    	$password = I('password');
	    	$repassword = I('repassword');

	    	// dump(I());
	    	// exit();

	    	// 验证数据
	    	// TODO

	    	// 实例化模型
	    	$User = M('user');
	    	// 保存数据
	    	$data = array(
	    		'email'	=>	$email,
	    		'username'	=> $username,
	    		'password'	=>	$password,
	    		);
	    	$User->create($data);
	    	$result = $User->add($data);
	    	if ($result) {
	    		$this->success('succeed!');
	    		exit();
	    	}
    	}
    }    
}