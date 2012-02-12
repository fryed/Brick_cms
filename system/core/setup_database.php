<?php
//-----INCLUDED FROM SETUP.PHP. HANDLES WRITING A NEW DATABASE-----//

//-----DEFINE AND CREATE TABLES-----//

//--ANALYTICS--//

//define analytics table
$table = "
	CREATE TABLE analytics (
		id int not null auto_increment, 
		primary key(id),
		referer varchar(255) not null,
		visits int(11) not null
	)
";
//create analytics table
mysql_query($table) or die("Error: There was an error creating the 'analytics' table. ".mysql_error());

//--BLOG--//

//define blog table
$table = "
	CREATE TABLE blog (
		id int not null auto_increment, 
		primary key(id),
		created timestamp not null on update current_timestamp default now(),
		created_by varchar(255) not null,
		edited_by varchar(255) not null,
		name varchar(255) not null,
		template varchar(255) not null default 'system/blog-item.tpl',
		title varchar(255) not null,
		content varchar(5000) not null,
		uri varchar(255) not null,
		url varchar(255) not null,
		section varchar(255) not null default '/blog',
		gallery_id int(11) not null,
		image_id int(11) not null default '-4',
		category_id int(11) not null default '-1',
		parent int(11) not null default '-1',
		enabled int(11) not null default '0',
		description varchar(255) not null,
		keywords varchar(255) not null,
		page_visits int(11) not null
	)
";
//create blog table
mysql_query($table) or die("Error: There was an error creating the 'blog' table. ".mysql_error());

//--BLOG CATS--//

//define blog cats table
$table = "
	CREATE TABLE blog_categories (
		id int not null auto_increment, 
		primary key(id),
		name varchar(255) not null
	)
";
//create blog cats table
mysql_query($table) or die("Error: There was an error creating the 'blog_categories' table. ".mysql_error());

//--BLOG COMMENTS--//

//define blog comments table
$table = "
	CREATE TABLE blog_comments (
		id int not null auto_increment, 
		primary key(id),
		created timestamp not null default now(),
		name varchar(255) not null,
		comment varchar(255) not null,
		belongs_to int(11) not null
	)
";
//create blog comments table
mysql_query($table) or die("Error: There was an error creating the 'blog_comments' table. ".mysql_error());

//--BRICKS--//

//define bricks table
$table = "
	CREATE TABLE bricks (
		id int not null auto_increment, 
		primary key(id),
		brick_name varchar(255) not null,
		page_template varchar(255) not null default 'global',
		title varchar(255) not null,
		content varchar(5000) not null,
		enabled tinyint(1) not null default '1'
	)
";
//create blog comments table
mysql_query($table) or die("Error: There was an error creating the 'bricks' table. ".mysql_error());

//--DOWNLOADS--//

//define downloads table
$table = "
	CREATE TABLE downloads (
		id int not null auto_increment, 
		primary key(id),
		name varchar(30) not null,
		src varchar(255) not null,
		description varchar(255) not null,
		belongs_to int(11) not null,
		area varchar(30) not null
	)
";
//create downloads table
mysql_query($table) or die("Error: There was an error creating the 'downloads' table. ".mysql_error());

//--FEATURES--//

//define features table
$table = "
	CREATE TABLE features (
		id int not null auto_increment, 
		primary key(id),
		title varchar(255) not null,
		content varchar(5000) not null,
		img_src varchar(255) not null,
		img_height int(11) not null,
		img_width int(11) not null,
		url varchar(255) not null
	)
";
//create features table
mysql_query($table) or die("Error: There was an error creating the 'features' table. ".mysql_error());

//--FOOTER NAV--//

//define footer nav table
$table = "
	CREATE TABLE footer_nav (
		id int not null auto_increment, 
		primary key(id),
		name varchar(100) not null,
		parent int(11) not null default '-1',
		page_id int(11) not null default '-2',
		menu_order int(11) not null,
		link varchar(255) not null,
		type varchar(100) not null
	)
";
//create footer nav table
mysql_query($table) or die("Error: There was an error creating the 'footer_nav' table. ".mysql_error());

