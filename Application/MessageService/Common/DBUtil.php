<?php
	/**
	* 消息数据库处理类
	* By 梦天涯
	*/
	
	/**
     * 对单个人发送消息
     * @author 梦天涯
	 * @parameter :
	 * $senderId=>发送者ID [int]
	 * $receiverId=>接收者ID [int]
	 * $title=>消息标题 [string]
	 * $content=>消息内容 [string]
	 * $messageType=>消息类型 [int]
	 * $level=>消息级别 [int]
     */
	function insertMessageP2P($senderId,$receiverId,$title,$content,$messageType,$level){
		$dataMessage=array(
			'title'=>$title,
			'content'=>$content,
			'send_uid'=>$senderId,
			'message_type'=>$messageType,
			'level'=>$level,
			'create_time'=>date('Y-m-d H:i:s'),
			'is_undo'=>0,
			'undo_time'=>date('Y-m-d H:i:s'),
			'is_delete'=>0,
			'delete_time'=>date('Y-m-d H:i:s'),
			'receiver_type'=>0 
			);
		$id_rem=M('message')->data($dataMessage)->add();
		if($id_rem){
			$dataMessageUserMark=array(
				'message_id'=>$id_rem,
				'receiver_id'=>$receiverId,
				'is_read'=>0,
				'read_time'=>date('Y-m-d H:i:s'),
				'is_delete'=>0,
				'delete_time'=>date('Y-m-d H:i:s')
				);
			$id=M('messageusermark')->data($dataMessageUserMark)->add();
			if($id){
				return true;
			}else{
				//绑定人员失败，回滚已插入消息
				M('message')->where('id='.$id_rem)->delete();
				return false;
			}
		}else{
			return false;
		}
	}
	
	/**
     * 对成员列表发送消息
     * @author 梦天涯
	 * @parameter :
	 * $senderId=>发送者ID [int]
	 * $arrayReceiverId=>接收者ID数组 [array(int,int,...)]
	 * $title=>消息标题 [string]
	 * $content=>消息内容 [string]
	 * $messageType=>消息类型 [int]
	 * $level=>消息级别 [int]
     */
	 function insertMessageP2Group($senderId,$arrayReceiverId,$title,$content,$messageType,$level){
		$dataMessage=array(
			'title'=>$title,
			'content'=>$content,
			'send_uid'=>$senderId,
			'message_type'=>$messageType,
			'level'=>$level,
			'create_time'=>date('Y-m-d H:i:s'),
			'is_undo'=>0,
			'undo_time'=>date('Y-m-d H:i:s'),
			'is_delete'=>0,
			'delete_time'=>date('Y-m-d H:i:s'),
			'receiver_type'=>1 
			);
		$id_rem=M('message')->data($dataMessage)->add();
		if($id_rem){
			$flag=0; 
			foreach($arrayReceiverId as $value){
				$dataMessageUserMark=array(
					'message_id'=>$id_rem,
					'receiver_id'=>$value,
					'is_read'=>0,
					'read_time'=>date('Y-m-d H:i:s'),
					'is_delete'=>0,
					'delete_time'=>date('Y-m-d H:i:s')
					);
				$id=M('messageusermark')->data($dataMessageUserMark)->add();
				if($id==0){
					$flag=1;
					break;
				}
			}
			if(flag!=0){
				//绑定人员失败，回滚已插入消息
				M('message')->where('id='.$id_rem)->delete();
				return false;
			}
			return true;
		}else{
			return false;
		}
	}
	/**
     * 对所有成员发送消息(通常为系统消息)
     * @author 梦天涯
	 * @parameter :
	 * $senderId=>发送者ID [int]
	 * $arrayReceiverId=>接收者ID数组 [array(int,int,...)]
	 * $title=>消息标题 [string]
	 * $content=>消息内容 [string]
	 * $messageType=>消息类型 [int]
	 * $level=>消息级别 [int]
     */
	function insertMessageP2All($senderId,$title,$content,$messageType,$level){
		$dataMessage=array(
			'title'=>$title,
			'content'=>$content,
			'send_uid'=>$senderId,
			'message_type'=>$messageType,
			'level'=>$level,
			'create_time'=>date('Y-m-d H:i:s'),
			'is_undo'=>0,
			'undo_time'=>date('Y-m-d H:i:s'),
			'is_delete'=>0,
			'delete_time'=>date('Y-m-d H:i:s'),
			'receiver_type'=>2 
			);
		$id=M('message')->data($dataMessage)->add();
		if($id){
			return true;
		}else{
			return false;
		}
	}

	/**
     * 接收者获取P2P消息 
     * @author 梦天涯
	 * @parameter :
	 * $receiverId=>接收者ID [int]
	 * $type:0-未读 1-已读 2-全部
     */
	function getMessageP2P($receiverId,$type){
		if($type==0){
			$sql='select * from '.C('DB_PREFIX').'message a,'.C('DB_PREFIX').'messageusermark b where a.m_id=b.message_id and b.receiver_id='.$receiverId.' and a.receiver_type=0 and a.is_undo=0 and a.is_delete=0 and b.is_read=0 and b.is_delete=0 order by a.create_time desc';
			return M()->query($sql);
		}else if($type==1){
			$sql='select * from '.C('DB_PREFIX').'message a,'.C('DB_PREFIX').'messageusermark b where a.m_id=b.message_id and b.receiver_id='.$receiverId.' and a.receiver_type=0 and a.is_undo=0 and a.is_delete=0 and b.is_read=1 and b.is_delete=0 order by a.create_time desc';
			return M()->query($sql);
		}else{
			$sql='select * from '.C('DB_PREFIX').'message a,'.C('DB_PREFIX').'messageusermark b where a.m_id=b.message_id and b.receiver_id='.$receiverId.' and a.receiver_type=0 and a.is_undo=0 and a.is_delete=0 and b.is_delete=0 order by a.create_time desc';
			return M()->query($sql);
		}
	}
	/**
     * 接收者获取群组消息 
     * @author 梦天涯
	 * @parameter :
	 * $receiverId=>接收者ID [int]
	 * $type:0-未读 1-已读 2-全部
     */	
	 function getMessageGroup($receiverId,$type){
		if($type==0){
			$sql='select * from '.C('DB_PREFIX').'message a,'.C('DB_PREFIX').'messageusermark b where a.m_id=b.message_id and b.receiver_id='.$receiverId.' and a.receiver_type=1 and a.is_undo=0 and a.is_delete=0 and b.is_read=0 and b.is_delete=0 order by a.create_time desc';
			return M()->query($sql);
		}else if($type==1){
			$sql='select * from '.C('DB_PREFIX').'message a,'.C('DB_PREFIX').'messageusermark b where a.m_id=b.message_id and b.receiver_id='.$receiverId.' and a.receiver_type=1 and a.is_undo=0 and a.is_delete=0 and b.is_read=1 and b.is_delete=0 order by a.create_time desc';
			return M()->query($sql);
		}else{
			$sql='select * from '.C('DB_PREFIX').'message a,'.C('DB_PREFIX').'messageusermark b where a.m_id=b.message_id and b.receiver_id='.$receiverId.' and a.receiver_type=1 and a.is_undo=0 and a.is_delete=0 and b.is_delete=0 order by a.create_time desc';
			return M()->query($sql);
		}
	 }
	 
	/**
     * 接收者获取公共消息
     * @author 梦天涯
	 * @parameter :
	 * $receiverId=>接收者ID [int]
	 * $type:0-未读 1-已读 2-全部
     */
	 function getMessagePublic($receiverId,$type){
		if($type==0){
			$sql='select * from '.C('DB_PREFIX').'message where m_id not in (select message_id from '.C('DB_PREFIX').'message a,'.C('DB_PREFIX').'messageusermark b where a.m_id=b.message_id and b.receiver_id='.$receiverId.' and a.receiver_type=2 and a.is_undo=0 and a.is_delete=0) and is_undo=0 and is_delete=0 and receiver_type=2 order by create_time desc';
			return M()->query($sql);
		}else if($type==1){
			$sql='select * from '.C('DB_PREFIX').'message a,'.C('DB_PREFIX').'messageusermark b where a.m_id=b.message_id and b.receiver_id='.$receiverId.' and a.receiver_type=2 and a.is_undo=0 and a.is_delete=0 and b.is_delete=0 order by a.create_time desc';
			return M()->query($sql);
		}else{
			$sql='select * from '.C('DB_PREFIX').'message where m_id not in (select message_id from '.C('DB_PREFIX').'message a,'.C('DB_PREFIX').'messageusermark b where a.m_id=b.message_id and b.receiver_id='.$receiverId.' and a.receiver_type=2 and a.is_undo=0 and a.is_delete=0 and b.is_delete=1) and is_undo=0 and is_delete=0 and receiver_type=2 order by create_time desc';
			return M()->query($sql);
		}
	 }
	 
	/**
     * 接收者标记P2P消息为已读
     * @author 梦天涯
	 * @parameter :
	 * $receiverId=>读者ID
	 * $messageId=>消息ID 
     */	 
	 function readMarkP2P($receiverId,$messageId){
		$sql='update '.C('DB_PREFIX').'messageusermark set is_read=1,read_time=\''.date('Y-m-d H:i:s').'\' where receiver_id='.$receiverId.' and message_id='.$messageId;
		return M()->execute($sql);
	 }
	 
	 /**
     * 接收者删除P2P消息
     * @author 梦天涯
	 * @parameter :
	 * $receiverId=>读者ID
	 * $messageId=>消息ID 
     */	 
	 function deleteMessageP2P($receiverId,$messageId){
		$sql='update '.C('DB_PREFIX').'messageusermark set is_delete=1,delete_time=\''.date('Y-m-d H:i:s').'\' where receiver_id='.$receiverId.' and message_id='.$messageId;
		return M()->execute($sql);
	 }
	 
	 /**
     * 接收者标记P2Group消息为已读
     * @author 梦天涯
	 * @parameter :
	 * $receiverId=>读者ID
	 * $messageId=>消息ID 
     */	 
	 function readMarkP2Group($receiverId,$messageId){
		$sql='update '.C('DB_PREFIX').'messageusermark set is_read=1,read_time=\''.date('Y-m-d H:i:s').'\' where receiver_id='.$receiverId.' and message_id='.$messageId;
		return M()->execute($sql);
	 }
	 
	 /**
     * 接收者删除P2Group消息
     * @author 梦天涯
	 * @parameter :
	 * $receiverId=>读者ID
	 * $messageId=>消息ID 
     */	 
	 function deleteMessageP2Group($receiverId,$messageId){
		$sql='update '.C('DB_PREFIX').'messageusermark set is_delete=1,delete_time=\''.date('Y-m-d H:i:s').'\' where receiver_id='.$receiverId.' and message_id='.$messageId;
		return M()->execute($sql);
	 }
	 
	 /**
     * 接收者标记P2All消息为已读
     * @author 梦天涯
	 * @parameter :
	 * $receiverId=>读者ID
	 * $messageId=>消息ID 
     */	 
	 function readMarkP2All($receiverId,$messageId){
		$arrayWhere=array(
			'message_id'=>$messageId,
			'receiver_id'=>$receiverId
			);
		$id=M('messageusermark')->where($arrayWhere)->field('mum_id')->select();
		if($id){
			$sql='update '.C('DB_PREFIX').'messageusermark set is_read=1,read_time=\''.date('Y-m-d H:i:s').'\' where receiver_id='.$receiverId.' and message_id='.$messageId;
			return M()->execute($sql);
		}else{
			$dataMessageUserMark=array(
					'message_id'=>$messageId,
					'receiver_id'=>$receiverId,
					'is_read'=>1,
					'read_time'=>date('Y-m-d H:i:s')
					);
			$idInsert=M('messageusermark')->data($dataMessageUserMark)->add();
			if($idInsert){
				return true;
			}else{
				return false;
			}
		}
	 }
	 
	  /**
     * 接收者删除P2All消息
     * @author 梦天涯
	 * @parameter :
	 * $receiverId=>读者ID
	 * $messageId=>消息ID 
     */	 
	 function deleteMessageP2All($receiverId,$messageId){
		$arrayWhere=array(
			'message_id'=>$messageId,
			'receiver_id'=>$receiverId
			);
		$id=M('messageusermark')->where($arrayWhere)->field('mum_id')->select();
		if($id){
			$sql='update '.C('DB_PREFIX').'messageusermark set is_delete=1,delete_time=\''.date('Y-m-d H:i:s').'\' where receiver_id='.$receiverId.' and message_id='.$messageId;
			return M()->execute($sql);
		}else{
			$dataMessageUserMark=array(
					'message_id'=>$messageId,
					'receiver_id'=>$receiverId,
					'is_read'=>0,
					'read_time'=>date('Y-m-d H:i:s'),
					'is_delete'=>0,
					'delete_time'=>date('Y-m-d H:i:s')
					);
			$idInsert=M('messageusermark')->data($dataMessageUserMark)->add();
			if($idInsert){
				return true;
			}else{
				return false;
			}
		}
	 }
	 
	 /**
     * 发送者撤销消息
     * @author 梦天涯
	 * @parameter :
	 * $senderId=>发送者ID
	 * $messageId=>消息ID 
     */	
	 function undoMessage($senderId,$messageId){
		$sql='update '.C('DB_PREFIX').'message set is_undo=1,undo_time=\''.date('Y-m-d H:i:s').'\' where send_uid='.$senderId.' and m_id='.$messageId;
			return M()->execute($sql);
	 }
	 
	 /**
     * 发送者删除消息
     * @author 梦天涯
	 * @parameter :
	 * $senderId=>发送者ID
	 * $messageId=>消息ID 
     */	
	 function deleteMessage($senderId,$messageId){
		$sql='update '.C('DB_PREFIX').'message set is_delete=1,delete_time=\''.date('Y-m-d H:i:s').'\' where send_uid='.$senderId.' and m_id='.$messageId;
			return M()->execute($sql);
	 }
	 
?>
