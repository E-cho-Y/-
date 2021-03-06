<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
//登录
class LoginController extends Controller {
    public function login(){//显示用户登录页面
	   $this->display('login');
    }
    public function register(){//显示用户注册页面
	   $this->display('register');
    }
    public function forget(){//显示忘记密码页面
	   $this->display('forget');
    }
    public function loginAdmin(){//显示管理员登录页面
	   $this->display('loginAdmin');
    }
    //接收并处理注册页面传来的数据
    public function accept_register(){
    	//获取表单中的信息
        if(empty($_POST['num'])||empty($_POST['name'])
            ||empty($_POST['password'])||empty($_POST['email'])
            ||empty($_POST['place'])||empty($_POST['phone'])||empty($_POST['code'])){
            $this->error('参数传递出错!');
        }

        $num = $_POST['num'];
        $code = $_POST['code'];
    	$data = array(
    		'u_id' => $_POST['num'], //账户
    		'u_name' => $_POST['name'],//姓名
    		'u_password' => md5($_POST['password']),//用MD5对密码进行加密
    		'u_email' => $_POST['email'],//邮箱
    		'u_place' => $_POST['place'],//交易的地址
    		'u_telphone' => $_POST['phone'],//联系电话
            'u_time' => date("Y-m-d H:i:s"),
    	);
    	$verify = new \Think\Verify();   //判断验证的内置方法
    	if($verify->check($code, $id)){
    		$user = M('User');//连接数据库
    		$is_user=$user->where("u_id=$num")->getField('id');//查找该用户是否存在
    		if($is_user==NULL){
    			$status = $user->add($data);
    			$res = array(
    				'code' => $status,
    				'msg' => $status?'注册成功!':'注册失败',
    			);
    			return $this->ajaxReturn($res);
    		}
    		else{
    			$res = array(
    				'code' => '-1',
    				'msg' => '该用户已注册!',
    			);
    			return $this->ajaxReturn($res);
    		}
    	}
    	else{
    		$res = array(
    			'code' => '-1',
    			'msg' => '验证码错误!',
    		);
    		return $this->ajaxReturn($res);
    	}
    }
    //处理用户登录页面传递过来的参数
    public function accept_login(){
        if(empty($_POST['num'])||empty($_POST['password'])||empty($_POST['code'])){
            $this->error('参数传递出错!');
        }
        //获取登录页面表单中的信息
        $num = $_POST['num'];
    	$code = $_POST['code'];
    	$data = array(
    		'u_id' => $_POST['num'], //账户
    		'u_password' => md5($_POST['password']),//用MD5对密码进行加密
            'u_status' => 1
    	);
        $verify = new \Think\Verify();   //判断验证的内置方法
    	if($verify->check($code, $id)){
    		$user = M('User');//连接数据库
    		$userInfo=$user->where("u_id=$num")->getField();//查找该用户是否存在
            if(!empty($userInfo))
            {
                $newInfo=$user->where($data)->select();//若用户与密码对应正确且未被冻结
                if(!empty($newInfo))
                {
                    session('num',$num);
                    $res = array(
                        'code' => '0',
                        'msg' => '登录成功!',
                    );
                    return $this->ajaxReturn($res);   
                }
                else{
                    $res = array(
                        'code' => '-1',
                        'msg' => '密码错误登录失败或该用户已被冻结!',
                    );
                    return $this->ajaxReturn($res);
                }
            }else{
                $res = array(
                    'code' => '-1',
                    'msg' => '该用户未注册!',
                );
                return $this->ajaxReturn($res);
            }
    		
    	}
    	else{
            $res = array(
                'code' => '-1',
                'msg' => '验证码错误!',
            );
            return $this->ajaxReturn($res);
        }
    }
    //处理管理员登录页面传递来的参数
    public function accept_login_admin(){
        if(empty($_POST['num'])||empty($_POST['password'])||empty($_POST['code'])){
            $this->error('参数传递出错!ww');
        }

        $num = $_POST['num'];
        $code = $_POST['code'];
        $data = array(
            'a_id' => $_POST['num'], //账户
            'a_password' => md5($_POST['password']),//用MD5对密码进行加密
        );
        $verify = new \Think\Verify();   //判断验证的内置方法
        if($verify->check($code, $id)){
            $user = M('Admin');//连接数据库
            $adminInfo=$user->where("a_id=$num")->getField();//查找该用户是否存在
            if(!empty($adminInfo))
            {
                $newAdminInfo=$user->where($data)->select();//若用户与密码对应正确
                if(!empty($newAdminInfo))
                {
                    session('numAdmin',$num);
                    $res = array(
                        'code' => '0',
                        'msg' => '登录成功!',
                    );
                    return $this->ajaxReturn($res);   
                }
                else{
                    $res = array(
                        'code' => '-1',
                        'msg' => '密码错误登录失败!',
                    );
                    return $this->ajaxReturn($res);
                }
            }else{
                $res = array(
                    'code' => '-1',
                    'msg' => '对不起，该用户无管理员权限!',
                );
                return $this->ajaxReturn($res);
            }   
        }
        else{
            $res = array(
                'code' => '-1',
                'msg' => '验证码错误!',
            );
            return $this->ajaxReturn($res);
        }
    }

    public function out_login(){
        if(isset($_SESSION['num']) && $_SESSION['num'] != ''){
            unset($_SESSION['num']);
            $res = '退出成功！';
            return $this->ajaxReturn($res);
        }
    }
    public function out_login_admin(){
        if(isset($_SESSION['numAdmin']) && $_SESSION['numAdmin'] != ''){
            unset($_SESSION['numAdmin']);
            $res = '退出成功！';
            return $this->ajaxReturn($res);
        }
    }
    	
	public function isLogin(){
		if(isset($_SESSION['numAdmin']) && $_SESSION['numAdmin'] != ''){
            $num = $_SESSION['numAdmin'];
            $name = M('Admin')->where("a_id=$num")->getField('a_name');
			$res = array(
				'code' => 0,
				'msg' => $name,
			);
		}else{
			$res = array(
				'code' => -1,
				'msg' => '抱歉，您尚未登录！',
			);
        }
        return $this->ajaxReturn($res);
	}
    public function isLoginUser(){
        if(isset($_SESSION['num']) && $_SESSION['num'] != ''){
            $num = $_SESSION['num'];
            $name = M('User')->where("u_id=$num")->getField('u_name');
            $res = array(
                'code' => 0,
                'msg' => $name,
            );
        }else{
            $res = array(
                'code' => -1,
                'msg' => '未登录！',
            );
        }
        return $this->ajaxReturn($res);
    }
}