//--GALLERIES--//

//define galleries table
$table = "
	CREATE TABLE galleries (
		id int not null auto_increment, 
		primary key(id),
		name varchar(30) not null,
		url varchar(100) not null		
	)
";
//create galleries table
mysql_query($table) or die("Error: There was an error creating the 'galleries' table. ".mysql_error());

//--HEADER NAV--//

//define header nav table
$table = "
	CREATE TABLE header_nav (
		id int not null auto_increment, 
		primary key(id),
		name varchar(100) not null,
		parent int(11) not null default '-1',
		page_id int(11) not null default '-2',
		menu_order int(11) not null,
		link varchar(255) not null,
		type varchar(100) not null
	)
";
//create header nav table
mysql_query($table) or die("Error: There was an error creating the 'header_nav' table. ".mysql_error());

//--IMAGES--//

//define images table
$table = "
	CREATE TABLE images (
		id int not null auto_increment, 
		primary key(id),
		src varchar(255) not null,
		width int(11) not null,
		height int(11) not null,
		description varchar(255) not null,
		belongs_to int(11) not null
	)
";
//create images table
mysql_query($table) or die("Error: There was an error creating the 'images' table. ".mysql_error());

//--LINKS--//

//define links table
$table = "
	CREATE TABLE links (
		id int not null auto_increment, 
		primary key(id),
		name varchar(255) not null,
		description varchar(255) not null,
		url varchar(255) not null
	)
";
//create links table
mysql_query($table) or die("Error: There was an error creating the 'links' table. ".mysql_error());

//--MAIN NAV--//

//define main nav table
$table = "
	CREATE TABLE main_nav (
		id int not null auto_increment, 
		primary key(id),
		name varchar(100) not null,
		parent int(11) not null default '-1',
		page_id int(11) not null default '-2',
		menu_order int(11) not null,
		link varchar(255) not null,
		type varchar(100) not null
	)
";
//create main nav table
mysql_query($table) or die("Error: There was an error creating the 'main_nav' table. ".mysql_error());

//--MESSAGES--//

//define messages table
$table = "
	CREATE TABLE messages (
		id int not null auto_increment, 
		primary key(id),
		sent timestamp not null on update current_timestamp default now(),
		subject varchar(255) not null,
		name varchar(255) not null,
		email varchar(255) not null,
		content varchar(5000) not null,
		status varchar(30) not null default 'new'
	)
";
//create messages table
mysql_query($table) or die("Error: There was an error creating the 'messages' table. ".mysql_error());

//--MODULES--//

//define modules table
$table = "
	CREATE TABLE modules (
		id int not null auto_increment, 
		primary key(id),
		name varchar(255) not null,
		build_mode tinyint(1) not null default '0',
		installed tinyint(1) not null default '0'
	)
";
//create modules table
mysql_query($table) or die("Error: There was an error creating the 'modules' table. ".mysql_error());

//--NEWS--//

//define news table
$table = "
	CREATE TABLE news (
		id int not null auto_increment, 
		primary key(id),
		created timestamp not null on update current_timestamp default now(),
		created_by varchar(255) not null,
		edited_by varchar(255) not null,
		name varchar(255) not null,
		template varchar(255) not null default 'system/news-item.tpl',
		title varchar(255) not null,
		content varchar(5000) not null,
		uri varchar(255) not null,
		url varchar(255) not null,
		section varchar(255) not null default '/news',
		gallery_id int(11) not null,
		image_id int(11) not null default '-4',
		parent int(11) not null default '-1',
		enabled int(11) not null default '0',
		description varchar(255) not null,
		keywords varchar(255) not null,
		page_visits int(11) not null
	)
";
//create news table
mysql_query($table) or die("Error: There was an error creating the 'news' table. ".mysql_error());

//--PAGES--//

