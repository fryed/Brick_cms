<?php 
//-----INITIATE THE SYSTEM-----//

//start the session
session_start();

//check for db vars and connection to db and run setup if not found
$SETUP = new setup();	
$SETUP->username	=	$DBusername;	
$SETUP->password	=	$DBpassword;	
$SETUP->database	=	$DBname;	
$SETUP->posts		=	$_POST;	
$SETUP->checkSetup();
//restore error handler after setup
restore_error_handler();

//connect to DB
$DB = new DBconnect();
$DB->username 		= 	$DBusername;
$DB->password 		= 	$DBpassword;
$DB->database 		= 	$DBname;
$DB->connect();

//set arrays
$pageInfoArray 		= array();
$siteInfoArray 		= array();
$navInfoArray 		= array(); 
$blogInfoArray 		= array(); 
$newsInfoArray 		= array(); 
$moduleInfoArray 	= array(); 
$brickInfoArray		= array();

//get site settings
$SETTINGS = new GETsettings();
$settingsArray = $SETTINGS->settings();

//custom error handler
if($settingsArray["custom_errors"]){
	$ERRhandler = new errorHandler();
	$ERRhandler->logErrors 	= true;
	$ERRhandler->sendEmail 	= $settingsArray["email_errors"];
	$ERRhandler->email 		= $settingsArray["dev_email"];
	set_error_handler(array(&$ERRhandler,"customErrors"));
}

//get site info
$SITE = new SITEinfo();
$siteInfoArray = $SITE->getInfo();

//run smarty
$CMS = new Smarty();

//smarty options
$CMS->compile_check = false;
$CMS->caching 		= $settingsArray["cache"];
$CMS->debugging 	= $settingsArray["debug"];
//$CMS->config_dir 	= "system/lib/php/smarty/configs";

//get page info from url -- homepage is always /
$URI = new URIcontroller();
//get uri info
$pageUri 		= 	$URI->getUri();
$sections		=	$URI->getSections();
$pageUrl		=	$URI->getUrl();
$pageName		=	$URI->getName();
$pageSections	=	$URI->getSections();
$homePath		=	$URI->getHomePath();
$area			=	$URI->checkArea();
$logStatus		=	$URI->checkLogStatus();

//set the table to get pageinfo from
switch($area){
	
	case "blog":
	$table = "blog";
	break;
	
	case "news":
	$table = "news";
	break;
	
	default:
	$table = "pages";			
	
}

//make sure posts and get are safe
$POST = new stripPosts();
$POST->posts 	= 	$_POST;
$POST->get 		= 	$_GET;
$POST->area		=	$area;
$POST->safePost();
$POST->safeGet();
$_POST 			= 	$POST->getPost();
$_GET 			= 	$POST->getGet();

//send all posts through the validator
$VALI = new validator();
$VALI->posts 	=	$_POST;
$VALI->pageUrl 	=	$pageUrl;
$VALI->homePath =	$homePath;
$VALI->area		=	$area;
$_POST			=	$VALI->validatePosts();

//run analytics
$TRACK = new analytics();
$TRACK->pageUrl 	=	$pageUrl;
$TRACK->area 		=	$area;
$TRACK->table		=	$table;
$TRACK->track();

//handle caching
//if turned on nothing below here will run
$CACHE = new PAGEcache();
$CACHE->settings	=	$settingsArray;
$CACHE->CMS			=	$CMS;
$CACHE->pageUrl		=	$pageUrl;
$CACHE->area		=	$area;
$CACHE->cache();

//build navigation
$NAV = new NAVbuilder();
$NAV->pageUrl	=	$pageUrl;
$NAV->area		=	$area;

//main nav
$NAV->menu		=	"main_nav";
$NAV->build();
$mainNavArray 	= 	$NAV->getMenu();

//header nav
$NAV->menu		=	"header_nav";
$NAV->simpleNav	=	true;
$NAV->build();
$headerNavArray	=	$NAV->getMenu();

//footer nav
$NAV->menu		=	"footer_nav";
$NAV->simpleNav	=	true;
$NAV->build();
$footerNavArray	=	$NAV->getMenu();

//send to nav array
$navInfoArray["header"] = $headerNavArray;
$navInfoArray["main"] 	= $mainNavArray;
$navInfoArray["footer"] = $footerNavArray;

//handle all posts
$POSTHANDLER = new postHandler();
$POSTHANDLER->posts			=	$_POST;
$POSTHANDLER->pageUrl		=	$pageUrl;
$POSTHANDLER->homePath		=	$homePath;
$POSTHANDLER->settingsArray	=	$settingsArray;
$POSTHANDLER->siteInfoArray	=	$siteInfoArray;
$POSTHANDLER->handlePosts();

