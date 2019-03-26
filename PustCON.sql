CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(32) NOT NULL,
  `sign_up_date` date NOT NULL,
  `activated` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `social_groups`(
`id` int(11) NOT NULL AUTO_INCREMENT,
`groupname` varchar(30) NOT NULL,
`creator_name` varchar(30) NOT NULL,
`member` varchar(30) NOT NULL,
primary key(`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `posts`(
`id` int(11) NOT NULL AUTO_INCREMENT,
`post` text NOT NULL ,
`posted_by` varchar(30) NOT NULL,
`groupname` varchar(30) NOT NULL,
`post_date` datetime NOT NULL,
primary key(`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `comments`(
`id` int(11) NOT NULL,
`comment_text` text NOT NULL ,
`comment_by` varchar(30) NOT NULL,
foreign key(`id`)references posts(id)

) ;





CREATE TABLE IF NOT EXISTS `social_groupschecking`(
`id` int(11) NOT NULL AUTO_INCREMENT,
`groupname` varchar(30) NOT NULL,
`creator_name` varchar(30) NOT NULL,
`member` varchar(30) NOT NULL,
primary key(`id`,`groupname`)
)ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


ALTER TABLE social_groups 
ADD PRIMARY KEY(groupname);


CREATE TABLE IF NOT EXISTS `group_members_list`(
`id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(30) NOT NULL,
 `groupname` varchar(30),
primary key(`id`),
foreign key(`groupname`)references social_groups(groupname)
);


//modified group_members_list`
CREATE TABLE IF NOT EXISTS `group_members_list`(
`id` int(11) NOT NULL,
 `name` varchar(30) NOT NULL,
 `groupname` varchar(30) NOT NULL,
foreign key(`id`)references social_groups(id)
);

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notified_by` varchar(100) NOT NULL,
  `notified_to` varchar(100) NOT NULL,
  `notification` text NOT NULL,
  `groupname` varchar(100) NOT NULL,
  `date_of_notify` date NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `profile_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `nickname` varchar(10) ,
   `occupation` varchar(100) , 
    `intro` varchar(100),
	 `workplace` varchar(100),
	  `current_address` varchar(100),
	   `permanent_address` varchar(100) ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `profile_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `bio`varchar(100),
  `work_history` varchar(100),
  `university` varchar(100),
  `university_post` varchar(100),
  `college` varchar(100),
  `school` varchar(100),
  `professional_sills` varchar(200),
  `current_city` varchar(100),
  `hometown` varchar(100),
  `mobile` varchar(20),
  `website` varchar(50),
  `email` varchar(50),
  `birthday` varchar(30),
  `gender` varchar(10),
  `interested_in` varchar(20),
  `languages` varchar(50),
  `religious_view` varchar(20),
  `political_view` varchar(20),
  `about_yourself` varchar(300),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;