//define pages table
$table = "
	CREATE TABLE pages (
		id int not null auto_increment, 
		primary key(id),
		created timestamp not null on update current_timestamp default now(),
		created_by varchar(255) not null,
		edited_by varchar(255) not null,
		name varchar(255) not null,
		template varchar(255) not null,
		title varchar(255) not null,
		content varchar(5000) not null,
		uri varchar(255) not null,
		url varchar(255) not null,
		section varchar(255) not null,
		gallery_id int(11) not null,
		image_id int(11) not null default '-4',
		parent int(11) not null default '-1',
		enabled int(11) not null default '0',
		description varchar(255) not null,
		keywords varchar(255) not null,
		page_visits int(11) not null
	)
";
//create pages table
mysql_query($table) or die("Error: There was an error creating the 'pages' table. ".mysql_error());

//--SETTINGS--//

//define settings table
$table = "
	CREATE TABLE settings (
		id int not null auto_increment, 
		primary key(id),
		theme varchar(255) not null default 'default',
		debug tinyint(1) not null,
		cache tinyint(1) not null,
		super_cache tinyint(1) not null,
		news tinyint(1) not null,
		blog tinyint(1) not null,
		max_news int(11) not null default '10',
		max_blog int(11) not null default '10',
		max_pages int(11) not null default '10',
		max_latest_news int(11) not null,
		max_latest_blog int(11) not null,
		max_upload_size int(11) not null,
		allowed_images varchar(255) not null,
		allowed_files varchar(255) not null,
		custom_errors tinyint(1) not null default '0',
		email_errors tinyint(1) not null default '0',
		dev_email varchar(255) not null,
		maintenance tinyint(1) not null,
		ip_address varchar(30) not null
	)
";
//create settings table
mysql_query($table) or die("Error: There was an error creating the 'settings' table. ".mysql_error());

//--SITE--//

//define site table
$table = "
	CREATE TABLE site (
		id int not null auto_increment, 
		primary key(id),
		name varchar(255) not null,
		email varchar(255) not null,
		company_name varchar(255) not null,
		company_email varchar(255) not null,
		company_tel varchar(255) not null,
		address_1 varchar(255) not null,
		address_2 varchar(255) not null,
		address_3 varchar(255) not null,
		postcode varchar(30) not null,
		map_postcode varchar(30) not null,
		country varchar(255) not null,
		twitter_account varchar(255) not null,
		facebook_account varchar(255) not null,
		youtube_account varchar(255) not null,
		description varchar(255) not null,
		keywords varchar(255) not null
	)
";
//create site table
mysql_query($table) or die("Error: There was an error creating the 'site' table. ".mysql_error());

//--USERS--//

//define users table
$table = "
	CREATE TABLE users (
		id int not null auto_increment, 
		primary key(id),
		username varchar(30) not null,
		password varchar(255) not null,
		email varchar(255) not null,
		type varchar(30) not null
	)
";
//create users table
mysql_query($table) or die("Error: There was an error creating the 'users' table. ".mysql_error());

//-----ADD STARTUP CONTENT-----//

//--BLOG--//

//define default blog page
$rows = "
	INSERT INTO blog (
		created_by, 
		name,
		template,
		title,
		content,
		uri,
		url,
		description,
		keywords,
		enabled
	)VALUES(
		'system', 
		'My BrickCMS blog homepage',
		'system/blog.tpl',
		'My BrickCMS blog post homepage',
		'<p>The intro for your blog goes here.</p>',
		'/blog',
		'/blog',
		'This is the description of this specific post.',
		'These, are, the, keywords, for, this, specific, post',
		'1'
	)
";
//create default blog page
mysql_query($rows) or die("Error: There was an error adding the 'blog homepage' data. ".mysql_error());

//define default blog post
$rows = "
	INSERT INTO blog (
		created_by, 
		name,
		template,
		title,
		content,
		uri,
		url,
		description,
		keywords,
		enabled
	)VALUES(
		'system', 
		'My BrickCMS blog post',
		'system/blog-item.tpl',
		'My BrickCMS blog post',
		'<p>My first blog post.</p>',
		'/blog-post',
		'/blog/blog-post',
		'This is the description of this specific post.',
		'These, are, the, keywords, for, this, specific, post',
		'1'
	)
";
//create default blog post
mysql_query($rows) or die("Error: There was an error adding the 'blog post' data. ".mysql_error());

