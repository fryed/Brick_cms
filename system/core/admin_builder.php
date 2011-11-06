<?php 
//-----HANDLES CUSTOM ADMIN PAGES IE. ONES THAT ARE NOT STORED IN DB-----//

class ADMINbuilder extends DBconnect {
	 	
	//set vars 
	var $pageUrl;
	var $pageInfoArray;
	var $siteInfoArray;
	var $newsInfoArray;
	var $blogInfoArray;
	var $brickInfoArray;
	var $settingsArray;
	var $pageName;
	var $theme;
	
	//run main function
	public function buildAdmin() {
		
		switch ($this->pageUrl) {
			
			case "/login":
				$this->pageInfoArray["template"]	=	"login.tpl";
				$this->pageInfoArray["title"]		=	"Login";
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/dashboard":
				$this->pageInfoArray["template"]	=	"dashboard.tpl";
				$this->pageInfoArray["title"]		=	"Dashboard";
				$this->pageInfoArray["active"]		=	"dashboard";
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/create":
				$this->pageInfoArray["template"]	=	"create-page.tpl";
				$this->pageInfoArray["title"]		=	"Create page";
				$this->pageInfoArray["active"]		=	"pages";
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/pages":
				$this->pageInfoArray["template"]	=	"pages.tpl";
				$this->pageInfoArray["title"]		=	"Pages";
				$this->pageInfoArray["active"]		=	"pages";
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/galleries":
				$this->pageInfoArray["template"]	=	"galleries.tpl";
				$this->pageInfoArray["title"]		=	"Galleries";
				$this->pageInfoArray["active"]		=	"site";
				$IMG = new IMGhandler();
				$IMG->galleryArray					=	$this->siteInfoArray["galleries"];
				$this->siteInfoArray["galleries"]	=	$IMG->getImage();
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/galleries/".$this->pageName:
				$params								=	"WHERE url = '$this->pageUrl'";
				$this->pageInfoArray 				= 	DBconnect::query("*","galleries",$params);
				$galleryId							=	$this->pageInfoArray["id"];
				$params								=	"WHERE belongs_to = '$galleryId'";	
				$this->pageInfoArray["images"] 		= 	DBconnect::queryArray("*","images",$params);
				$this->pageInfoArray["template"]	=	"gallery.tpl";
				$this->pageInfoArray["title"]		=	$this->pageName." gallery";
				$this->pageInfoArray["active"]		=	"site";
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/users":
				$this->siteInfoArray["users"] 		= 	DBconnect::queryArray("*","users","");
				$this->pageInfoArray["template"]	=	"users.tpl";
				$this->pageInfoArray["title"]		=	"Users";
				$this->pageInfoArray["active"]		=	"site";
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/settings":
				$this->pageInfoArray["template"]	=	"settings.tpl";
				$this->pageInfoArray["title"]		=	"Settings";
				$this->pageInfoArray["active"]		=	"settings";
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/feature":
				$FEAT = new FEAThandler();
				$FEAT->siteInfoArray				=	$this->siteInfoArray;
				$this->siteInfoArray				=	$FEAT->getFeatures();
				$this->pageInfoArray["template"]	=	"feature.tpl";
				$this->pageInfoArray["title"]		=	"Feature area";
				$this->pageInfoArray["active"]		=	"site";
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/links":
				$LINK = new LINKhandler();
				$LINK->siteInfoArray				=	$this->siteInfoArray;
				$this->siteInfoArray				=	$LINK->getLinks();
				$this->pageInfoArray["template"]	=	"links.tpl";
				$this->pageInfoArray["title"]		=	"Links";
				$this->pageInfoArray["active"]		=	"site";
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/inbox":
				$this->pageInfoArray["messages"]	=	DBconnect::queryArray("*","messages","ORDER BY sent DESC");
				$this->pageInfoArray["template"]	=	"inbox.tpl";
				$this->pageInfoArray["title"]		=	"Inbox";
				$this->pageInfoArray["active"]		=	"inbox";
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/inbox/".$this->pageName:
				$params								=	"WHERE id = '$this->pageName'";
				$this->pageInfoArray["message"]		=	DBconnect::query("*","messages",$params);
				$this->pageInfoArray["template"]	=	"message.tpl";
				$this->pageInfoArray["title"]		=	"Inbox";
				$this->pageInfoArray["active"]		=	"inbox";
				$this->pageInfoArray["custom"]		=	true;
				DBconnect::update("messages","status","read",$params);
			break;
			
			case "/news":
				$NL = new pageLister();
				$NL->table 							= 	"news";
				$NL->posts 							= 	$_POST;
				$NL->paging 						= 	true;
				$NL->settingsArray 					= 	$this->settingsArray;
				$this->newsInfoArray["pages"]		= 	$NL->getPages();	
				$this->settingsArray				= 	$NL->getSettings();	
				$params								=	"WHERE url = '/news'";
				$this->pageInfoArray 				= 	DBconnect::query("*","news",$params);
				$this->pageInfoArray["active"]		=	"news";
				$this->pageInfoArray["template"]	=	"news.tpl";
				$this->pageInfoArray["section"]		=	"/news";
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/news/create":
				$this->pageInfoArray["title"]		=	"Create article";
				$this->pageInfoArray["active"]		=	"news";
				$this->pageInfoArray["template"]	=	"create-news.tpl";
				$this->pageInfoArray["section"]		=	"/news";
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/news/".$this->pageName:
				$url 								=	$this->pageUrl;
				$params								=	"WHERE url = '$url'";
				$this->pageInfoArray 				= 	DBconnect::query("*","news",$params);
				$this->pageInfoArray["template"]	=	"edit-news.tpl";
				$this->pageInfoArray["active"]		=	"news";
				$this->pageInfoArray["section"]		=	"/news";
				$this->pageInfoArray["custom"]		=	false;
			break;
			
			case "/blog":
				$BL = new pageLister();
				$BL->table 							= 	"blog";
				$BL->posts 							= 	$_POST;
				$BL->paging 						= 	true;
				$BL->settingsArray 					= 	$this->settingsArray;
				$this->blogInfoArray["pages"]		= 	$BL->getPages();	
				$this->settingsArray				= 	$BL->getSettings();
				$this->siteInfoArray["categories"]  =	DBconnect::queryArray("*","blog_categories","");	
				$params								=	"WHERE url = '/blog'";
				$this->pageInfoArray 				= 	DBconnect::query("*","blog",$params);
				$this->pageInfoArray["active"]		=	"blog";
				$this->pageInfoArray["template"]	=	"blog.tpl";
				$this->pageInfoArray["section"]		=	"/blog";
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/blog/create":
				$this->siteInfoArray["categories"]  =	DBconnect::queryArray("*","blog_categories","");	
				$this->pageInfoArray["title"]		=	"Create article";
				$this->pageInfoArray["active"]		=	"blog";
				$this->pageInfoArray["template"]	=	"create-blog.tpl";
				$this->pageInfoArray["section"]		=	"/blog";
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/blog/".$this->pageName:
				$this->siteInfoArray["categories"]  =	DBconnect::queryArray("*","blog_categories","");	
				$url 								=	$this->pageUrl;
				$params								=	"WHERE url = '$url'";
				$this->pageInfoArray 				= 	DBconnect::query("*","blog",$params);
				$id									=	$this->pageInfoArray["id"];
				$params								=	"WHERE belongs_to = '$id'";
				$this->pageInfoArray["comments"]	=	DBconnect::queryArray("*","blog_comments",$params);
				$this->pageInfoArray["active"]		=	"blog";
				$this->pageInfoArray["template"]	=	"edit-blog.tpl";
				$this->pageInfoArray["section"]		=	"/blog";
				$this->pageInfoArray["custom"]		=	false;
			break;
			
			case "/bricks":
				//get list of bricks from db
				$this->pageInfoArray["bricks"]		=	DBconnect::queryArray("*","bricks","");	
				$this->pageInfoArray["template"]	=	"bricks.tpl";
				$this->pageInfoArray["title"]		=	"Bricks";
				$this->pageInfoArray["active"]		=	"bricks";
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/bricks/".$this->pageName:
				$name 								=	$this->pageName;
				$params								=	"WHERE brick_name = '$name'";
				$this->pageInfoArray 				= 	DBconnect::query("*","bricks",$params);
				$this->pageInfoArray["template"]	=	"brick.tpl";
				$this->pageInfoArray["active"]		=	"bricks";
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/modules":
				//get list of modules from db
				$this->pageInfoArray["modules"]		=	DBconnect::queryArray("*","modules","");	
				$this->pageInfoArray["template"]	=	"modules.tpl";
				$this->pageInfoArray["title"]		=	"Modules";
				$this->pageInfoArray["active"]		=	"modules";
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/modules/".$this->pageName:
				$this->pageInfoArray["template"]	=	"../../modules/".$this->pageName."/".$this->pageName.".admin.tpl";
				$this->pageInfoArray["module"]		=	$this->pageName;
				$this->pageInfoArray["title"]		=	str_replace("_"," ",$this->pageName);
				$this->pageInfoArray["active"]		=	"modules";
				$this->pageInfoArray["custom"]		=	true;
			break;
				
			case "/guarddog":
				$this->pageInfoArray["template"]	=	"guard-dog.tpl";
				$this->pageInfoArray["title"]		=	"Guard dog";
				$this->pageInfoArray["custom"]		=	true;
			break;
			
			case "/maintenance":
				$this->pageInfoArray["template"]	=	"maintenance.tpl";
				$this->pageInfoArray["title"]		=	"Maintenance";
				$this->pageInfoArray["custom"]		=	true;
			break;
				
		}

		//define page section if not set
		if(!isset($this->pageInfoArray["section"])){
			$this->pageInfoArray["section"] = null;
		}
		
		//define active if not set
		if(!isset($this->pageInfoArray["active"])){
			$this->pageInfoArray["active"] = "pages";
		}

	}
	
	//return page info
	public function getPageInfo(){

		return $this->pageInfoArray;		
		
	}
	
	//return site info
	public function getSiteInfo(){

		return $this->siteInfoArray;		
		
	}
	
	//return blog info
	public function getBlogInfo(){

		return $this->blogInfoArray;		
		
	}
	
	//return news info
	public function getNewsInfo(){

		return $this->newsInfoArray;		
		
	}
	
	//return settings info
	public function getSettings(){

		return $this->settingsArray;		
		
	}
	
	//return brick info
	public function getBrickInfo(){

		return $this->brickInfoArray;		
		
	}
	
}	
		
?>