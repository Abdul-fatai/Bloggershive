CREATE TABLE users (
	id int(11) not null PRIMARY KEY AUTO_INCREMENT,
    status varchar(50) not null;
    firstname varchar(255) not null,
    lastname varchar(255) not null,
    username varchar(255) not null,
    email varchar(255) not null,
    profile_img varchar(255),
    password varchar(255) not null,
    reg_date varchar(255) not null
    

);


CREATE TABLE posts (
    post_id int(11) not null PRIMARY KEY AUTO_INCREMENT,
    subject varchar(255) not null,
    label varchar(255) not null,
    post_img varchar(255) not null,
    content text not null,
    author varchar(255) not null,
    status varchar(50) not null,
    post_date Datetime
    post_edit_at Datetime
    
);

CREATE TABLE tags (
    id int(11) not null PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) not null
 
);


CREATE TABLE comments (
    id int(11) not null PRIMARY KEY AUTO_INCREMENT,
    post int(11) not null,
    name varchar(255) not null,
    comment varchar(255) not null,
    comment_date varchar(255) not null


);


CREATE TABLE pwdReset (
    pwdResetId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    pwdResetEmail TEXT NOT NULL,
    pwdResetSelector TEXT NOT NULL,
    pwdResetToken LONGTEXT NOT NULL,
    pwdResetExpires TEXT NOT NULL

);