//define general blog cat
$rows = "
	INSERT INTO blog_categories (
		id, 
		name
	)VALUES(
		'-1', 
		'General'
	)
";
//create general blog cat
mysql_query($rows) or die("Error: There was an error adding the 'blog category' data. ".mysql_error());

//--DOWNLOADS--//

//define default download
$rows = "
	INSERT INTO downloads (
		name, 
		src,
		description, 
		belongs_to,
		area
	)VALUES(
		'Example download', 
		'/system/data/downloads/24-Dec-11_12-00-00_example.pdf',
		'This is an example download',
		'1', 
		'pages'
	)
";
//create default download
mysql_query($rows) or die("Error: There was an error adding the 'download' data. ".mysql_error());

//--FEATURES--//

//define default feature 1
$rows = "
	INSERT INTO features (
		title, 
		content,
		img_src, 
		img_height,
		img_width,
		url
	)VALUES(
		'Example feature 1',
		'This is an example feature item.' ,
		'/system/data/images/feature1.gif',
		'200',
		'1000', 
		'/example-page'
	)
";
//create default feature 1
mysql_query($rows) or die("Error: There was an error adding the 'feature 1' data. ".mysql_error());

//define default feature 2
$rows = "
	INSERT INTO features (
		title, 
		content,
		img_src, 
		img_height,
		img_width,
		url
	)VALUES(
		'Example feature 2',
		'This is another example feature item.',
		'/system/data/images/feature2.gif',
		'200',
		'1000', 
		'/example-page/sub-page'
	)
";
//create default feature 2
mysql_query($rows) or die("Error: There was an error adding the 'feature 2' data. ".mysql_error());

//--FOOTER NAV--//

//define default footernav 1
$rows = "
	INSERT INTO footer_nav (
		name, 
		page_id, 
		menu_order,
		type
	)VALUES(
		'Home',
		'1', 
		'1', 
		'page'
	)
";
//create default footernav 1
mysql_query($rows) or die("Error: There was an error adding the 'footer nav 1' data. ".mysql_error());

//define default footernav 2
$rows = "
	INSERT INTO footer_nav (
		name, 
		page_id, 
		menu_order,
		type
	)VALUES(
		'Example page',
		'2', 
		'2', 
		'page'
	)
";
//create default footernav 2
mysql_query($rows) or die("Error: There was an error adding the 'footer nav 2' data. ".mysql_error());

//--GALLERIES--//

//define default gallery
$rows = "
	INSERT INTO galleries (
		name, 
		url
	)VALUES(
		'Example gallery',
		'/galleries/example-gallery'
	)
";
//create default gallery
mysql_query($rows) or die("Error: There was an error adding the 'gallery' data. ".mysql_error());

//--HEADER NAV--//

//define default headernav 1
$rows = "
	INSERT INTO header_nav (
		name, 
		page_id, 
		menu_order,
		type
	)VALUES(
		'Home',
		'1', 
		'1', 
		'page'
	)
";
//create default headernav 1
mysql_query($rows) or die("Error: There was an error adding the 'header nav 1' data. ".mysql_error());

//define default headernav 2
$rows = "
	INSERT INTO header_nav (
		name, 
		page_id, 
		menu_order,
		type
	)VALUES(
		'Example page',
		'2', 
		'2', 
		'page'
	)
";
//create default headernav 2
mysql_query($rows) or die("Error: There was an error adding the 'header nav 2' data. ".mysql_error());

//--IMAGES--//

//define default logo
$rows = "
	INSERT INTO images (
		src, 
		width, 
		height,
		description,
		belongs_to
	)VALUES(
		'/system/data/images/brick_logo.gif',
		'200', 
		'100', 
		'This is the brickCMS logo',
		'-2'
	)
";
//create default logo
mysql_query($rows) or die("Error: There was an error adding the 'logo' data. ".mysql_error());

//define default fav icon
$rows = "
	INSERT INTO images (
		src, 
		width, 
		height,
		description,
		belongs_to
	)VALUES(
		'/system/data/images/brick_favicon.ico',
		'10', 
		'10', 
		'This is the brickCMS fav icon',
		'-3'
	)
