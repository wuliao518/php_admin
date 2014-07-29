云讯简易版综合修改
1、表结构
user用户表   group分组表    item用户与分组对应
create table lu_user(
	user_id int primary key auto_increment,
	username char(30) not null unique,
	nick_name char(40),                          //昵称
	phone_num char(11) not null unique,
	modify_time char(50) not null default '0',   //最后更改时间
	group_num int not null default 2,			 //每个人允许创建组的数量
	password char(40) not null,
	is_search boolean not null default true   //是否能被搜索
)ENGINE= MYISAM CHARACTER SET utf8 ;


local_num text default null,                 //本地通讯录信息
{
	"users":[{"wuliao","15936201059"}],
	"time":{"12345"}
}


create table lu_group(
	group_id int primary key auto_increment,
	modify_time char(50) not null default '0',
	is_search boolean not null default true,    //是否能被搜索
	groupname char(80) not null unique,
	group_desc text,
	user_id int not null                        //创建组的用户id
)ENGINE= MYISAM CHARACTER SET utf8 ;



create table lu_item(
	group_id int not null,
	user_id int not null
)ENGINE= MYISAM CHARACTER SET utf8 ;


create table lu_local{
	user_id,
	username,
	phone_num
}


insert into lu_group (groupname) values ('郑州易航');
1、用户注册  默认生成一个组，组内用来存放本地通讯录和网上好友的信息。




1、用户创建账号的时候默认一个分组，grounname默认为
public function add(){
	$model=D('User');
	$group=D('Group');
	session_start();
	if($model->create()){
		if($user_id=$model->add()){
			$session_id=session_id();
			$username=$_POST['username'];
			$phone_num=$_POST['phone_num'];
			session('username',$username);
			session('phone_num',$phone_num);
			$data['groupname']=$username;
			$data['user_id']=$user_id;
			//创建一个group，并向item中增加一条数据
			$group_id=$group->add($data);
			$item=D('item');
			$item->add(array('group_id'=>$group_id,'user_id'=>$user_id));
			echo(json_encode(array('status'=>1,'message'=>'success','token'=>$session_id,'user_id'=>$user_id)));
		}else{
			echo(json_encode(array('status'=>0,'message'=>$model->getError(),'token'=>null,'user_id'=>null)));
		}
	}else{
		echo (json_encode(array('status'=>2,'message'=>'fail','token'=>null,'user_id'=>null)));
	}
}