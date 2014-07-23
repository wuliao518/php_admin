<?php
	class UserModel extends Model{
		
		protected $_validate=array(
		array('username',		'require',		'not null'		),
		array('username',		'',		'unique',   0,   'unique',   1),
		array('username',		'callback_checklen',	'two long or short',	0,	'callback'),
		array('password',		'require',		'密码必须非空'			),
		
	);
		protected $_auto=array(
		array('password','md5',3,'function'),
		array('modify_time','time',3,'function'),
	);
		public function callback_checklen($data){
			if(strlen($data)<6 || strlen($data)>20){
				return false;
			}
			return true;
		}
	
	}
?>