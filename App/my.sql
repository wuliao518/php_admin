create table lu_user(
	user_id int primary key auto_increment,
	username char(30) not null unique,
	phone_num char(11) not null unique,
	password char(40) not null
);



create table lu_group(
	group_id int primary key auto_increment,
	groupname char(80) not null unique
);



create table lu_item(
	group_id int not null,
	user_id int not null
);

insert into lu_group (groupname) values ('郑州易航');