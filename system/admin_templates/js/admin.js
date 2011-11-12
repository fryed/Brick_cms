
//----------JS FOR BRICK ADMIN----------//

//-----document ready-----//

$(document).ready(function(){
	
	//set global vars
	window.winHeight	= $(window).height();
	window.winWidth 	= $(window).width();
	window.docHeight 	= $(document).height();
	window.docWidth 	= $(document).width();
	
	//remove nojs class from body
	$("body").removeClass("nojs");
	
	//fix for target blank
	$("a.external").attr("target","_blank");
	
	//handle cms nav
	$(".cmsNav").cmsNav();
	
	//init accordion on site nav
	$(".leftCol .mainNav").navAccordion({
		trigger : "li",
		content : ".subNav"
	});
	
	//make input fields equal width
	$(".equalInput").equalInput();
	
	//init text editor
	$("#textEditor").htmlarea();
	
	//init tabs
	$("#tabs").tabs({
		callback : function(){
			var active = $(".tabHolder").find(".activeContent");
			active.equalInput();
			active.find("#textEditor").htmlarea();
		}
	});
	
	//on page resize
	$(window).resize(function(){
		$(".equalInput").equalInput();
		$(".tabContent .activeContent").equalInput();
		$("#textEditor").htmlarea();
	});
	
	//init image popup
	$(".imageHolder img").popup({
		type : "image"
	});
	
	//init popup
	$(".popup").popup();
	
	//init slider
	$(".slider").slider({
		callback : function(){
			$(".activeContent .slider").equalInput();
		}
	});
	
	//init link toggler
	$(".toggleLink").toggleLink();
	
	//init nav editor
	$("a.editNav").click(function(e){
		e.preventDefault();
		$(this).fadeTo("fast",0,function(){
			$("input.update").fadeIn("fast");
			$(".menuPod .mainNav").editNav();
			$(this).remove();
		});
	});
	
	//init confirm popups
	$(".delete").confirm({
		width 		: "300px",
		callback 	: function(el,form,answer){
			if(answer){
				var action = el.val();
				form.append("<input type='hidden' name='action' value='"+action+"'/>")
				form.submit();
			}
		}
	});
	
});

//-----functions-----//

//--handle showing and hiding subnav--//
$.fn.cmsNav = function(){
	
	return this.each(function(){
		
		var element = $(this);
		var li 		= element.find("li");
		var overlay = "<div id='overlay'></div>";
		
		li.hover(function(){
			var subNav = $(this).find(".cmsSubNav");
			if(subNav.length > 0){
				$(this).css("z-index","101");
				subNav.show();
				$("body").append(overlay);
				$("#overlay")
					.show()
					.css({
						"width" 	: 	window.docWidth,
						"height" 	: 	window.docHeight
					})
				;
			}		
		},function(){
			var subNav = $(this).find(".cmsSubNav");
			if(subNav.length > 0){
				$(this).css("z-index","1");
				subNav.hide();
				$("#overlay").remove();
			}	
		});
		li.mouseover(function(){
			$(this).trigger("hover");
		});
		
	});
	
}

//--accordion nav--//
$.fn.navAccordion = function(options){
	
	var defaults = {
		trigger	: "li",
		content : ".subNav"
	}
	
	var options = $.extend(defaults,options);  
	
	return this.each(function(){
		
		var element = $(this);
		var content = element.find(options.content);
		var trigger = element.find(options.trigger);
		var openOn	= window.location.hash;
		var active	= element.find(".active");
		
		//hide the content
		content.hide();
		
		//add the clicker to the trigger
		trigger.each(function(i){
			//add clicker
			var clicker 	= "<span class='clicker'>+</span>";
			$(this).prepend(clicker);
		});
		var clicker = trigger.find(".clicker"); 
		
		//handle clicks
		clicker.click(function(){
			var isOpen = $(this).hasClass("open");
			var parent = $(this).parent(options.trigger); 
			if(isOpen){
				$(this)
					.removeClass("open")
					.text("+")
				;
				parent.find("> "+options.content).slideUp("fast");
			}else{	
				$(this)
					.addClass("open")
					.text("-")
				;
				parent.find("> "+options.content).slideDown("fast");
			}
		});
		
		//show active trail
		var parents = active.parents(".hasChildren");
		parents.find(".clicker").trigger("click");
		
	});
	
}

