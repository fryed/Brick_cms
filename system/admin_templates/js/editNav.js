//----------DRAGABLE EDITABLE NAV PLUGIN----------//

$.fn.editNav = function(options){
	
	var defaults = {
		addPause 	: 2000,
		debug 		: false
	}
	
	var options = $.extend(defaults,options);
	
	return this.each(function(){
		
		//set main vars
		var element = $(this);
		var li = element.find("li");
		var liHeight = li.outerHeight();
		
		//add editing class
		element.addClass("editing");
		
		//expand all subnavs and set el height
		element.find(".subNav").show();
		//get element height
		var elHeight = element.height();
		//element.css("height",elHeight);

		//stop the links working
		element.find("a").click(function(e){
			e.preventDefault();
		});
		
		//add delete
		li.each(function(){
			$(this).find("> a").after("<span class='delete'>x</span>");
		});
		
		//change markup
		markup(li);
		
		//update the parents and order
		updateOrder();
		updateParents();
		
		//-----handle dragging-----//
		
		//log mouse up and mouse down
		options.mousedown = false;
		
		//handle mousedown
		element.find("li").live("mousedown",function(e){
			e.preventDefault();
			if(!$(e.target).is(".delete")){
				options.mousedown = true;
				//element.find("li").removeClass("lastMoved");
				if(!options.li){
					options.li = $(this);
				}
				var offset = element.offset();
				var top = e.pageY - offset.top - (liHeight/2);
				options.li.clone().appendTo(element).addClass("dragger").css("top",top);
				options.li.hide().addClass("moving");
			}
		});
		
		//drag a menu item
		$(document).mousemove(function(e){
			e.preventDefault();
			if(options.mousedown){
				var dragger = element.find(".dragger");
				var offset = element.offset();
				var top = e.pageY - offset.top - (liHeight/2);
				dragger.css("top",top);
			}
		});
		
		//make space and add child
		$(document).mousemove(function(e){
			if(options.mousedown && options.li){
				element.find("li").not(".spacer").not(".moving").not(".deleted").not(".dragger").each(function(){
					var liOffset = $(this).offset();
					var height = $(this).outerHeight();
					var dragOffset = element.find(".dragger").offset();
					if(dragOffset.top >= liOffset.top+(height/2) && dragOffset.top <= liOffset.top+height+(height/2)){
						var isSpacer = $(this).next(".spacer").length;
						if(isSpacer == 0){
							var el = $(this);
							var spacer = "<li class='spacer' style='height:"+liHeight+"px;'></li>";
							el.after(spacer);
							element.find(".spacer").slideDown(100);
							
							//handle adding child li to submenu
							clearTimeout(options.timer);
							options.timer = setTimeout(function(){
								var newLi = element.find(".dragger").clone().removeClass("dragger").addClass("lastMoved");
								element.find(".dragger,.spacer").remove();
								var hasUl = el.next("ul").length;
								if(hasUl == 0){
									el.append("<ul class='subNav'></ul>");
									ul = el.find("ul");
								}else{
									ul = el.next("ul");
								}
								ul.append(newLi);
								options.li.remove();
								li = element.find("li");
								markup(li);
								updateOrder();
								updateParents();
								options.li = false;
							},options.addPause);
							return;
						
						}
					}else{
						$(this).next(".spacer").slideUp(100,function(){
							$(this).remove();
						});
					}
				});
			}
		});
		
		//handle mouseup 
		$(document).mouseup(function(e){
			e.preventDefault()
			clearTimeout(options.timer);
			options.mousedown = false;
			var isSpace = element.find(".spacer").length;
			if(options.li){
				if(isSpace == 0){
					element.find(".dragger").remove();
					options.li.slideDown(100).removeClass("moving");
				}else{
					var newLi = element.find(".dragger").clone().removeClass("dragger").addClass("lastMoved");
					options.li.remove();
					element.find(".spacer:first").after(newLi);
					element.find(".dragger,.spacer").remove();
					updateOrder();
					updateParents();
				}
				options.li = false;
			}
		});
		
		//-----handle deleting-----//
		
		element.find("span.delete").live("click",function(){
			var li = $(this).parent("li");
			li.slideUp(100).addClass("deleted").find("> .inputHolder input.delete").attr("checked",true);
		});
		
		//-----handle updating inputs-----//
		
		//update order
		function updateOrder(){
			element.find("li").each(function(i){
				i++;
				var li = $(this);
				li.find("input.order").val(i);
			});
		}
		
		//update parents
		function updateParents(){
			element.find("> li input.parent").val(">-1");
			element.find("ul").each(function(){
				var id = $(this).prev("li").find("> .inputHolder").attr("data-id");
				var url = $(this).prev("li").find("> .inputHolder").attr("data-url");
				$(this).find("> li").each(function(){
					var li = $(this);
					li.find("input.parent").val("").val(url+">"+id);
				});
			});
		}
		
		//-----handle saving order-----//
		
		//on submit
		$(".update").click(function(e){
			if(options.debug){
				e.preventDefault();
				element.find("li").each(function(){
					var name = $(this).find("> a").text();
					var order = $(this).find("> .inputHolder input.order").val();
					var parent = $(this).find("> .inputHolder input.parent").val();				
					var deleted = $(this).find("> .inputHolder input.delete").attr("checked");				
					var result = name+" - "+order+" - "+parent+" - "+deleted;
					console.log(result);
				});
			}
		});
		
		//-----redo markup-----//
		
		function markup(li){
			//tidy up empty uls
			ul = element.find("ul");
			ul.each(function(){
				var hasChildren = $(this).find("li").length;
				if(hasChildren == 0){
					$(this).remove();
				}
			});
			//sort out remaining html
			li.each(function(i){
				var ul = $(this).find("> ul");
				var isUl = ul.length;
				if(isUl > 0){
					ul.each(function(){
						var newUl = $(this).clone().addClass("cloned");
						$(this).remove();
						element.find("li:eq("+i+")").after(newUl)
					});
				}
			});
			//more tidying
			element.find("li ul").remove();
		}
		
	});
	
}
