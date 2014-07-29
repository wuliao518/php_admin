<?php
	class UserModel extends Model{
		
		protected $_validate=array(
		array('username',		'require',		'不能为空'		),
		array('username',		'',		'用户名重复',   0,   'unique',   1),
		array('username',		'callback_checklen',	'用户名长度在5-20之间',	0,	'callback'),
		array('password',		'require',		'密码必须非空'			),
		
	);
		protected $_auto=array(
		array('password','md5',3,'function'),
		array('modify_time','time',3,'function'),
	);
		public function callback_checklen($data){
			if(strlen($data)<5 || strlen($data)>20){
				return false;
			}
			return true;
		}
	
	}
?>