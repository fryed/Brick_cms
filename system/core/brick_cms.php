<?php 
//-----INCLUDE ALL THE CORE FILES-----//

//get config file
require_once("system/config/config.php");

//custom error handler 
require_once("system/core/custom_error_handler.php");

//check to see if DB exists. create if not
require_once("system/core/setup.php");

//load DB connect class
require_once("system/core/db_connect.php");

//get site settings
require_once("system/core/site_settings.php");

//handle caching
require_once("system/core/cache_handler.php");

//load uri controller class
require_once("system/core/uri_controller.php");

//strip posts class
require_once("system/core/strip_posts.php");

//validate posts class
require_once("system/core/validator.php");

//handle logging in
require_once("system/core/log_check.php");

//handle all posts
require_once("system/core/post_handler.php");

//load nav builder class
require_once("system/core/nav_builder.php");

//load custom builder class
require_once("system/core/custom_builder.php");

//load page builder class
require_once("system/core/page_builder.php");

//get site info
require_once("system/core/site_info.php");

//handle images
require_once("system/core/img_handler.php");

//handle downloads
require_once("system/core/dl_handler.php");

//handle links
require_once("system/core/link_handler.php");

//handle comments
require_once("system/core/comment_handler.php");

//handle sub-catagories
require_once("system/core/subcat_handler.php");

//load admin builder class
require_once("system/core/admin_builder.php");

//handle outputting all pages
require_once("system/core/page_lister.php");

//load directory reader class
require_once("system/core/dir_reader.php");

//handle messages class
require_once("system/core/msg_handler.php");

//handle search results
require_once("system/core/search_handler.php");

//handle site features
require_once("system/core/feature_handler.php");

//handle uploads class
require_once("system/core/upload_handler.php");

//handle breadcrumbs class
require_once("system/core/crumb_handler.php");

//handle analytics
require_once("system/core/analytics.php");

//handle modules
require_once("system/core/module_handler.php");

//handle bricks
require_once("system/core/brick_handler.php");

//load smarty class
require_once("system/lib/php/smarty/libs/Smarty.class.php");

//load up system
require_once("system/core/system.php");

?>