<?php
namespace MessageService\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){

		echo '欢迎使用消息数据处理模块,处理方法文件在Common文件夹下,数据库文件在DBFile文件夹下.';
		$this->display();

	/*
		$senderId=112;
		$receiverId=211;
		$title='aasd';
		$content='2123';
		$messageId=32;
		$arrayReceiverId=array(211,333);
		//if(insertMessageP2Group($senderId,$arrayReceiverId,$title,$content,0,0)	)
		echo 'P2Group success';
		//if(insertMessageP2P($senderId,$receiverId,$title,$content,0,0))
		echo 'P2P success\n';
		//if(insertMessageP2All($senderId,$title,$content,0,0))
		echo 'P2All success';
		//dump(getMessageP2P($receiverId,2));
		//dump(getMessagePublic($receiverId,2));
		//dump(getMessageGroup($receiverId,2));
		//if(readMarkP2P(211,38))
		echo 'p2p update success';
		//if(readMarkP2Group(211,39))
		echo 'p2Group update success';
		//if(readMarkP2All(211,40))
		echo 'p2All update success';
		//if(undoMessage(112,40))
		echo 'undo success';
		//if(deleteMessage(112,40))
		echo 'delete success';
		if(deleteMessageP2P($receiverId,38))
		echo 'delete myP2P ok';
		if(deleteMessageP2Group($receiverId,39))
		echo 'delete myGroup ok';
		if(deleteMessageP2All($receiverId,40))
		echo 'delete myAll ok';
		*/
    }

    /**
     * 发布P2P消息
     * @author 梦天涯
     */
    public function insertMessageP2P_C(){
    	if (IS_POST) {

    		//获取数据
	    	$senderId = I('senderId');					//此处最好改用Session获取
	    	$receiverId = I('receiverId');
	    	$title = I('title');
	    	$content = I('content');
	    	$messageType = I('messageType');
	    	$level= I('level');


	    	// 验证数据(此处是附加验证，正确方法是JS验证，需要前台编写JS验证)
	    	if($senderId==null||!is_numeric($senderId)){	
				echo "<script> alert('请重新登录！');</script>"; 
				echo "<meta http-equiv='Refresh' content='0;URL=".U('User/index/login')."'>"; 
	    		exit();
	    	}
	    	if($receiverId==null||!is_numeric($receiverId)){
	    		echo "<script> alert('请先选择消息发送对象！');</script>"; 
				echo "<meta http-equiv='Refresh' content='0;URL=".U('MessageService/index/index')."'>"; 
	    		exit();
	    	}
	    	if($title=null||$title==""){
	    		echo "<script> alert('标题不能为空！');</script>"; 
				echo "<meta http-equiv='Refresh' content='0;URL=".U('MessageService/index/index')."'>"; 
	    		exit();
	    	}
	    	if($content==null||$content==""){
	    		echo "<script> alert('消息内容不能为空！');</script>"; 
				echo "<meta http-equiv='Refresh' content='0;URL=".U('MessageService/index/index')."'>"; 
	    		exit();
	    	}
	    	if($messageType==null||!is_numeric($messageType)){
	    		echo "<script> alert('消息类型数据格式错误！');</script>"; 
				echo "<meta http-equiv='Refresh' content='0;URL=".U('MessageService/index/index')."'>"; 
	    		exit();
	    	}
	    	if($level==null||!is_numeric($level)){
	    		echo "<script> alert('消息级别数据格式错误！');</script>"; 
				echo "<meta http-equiv='Refresh' content='0;URL=".U('MessageService/index/index')."'>"; 
	    		exit();
	    	}

	    	// 数据库操作
	    	$success=insertMessageP2P($senderId,$receiverId,$title,$content,$messageType,$level);
	    	if($success){
	    		$this->success('发布成功！');
	    		exit();
	    	}else{
	    		$this->error('消息发布失败。');;
	    		exit();
	    	}
    	}
    }


     /**
     * 读取P2P消息
     * @author 梦天涯
     */
    public function getMessageP2P_C(){
    	if (IS_POST) {

    		//获取数据
	    	$receiverId = I('receiverId');	//此处最好改用Session获取
	    	$type = I('type');	

	    	// 验证数据(此处是附加验证，正确方法是JS验证，需要前台编写JS验证)
	    	if($receiverId==null||!is_numeric($receiverId)){
	    		echo "<script> alert('请重新登录！');</script>"; 
				echo "<meta http-equiv='Refresh' content='0;URL=".U('MessageService/index/index')."'>"; 
	    		exit();
	    	}
	    	if($type==null||!is_numeric($type)){
	    		echo "<script> alert('查询类型数据格式错误！');</script>"; 
				echo "<meta http-equiv='Refresh' content='0;URL=".U('MessageService/index/index')."'>"; 
	    		exit();
	    	}

	    	// 数据库操作
	    	$array=getMessageP2P($receiverId,$type);
	    	$this->assign('MessageList',$array)->display('index');
    	}
    }        
}