";
//create default fav icon
mysql_query($rows) or die("Error: There was an error adding the 'fav icon' data. ".mysql_error());

//define default image
$rows = "
	INSERT INTO images (
		src, 
		width, 
		height,
		description,
		belongs_to
	)VALUES(
		'/system/data/images/example_image.gif',
		'200', 
		'200', 
		'This is an example image',
		'1'
	)
";
//create default image
mysql_query($rows) or die("Error: There was an error adding the 'image' data. ".mysql_error());

//--LINKS--//

//define default link
$rows = "
	INSERT INTO links (
		name, 
		description,
		url
	)VALUES(
		'Example link',
		'This is an example link', 
		'http://www.google.co.uk'
	)
";
//create default link
mysql_query($rows) or die("Error: There was an error adding the 'link' data. ".mysql_error());

//--MAIN NAV--//

//define default mainnav 1
$rows = "
	INSERT INTO main_nav (
		name, 
		page_id, 
		menu_order,
		type
	)VALUES(
		'Home',
		'1', 
		'1', 
		'page'
	)
";
//create default mainnav 1
mysql_query($rows) or die("Error: There was an error adding the 'main nav 1' data. ".mysql_error());

//define default mainnav 2
$rows = "
	INSERT INTO main_nav (
		name, 
		page_id, 
		menu_order,
		type
	)VALUES(
		'Example page',
		'2', 
		'2', 
		'page'
	)
";
//create default mainnav 2
mysql_query($rows) or die("Error: There was an error adding the 'main nav 2' data. ".mysql_error());

//define default mainnav 3
$rows = "
	INSERT INTO main_nav (
		name, 
		parent,
		page_id, 
		menu_order,
		type
	)VALUES(
		'Sub page',
		'2',
		'3', 
		'3', 
		'page'
	)
";
//create default mainnav 3
mysql_query($rows) or die("Error: There was an error adding the 'main nav 3' data. ".mysql_error());

//--MESSAGES--//

//define default message
$rows = "
	INSERT INTO messages (
		subject,
		name,
		email,
		content
	)VALUES(
		'Welcome to brickCMS',
		'System',
		'noreply@system.com', 
		'<h2>Welcome to brickCMS.</h2><p>This is the brickCMS inbox.<br/>All messages sent through the site will appear here, as well as being emailed to the address set in admin/settings.</p>'
	)
";
//create default message
mysql_query($rows) or die("Error: There was an error adding the 'message' data. ".mysql_error());

//--NEWS--//

//define default news page
$rows = "
	INSERT INTO news (
		created_by, 
		name,
		template,
		title,
		content,
		uri,
		url,
		description,
		keywords,
		enabled
	)VALUES(
		'system', 
		'My BrickCMS news homepage',
		'system/news.tpl',
		'My BrickCMS news homepage',
		'<p>The Intro for your news section goes here.</p>',
		'/news',
		'/news',
		'This is the description of this specific post.',
		'These, are, the, keywords, for, this, specific, post',
		'1'
	)
";
//create default news page
mysql_query($rows) or die("Error: There was an error adding the 'news homepage' data. ".mysql_error());

//define default news item
$rows = "
	INSERT INTO news (
		created_by, 
		name,
		template,
		title,
		content,
		uri,
		url,
		description,
		keywords,
		enabled
	)VALUES(
		'system', 
		'My BrickCMS news item',
		'system/news-item.tpl',
		'My BrickCMS news item',
		'<p>My first news item.</p>',
		'/news-item',
		'/news/news-item',
		'This is the description of this specific post.',
		'These, are, the, keywords, for, this, specific, post',
		'1'
	)
";
//create default news item
mysql_query($rows) or die("Error: There was an error adding the 'news item' data. ".mysql_error());

//--PAGES--//