switch($area){
	
	//-----ADMIN-----//
	case "admin":	
	//login check
	$LOGCHECK = new handleLogin();
	$LOGCHECK->homePath		=	$homePath;
	$LOGCHECK->posts		=	$_POST;
	$LOGCHECK->logStatus	=	$logStatus;
	$LOGCHECK->logCheck();
	$user					=	$LOGCHECK->getUser();
	$userType				=	$LOGCHECK->getUserType();

	//get page info
	$params 		=	"WHERE url = '$pageUrl'";
	$pageInfoArray 	= 	$DB->query("*","pages",$params);
	//set custom var
	$pageInfoArray["custom"] 	= 	false;

	//get list of pages
	$PL = new pageLister();
	$PL->table					=	"pages";
	$siteInfoArray["pages"]		= 	$PL->getPages();
	
	//get news nav
	$NL = new pageLister();
	$NL->table 					= 	"news";
	$NL->newsMenu 				= 	true;
	$newsInfoArray["menu"]		= 	$NL->getPages();	
	
	//get blog nav
	$BL = new pageLister();
	$BL->table 					= 	"blog";
	$BL->blogMenu 				= 	true;
	$blogInfoArray["menu"]		= 	$BL->getPages();	
		
	//get list of galleries
	$siteInfoArray["galleries"]	= 	$DB->queryArray("*","galleries","");

	//get list of templates
	$DIRreader					=	new DIRreader();
	$DIRreader->dir 			=	"theme/".$settingsArray["theme"];
	$DIRreader->ignore 			=	"main.tpl";
	$siteInfoArray["templates"]	=	$DIRreader->getFiles();
	
	//get new message number
	$params						=	"WHERE status = 'new'";
	$messages					=	$DB->queryArray("*","messages",$params);
	$siteInfoArray["messages"]	=	count($messages);
	
	//get analytics
	$TRACK->siteInfoArray 		=	$siteInfoArray;
	$siteInfoArray				=	$TRACK->getAnalytics();

	//display admin templates if admin is true and check for custom uri's not in database
	$ADMIN = new ADMINbuilder();
	$ADMIN->pageUrl			=	$pageUrl;
	$ADMIN->pageName		=	$pageName;
	$ADMIN->pageInfoArray	=	$pageInfoArray;
	$ADMIN->siteInfoArray	=	$siteInfoArray;
	$ADMIN->newsInfoArray	=	$newsInfoArray;
	$ADMIN->blogInfoArray	=	$blogInfoArray;
	$ADMIN->brickInfoArray	=	$brickInfoArray;
	$ADMIN->settingsArray	=	$settingsArray;
	$ADMIN->buildAdmin();
	$pageInfoArray			=	$ADMIN->getPageInfo();
	$siteInfoArray			=	$ADMIN->getSiteInfo();
	$newsInfoArray			=	$ADMIN->getNewsInfo();
	$blogInfoArray			=	$ADMIN->getBlogInfo();
	$brickInfoArray			=	$ADMIN->getBrickInfo();
	$settingsArray			=	$ADMIN->getSettings();

	//never cache admin pages
	$CMS->caching = false;

	//set smarty paths
	$CMS->template_dir		= 	"system/admin_templates";
	$CMS->compile_dir 		= 	"system/lib/php/smarty/admin_compile";
	break;
	
	//-----PAGES, BLOG, NEWS-----//
	default:
	//get page info
	$params						=	"WHERE url = '$pageUrl'";
	$pageInfoArray 				= 	$DB->query("*","$table",$params);
	$user 						=	false;
	$userType 					=	false;

	//if no data found in db check for custom page
	if(!$pageInfoArray){
		$CUST = new CUSTOMbuilder();
		$CUST->pageUrl			 =	$pageUrl;
		$pageInfoArray			 =	$CUST->getCustom();
	}else{
		$pageInfoArray["custom"] = 	false;
	}
		
	//get feature showcase area
	$FEAT = new FEAThandler();
	$FEAT->siteInfoArray	=	$siteInfoArray;
	$siteInfoArray			=	$FEAT->getFeatures();
	
	//get links
	$LINK = new LINKhandler();
	$LINK->siteInfoArray	=	$siteInfoArray;
	$siteInfoArray			=	$LINK->getLinks();
	
	//get list of latest news items
	$NL = new pageLister();
	$NL->table 						= 	"news";
	$NL->maxNo						=	$settingsArray["max_latest_news"];
	$newsInfoArray["latest"]		= 	$NL->getPages();	
	
	//get list of latest blog items
	$BL = new pageLister();
	$BL->table 						= 	"blog";
	$BL->maxNo						=	$settingsArray["max_latest_blog"];
	$blogInfoArray["latest"]		= 	$BL->getPages();	
	
	//get breadcrumbs
	$CRUMB = new CRUMBhandler();
	$CRUMB->homePath				=	$homePath;
	$CRUMB->pageName				=	$pageName;
	$CRUMB->sections				=	$sections;
	$pageInfoArray["breadcrumbs"]	=	$CRUMB->getCRUMBS();
	
	//get bricks
	$BRICKS = new BRICKhandler();
	$BRICKS->pageInfoArray 			=	$pageInfoArray;
	$BRICKS->brickInfoArray 		=	$brickInfoArray;
	$brickInfoArray					=	$BRICKS->getBricks(); 
	
	switch($table){
		
		//-----only pages-----//
		case "pages":	
		//get subcats
		$SUBCATS = new SUBCAThandler();
		$SUBCATS->pageUrl			=	$pageUrl;
		$SUBCATS->pageInfoArray		=	$pageInfoArray;
		$pageInfoArray				=	$SUBCATS->getSubcats();
		break;
		
		//-----only blog-----//
		case "blog":
		//get comments
		$COMMENTS = new CMNThandler();
		$COMMENTS->pageInfoArray 	= 	$pageInfoArray;
		$pageInfoArray				=	$COMMENTS->getComments();
		
		//get list of blog items
		$BL = new pageLister();
		$BL->table 					= 	"blog";
		$BL->posts 					= 	$_POST;
		$BL->paging 				= 	true;
		$BL->settingsArray 			= 	$settingsArray;
		$blogInfoArray["pages"]		= 	$BL->getPages();
		$settingsArray				=	$BL->getSettings();
		
		//get blog nav
		$BL->blogMenu 				= 	true;
		$BL->paging 				= 	false;
		$blogInfoArray["menu"]		= 	$BL->getPages();
		break;	
		
		//-----only news-----//
		case "news":

		//get list of news items
		$NL = new pageLister();
		$NL->table 					= 	"news";
		$NL->posts 					= 	$_POST;
		$NL->paging 				= 	true;
		$NL->settingsArray 			= 	$settingsArray;
		$newsInfoArray["pages"]		= 	$NL->getPages();
		$settingsArray				=	$NL->getSettings();	
		
		//get news nav
		$NL->newsMenu 				= 	true;
		$NL->paging 				= 	false;
		$newsInfoArray["menu"]		= 	$NL->getPages();	
		break;	
		
	}
	
	//set smarty paths
	$CMS->template_dir		= 	"theme/".$settingsArray["theme"];
	$CMS->compile_dir 		= 	"system/lib/php/smarty/compile";
	break;
	
}

