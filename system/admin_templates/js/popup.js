//perform when page is ready
$(document).ready(function(){
	
	//setup all the main global vars
	setGlobalVars();
	
	//re-calculate dimensions on window resize
	$(window).resize(function(){
		setGlobalVars();
	});
	
});

//function to set global vars
function setGlobalVars(){
	
	window.winHeight	= $(window).height();
	window.winWidth		= $(window).width();
	window.docHeight	= $(document).height();
	window.docWidth		= $(document).width();
	
} 

//popup plugin
$.fn.popup = function(options){

	var defaults = {
		popupSpeed 		: "fast",
		overlaySpeed	: "fast",
		width			: "500px",
		type			: "ajax",
		overlayColor	: "#000"
	};
	
	var options = $.extend(defaults, options);
	
	return this.each(function(){
		
		$(this).each(function(){
			var href = $(this).attr("href");
			$(href).hide("");
		});
	
		$(this).click(function(e){
			e.preventDefault();
			var element = $(this);
			if(options.type == "ajax"){
				var href = element.attr("href");
				var title = element.attr("title");
				var hasAnchor = href.lastIndexOf("#");
				$.get(href,function(content){
					if(hasAnchor != -1){
						hrefArray = href.split("#");
						id = "#"+hrefArray[1];
						content = $(content).filter(id).html();
					}	
					openOverlay(options.overlaySpeed,options.overlayColor,function(){
						openPopup(options.popupSpeed,title,content,options.width);
					});	
				});
			}else if(options.type == "image"){
				var title = element.attr("alt");
				var src = element.attr("src");
				image = "<img class='inVisible' src='"+src+"'/>";
				var content = "\
					<div id='imagePop'>\
						"+image+"\
						<div class='info'>\
							<span class='title'>"+title+"</span>\
							<span class='close'></span>\
						</div>\
					</div>\
				";
				openOverlay(options.overlaySpeed,options.overlayColor,function(){
					openPopup(options.popupSpeed,title,content,options.width,function(){
						$("#popup").addClass("lightBox");
						$("#popup img").css("visibility","visible");
					});
				});	
			}
		});
		
		$("#popup .close, .overlay").live("click",function(){
			closePopup(options.popupSpeed,function(){
				closeOverlay(options.overlaySpeed);
			});
		});
		
	});
	
}

//confirm plugin
$.fn.confirm = function(options){

	var defaults = {
		question 		: "Are you sure?",
		buttonPos		: "yes",
		buttonNeg		: "no",
		callback		: function callback(){},
		popupSpeed 		: "fast",
		overlaySpeed	: "fast",
		width			: "200px",
		callback		: false
	};
	
	var options = $.extend(defaults, options);
	
	return this.each(function(){
	
		$(this).click(function(e){
			e.preventDefault();
			var element = $(this);
			var href = element.attr("href");
			var title = element.attr("title");
			var content = "<p>"+options.question+"</p>\
			<br class='clearBoth'/>\
			<input type='button' class='neg' value='"+options.buttonNeg+"' name='false'/>\
			<input type='button' class='pos' value='"+options.buttonPos+"' name='true'/>\
			<br class='clearBoth'/>";
			openOverlay(options.overlaySpeed,options.overlayColor,function(){
				openPopup(options.popupSpeed,title,content,options.width);
				$(".popupContent").addClass("confirmDialogue");
				$("#popup .close").remove();
			});		
		});
		
		$("#popup input:button").live("click",function(){
			if($(this).attr("name") == "true")
				answer = true;
			else
				answer = false;	
			closePopup(options.popupSpeed,function(){
				closeOverlay(options.overlaySpeed,function(){
					options.callback(answer);
				});
			});
		});
		
	});
	
}		

//function to open overlay
function openOverlay(speed,color,callback){
	
	$("body").append("<div class='overlay'></div>");
	$(".overlay").css({
		"width"			:	window.docWidth,
		"height"		:	window.docHeight,
		"background"	: 	color
	}).animate({
		opacity		:	0.8
	},1,function(){
		$(".overlay").fadeIn(speed,function(){
			if(callback)
				callback();
		});
	});
	
}

//function to close overlay
function closeOverlay(speed,callback){
	
	$(".overlay").fadeOut(speed,function(){
		$(".overlay").remove();
		if(callback)
			callback();
	});
	
}

//function to open a popup
function openPopup(speed,title,content,width,callback){
	
	$("body").append("<div id='popup'>\
		<div class='popupHeader'>\
			<span class='close'>close</span>\
			<h2>"+title+"</h2>\
		</div>\
		<div class='popupContent'>"+content+"</div>\
	</div>");
	
	if(width)
		$("#popup").css("width",width);
	
	var left 	= window.winWidth/2 - $("#popup").width()/2;
	var top 	= (window.winHeight/2 - $("#popup").height()/2) + $(window).scrollTop();
	
	$("#popup").css({
		"top"	:	top,
		"left"	:	left
	}).fadeIn(speed,function(){
		if(callback)
			callback();
	});
	
}

//function to close popup
function closePopup(speed,callback){
	
	$("#popup").fadeOut(speed,function(){
		$("#popup").remove();
		if(callback)
			callback();
	});
	
}

//for testing
function test(){
	alert("test succeeded");
}