//--make inputs and selects equal widths--//
$.fn.equalInput = function(options){
	
	var options = new Object;
	
	return this.each(function(){
		
		var element 	= $(this);
		var width 		= element.width();
		var label		= element.find("label");

		options.labelWidth = 0;
		label.each(function(){
			$(this).css("width","auto");
			var labelWidth = $(this).width();
			if(labelWidth >= options.labelWidth){
				options.labelWidth = labelWidth;
			}
		});
		
		var inputWidth = width - options.labelWidth - 30;
		
		label.css("width",options.labelWidth);
		element.find("select").css("width",inputWidth+18); 
		element
			.find("input, textarea, .jHtmlArea")
			.not("input:checkbox, input:radio, input:submit")
			.css("width",inputWidth)
		; 
		
	});
	
}

//--tabs function--//
$.fn.tabs = function(options){
	
	var defaults = {
		openOn 		: 1,
		callback 	: null
	}
	
	var options = $.extend(defaults,options);
	
	return this.each(function(){
		
		var element = $(this);
		var tabs	= element.find("li a");
		var hash	= window.location.hash;
		
		//add layout
		element.wrap("<div class='tabHolder'></div>");
		var holder = element.parent(".tabHolder");
		holder.append("\
			<br class='clearBoth'/>\
			<div class='innerTabHolder'>\
				<div class='tabContent'>\
					<div class='innerTabs'></div>\
				</div>\
			</div>\
		");
		var content = holder.find(".tabContent .innerTabs");
		
		//hide all tabs then populate tab content
		tabs.each(function(){
			var id = $(this).attr("href");
			
			//unload editor
			var isEditor = $(id).find("#textEditor");
			if(isEditor.length > 0){
				$(id).find("#textEditor").htmlarea("dispose");
			}
			
			var clone = $(id).clone().addClass("tab");
			$(id).remove();
			clone.hide().appendTo(content);
		});
		
		//open a default tab
		if(hash != ""){
			content.find(hash).show().addClass("activeContent");
			element.find("a[href='"+hash+"']").parent("li").addClass("active");
		}else{
			content.find(".tab:nth-child(1)").show().addClass("activeContent");
			element.find("li:nth-child(1)").addClass("active");
		}
		if(options.callback){
			options.callback();
		}
		
		//handle clicks
		tabs.click(function(e){
			e.preventDefault();
			tabs.parent("li").removeClass("active");
			$(this).parent("li").addClass("active");
			var id = $(this).attr("href");
			window.location.hash = id;
			content.find(".tab").hide().removeClass("activeContent");
			$(id).show().addClass("activeContent");
			if(options.callback){
				options.callback();
			}
		});
		
	});
	
}

//--slider function--//
$.fn.slider = function(options){
	
	var defaults = {
		callback 	: null
	}
	
	var options = $.extend(defaults,options);
	
	return this.each(function(){
		
		//set vars
		var element = $(this);
		//add open link and hide
		element.hide().before("<a href='#' class='toggleSlide'>Edit</a>");
		//define clicker
		var clicker = element.prev(".toggleSlide");
		//on click
		clicker.click(function(e){
			//prevent default
			e.preventDefault();
			//set clicker text
			var text = $(this).text();
			if(text == "Edit"){
				text = "Close";
			}else{
				text = "Edit";
			}
			$(this).text(text);
			//show slider
			$(this).next(".slider").slideToggle("slow");
			if(options.callback){
				options.callback();
			}
		});
		
	});
	
}

//--toggle link function--//
$.fn.toggleLink = function(){
	
	return this.each(function(){
		
		//set vars
		var element = $(this);
		//run showhide
		showHide();
		//on click
		element.click(function(){
			showHide();
		});
		function showHide(){
			//get checked
			var checked = element.attr("checked");
			//show and hide
			if(checked){
				$(".externalLink").show();
				$(".internalLink").hide();				
			}else{
				$(".externalLink").hide();
				$(".internalLink").show();	
			}	
		}
		
	});
	
}