//define default home page
$rows = "
	INSERT INTO pages (
		created_by, 
		name,
		template,
		title,
		content,
		uri,
		url,
		description,
		keywords,
		enabled
	)VALUES(
		'system', 
		'My BrickCMS homepage',
		'home.tpl',
		'My BrickCMS homepage',
		'<h2>Welcome to Brick::cms</h2>
		<p>Simply log in to the <a href=\'admin\'>admin area</a> with the details provided below and start editing and adding content.</p>
		<ul>
			<li><strong>Username:</strong>username</li>
			<li><strong>Password:</strong>password</li>
		</ul>
		<p>We recommend you change the default login details as soon as possible.</p>',
		'/',
		'/',
		'This is the description of this specific page.',
		'These, are, the, keywords, for, this, specific, page',
		'1'
	)
";
//create default home page
mysql_query($rows) or die("Error: There was an error adding the 'homepage' data. ".mysql_error());

//define example page
$rows = "
	INSERT INTO pages (
		created_by, 
		name,
		template,
		title,
		content,
		uri,
		url,
		gallery_id,
		description,
		keywords,
		enabled
	)VALUES(
		'system', 
		'My BrickCMS example page',
		'page.tpl',
		'My BrickCMS example page',
		'<p>This is an example page.</p>',
		'/example-page',
		'/example-page',
		'1',
		'This is the description of this specific page.',
		'These, are, the, keywords, for, this, specific, page',
		'1'
	)
";
//create example page
mysql_query($rows) or die("Error: There was an error adding the 'example page' data. ".mysql_error());

//define example sub page
$rows = "
	INSERT INTO pages (
		created_by, 
		name,
		template,
		title,
		content,
		uri,
		url,
		section,
		gallery_id,
		parent,
		description,
		keywords,
		enabled
	)VALUES(
		'system', 
		'My BrickCMS example sub page',
		'page.tpl',
		'My BrickCMS example sub page',
		'<p>This is an example subpage.</p>',
		'/sub-page',
		'/example-page/sub-page',
		'/example-page',
		'0',
		'1',
		'This is the description of this specific page.',
		'These, are, the, keywords, for, this, specific, page',
		'1'
	)
";
//create example sub page
mysql_query($rows) or die("Error: There was an error adding the 'example sub page' data. ".mysql_error());

//--SETTIINGS--//

//define default settings
$rows = "
	INSERT INTO settings (
		theme, 
		debug,
		cache,
		super_cache,
		news,
		blog,
		max_news,
		max_blog,
		max_latest_blog,
		max_latest_news,
		max_upload_size,
		allowed_images,
		allowed_files,
		email_errors,
		dev_email,
		maintenance
	)VALUES(
		'default', 
		'0',
		'0',
		'0',
		'1',
		'1',
		'10',
		'10',
		'3',
		'3',
		'1000000',
		'jpg,JPG,jpeg,png,PNG,gif,GIF,ico',
		'doc,DOC,docx,DOCX,pdf,PDF,zip,ZIP',
		'0',
		'dev@example.com',
		'0'
	)
";
//create default settings
mysql_query($rows) or die("Error: There was an error adding the 'settings' data. ".mysql_error());

//--SITE INFO--//

//define default site info user
$password = sha1("password");
$rows = "
	INSERT INTO site (
		name, 
		email,
		company_name,
		company_email, 
		company_tel,
		address_1,
		address_2,
		address_3,
		postcode,
		map_postcode,
		country,
		twitter_account,
		facebook_account,
		youtube_account,
		description,
		keywords
	)VALUES(
		'My BrickCMS site', 
		'site@site.com', 
		'Brick',
		'site@site.com',
		'0114 1234567',
		'1 Button lane',
		'South ranges',
		'Hyrule',
		'SW1A 1AA',
		'SW1A 1AA',
		'Albion',
		'twit1',
		'face1',
		'tube1',
		'This is the global site description',
		'These, are, the, global, keywords'
	)
";
//create default site info
mysql_query($rows) or die("Error: There was an error adding the 'site' data. ".mysql_error());

//--USERS--//

//define default user
$password = sha1("password");
$rows = "
	INSERT INTO users (
		username, 
		password,
		email, 
		type
	)VALUES(
		'admin', 
		'$password',
		'user@user.com', 
		'developer'
	)
";
//create default user
mysql_query($rows) or die("Error: There was an error adding the 'user' data. ".mysql_error());

?>