//handle messages
//remember to add exit after header is set so messages are not lost
$MSG = new MSGhandler();
$messages	=	$MSG->getMessages();

//get downloads
$DL = new DLhandler();
$DL->pageInfoArray		=	$pageInfoArray;
$DL->table				=	$table;
$pageInfoArray			=	$DL->getDownloads();

//get images
$IMG = new IMGhandler();
$IMG->pageInfoArray		=	$pageInfoArray;
$pageInfoArray			=	$IMG->getImages();

//send user to site info
$siteInfoArray["user"] 		=	$user;
$siteInfoArray["user_type"] =	$userType;

//assign paths
$CMS->assign("THEME_PATH",$homePath."/theme/".$settingsArray["theme"]);
$CMS->assign("THEME","theme/".$settingsArray["theme"]);
$CMS->assign("HOME",$homePath);
$CMS->assign("ADMIN_HOME",$homePath."/admin");
$CMS->assign("ADMIN_PATH",$homePath."/system/admin_templates");

//handle modules
$MODULE = new MODhandler();
$MODULE->homePath 		= $homePath;
$MODULE->siteInfoArray 	= $siteInfoArray;
$MODULE->navInfoArray 	= $navInfoArray;
$MODULE->pageInfoArray 	= $pageInfoArray;
$MODULE->blogInfoArray 	= $blogInfoArray;
$MODULE->newsInfoArray 	= $newsInfoArray;
$MODULE->brickInfoArray = $brickInfoArray;
$MODULE->settingsArray 	= $settingsArray;
$MODULE->installModules();
$moduleInfoArray		= $MODULE->getModules();

//catch all php errors up to the point and display them neatly at bottom of page
if($settingsArray["custom_errors"]){
	$phpErrors = $ERRhandler->getErrors();
	$phpErrors = $ERRhandler->parseErrors($phpErrors);
	if($phpErrors)
		echo $phpErrors;
}	

//display main.tpl and assign vars if page exists in db, build custom if not, 404 if page not found
$BUILD = new PAGEbuilder();
$BUILD->CMS				= $CMS;
$BUILD->homePath		= $homePath;
$BUILD->area			= $area;
$BUILD->pageInfoArray 	= $pageInfoArray;
$BUILD->navInfoArray 	= $navInfoArray;
$BUILD->siteInfoArray 	= $siteInfoArray;
$BUILD->blogInfoArray 	= $blogInfoArray;
$BUILD->newsInfoArray 	= $newsInfoArray;
$BUILD->moduleInfoArray = $moduleInfoArray;
$BUILD->brickInfoArray  = $brickInfoArray;
$BUILD->settingsArray 	= $settingsArray;
$BUILD->messages 		= $messages;
$BUILD->buildPage();

//close db connection
$DB->close();

?>