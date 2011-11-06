//----------DRAGABLE EDITABLE NAV PLUGIN----------//

$.fn.editNav = function(options){
	
	var defaults = {
		addPause : 2000
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
		element.find(".subNav").slideDown(100,function(){
			//get element height
			var elHeight = element.height();
			element.css("height",elHeight);
		});

		//stop the links working
		element.find("a").click(function(e){
			e.preventDefault();
		});
		
		//add delete
		li.each(function(){
			$(this).find("> a").after("<span class='delete'>x</span>");
		});
		
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
		
		//make space
		$(document).mousemove(function(e){
			if(options.mousedown && options.li){
				element.find("li").not(".spacer").not(".moving").not(".deleted").each(function(){
					var liOffset = $(this).offset();
					var height = $(this).outerHeight();
					var dragOffset = element.find(".dragger").offset();
					if(dragOffset.top >= liOffset.top+(height/2) && dragOffset.top <= liOffset.top+height+(height/2)){
						var isSpacer = element.find(".spacer").length;
						if(isSpacer == 0){
							var el = $(this);
							var spacer = "<li class='spacer' style='height:"+liHeight+"px;'></li>";
							element.find("li").removeClass("over");
							el.addClass("over").after(spacer);
							element.find(".spacer").slideDown(100);
							options.timer = setTimeout(function(){
								var hasUl = el.find("ul").length;
								if(hasUl == 0){
									el.append("<ul></ul>").removeClass("over");
								}
								var newLi = element.find(".dragger").clone().removeClass("dragger").addClass("lastMoved");
								element.find(".dragger,.spacer").remove();
								options.li.remove();
								el.find("ul").append(newLi);
								updateOrder();
								updateParents();
								options.li = false;
							},options.addPause);
						}
					}else{
						$(this).removeClass("over").next(".spacer").slideUp(100,function(){
							$(this).remove();
							clearTimeout(options.timer);
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
					element.find(".dragger,.spacer").remove();
					options.li.remove();
					element.find(".over").removeClass("over").after(newLi);
					updateOrder();
					updateParents();
				}
				options.li = false;
			}
		});
		
		//-----handle deleting-----//
		
		element.find("span.delete").live("click",function(){
			var li = $(this).parent("li");
			li.slideUp(100).addClass("deleted").find("input:checkbox").attr("checked",true);
		});
		
		//-----handle updating inputs-----//
		
		//update order
		function updateOrder(){
			element.find("li").each(function(i){
				i++;
				var li = $(this);
				li.find("input[name='order']").val(i);
			});
		}
		
		//update parents
		function updateParents(){
			element.find("> li input[name='parent']").val(0);
			element.find("ul").each(function(){
				var name = $(this).parent("li").find("> a").text();
				$(this).find("> li").each(function(){
					var li = $(this);
					li.find("input[name='parent']").val(name);
				});
			});
		}
		
		//-----handle saving order-----//
		
		//on submit
		$(".update").click(function(){
			var result = "<br class='clearBoth'/><p>";
			element.find("li").each(function(){
				var name = $(this).find("> a").text();
				var order = $(this).find("> input[name='order']").val();
				var parent = $(this).find("> input[name='parent']").val();				
				result = result+name+" - "+order+" - "+parent+",<br/>";
			});
			result = result+"</p>";
			$("body").append(result);
		});
		
	});
	
}
