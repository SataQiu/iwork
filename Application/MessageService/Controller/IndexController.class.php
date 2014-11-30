<?php
namespace MessageService\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
       // $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是MessageService模块的Index控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
		echo '欢迎使用消息数据处理模块,处理方法文件在Common文件夹下,数据库文件在DBFile文件夹下.';
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
}