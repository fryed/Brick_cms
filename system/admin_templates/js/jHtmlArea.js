//jHtmlArea - http://jhtmlarea.codeplex.com - (c)2009 Chris Pietschmann
(function($){$.fn.htmlarea=function(opts){if(opts&&typeof(opts)==="string"){var args=[];for(var i=1;i<arguments.length;i++){args.push(arguments[i]);}
var htmlarea=jHtmlArea(this[0]);var f=htmlarea[opts];if(f){return f.apply(htmlarea,args);}}
return this.each(function(){jHtmlArea(this,opts);});};var jHtmlArea=window.jHtmlArea=function(elem,options){if(elem.jquery){return jHtmlArea(elem[0]);}
if(elem.jhtmlareaObject){return elem.jhtmlareaObject;}else{return new jHtmlArea.fn.init(elem,options);}};jHtmlArea.fn=jHtmlArea.prototype={jhtmlarea:"0.7.0",init:function(elem,options){if(elem.nodeName.toLowerCase()==="textarea"){var opts=$.extend({},jHtmlArea.defaultOptions,options);elem.jhtmlareaObject=this;var textarea=this.textarea=$(elem);var container=this.container=$("<div/>").addClass("jHtmlArea").width(textarea.width()).insertAfter(textarea);var toolbar=this.toolbar=$("<div/>").addClass("ToolBar").appendTo(container);priv.initToolBar.call(this,opts);var iframe=this.iframe=$("<iframe/>").height(textarea.height());iframe.attr("id","jHtmlIframe");iframe.width(textarea.width()-($.browser.msie?0:4));var htmlarea=this.htmlarea=$("<div/>").append(iframe);container.append(htmlarea).append(textarea.hide());priv.initEditor.call(this,opts);priv.attachEditorEvents.call(this);iframe.height(iframe.height()-toolbar.height());toolbar.width(textarea.width()-2);if(opts.loaded){opts.loaded.call(this);}}},dispose:function(){this.textarea.show().insertAfter(this.container);this.container.remove();this.textarea[0].jhtmlareaObject=null;},execCommand:function(a,b,c){this.iframe[0].contentWindow.focus();this.editor.execCommand(a,b||false,c||null);this.updateTextArea();},ec:function(a,b,c){this.execCommand(a,b,c);},queryCommandValue:function(a){this.iframe[0].contentWindow.focus();return this.editor.queryCommandValue(a);},qc:function(a){return this.queryCommandValue(a);},getSelectedHTML:function(){if($.browser.msie){return this.getRange().htmlText;}else{var elem=this.getRange().cloneContents();return $("<p/>").append($(elem)).html();}},getSelection:function(){if($.browser.msie){return this.editor.selection;}else{return this.iframe[0].contentDocument.defaultView.getSelection();}},getRange:function(){var s=this.getSelection();if(!s){return null;}
return(s.getRangeAt)?s.getRangeAt(0):s.createRange();},html:function(v){if(v){this.pastHTML(v);}else{return toHtmlString();}},pasteHTML:function(html){this.iframe[0].contentWindow.focus();var r=this.getRange();if($.browser.msie){r.pasteHTML(html);}else if($.browser.mozilla){r.deleteContents();r.insertNode($((html.indexOf("<")!=0)?$("<span/>").append(html):html)[0]);}else{r.deleteContents();r.insertNode($(this.iframe[0].contentWindow.document.createElement("span")).append($((html.indexOf("<")!=0)?"<span>"+html+"</span>":html))[0]);}
r.collapse(false);r.select();},cut:function(){this.ec("cut");},copy:function(){this.ec("copy");},paste:function(){this.ec("paste");},bold:function(){this.ec("bold");},italic:function(){this.ec("italic");},underline:function(){this.ec("underline");},strikeThrough:function(){this.ec("strikethrough");},image:function(url){addImage(url,this);},removeFormat:function(){this.ec("removeFormat",false,[]);this.unlink();},link:function(){if($.browser.msie){this.ec("createLink",true);}else{this.ec("createLink",false,prompt("Link URL:","http://"));}},unlink:function(){this.ec("unlink",false,[]);},orderedList:function(){this.ec("insertorderedlist");},unorderedList:function(){this.ec("insertunorderedlist");},superscript:function(){this.ec("superscript");},subscript:function(){this.ec("subscript");},p:function(){this.formatBlock("<p>");},h1:function(){this.heading(1);},h2:function(){this.heading(2);},h3:function(){this.heading(3);},h4:function(){this.heading(4);},h5:function(){this.heading(5);},h6:function(){this.heading(6);},heading:function(h){this.formatBlock($.browser.msie?"Heading "+h:"h"+h);},indent:function(){this.ec("indent");},outdent:function(){this.ec("outdent");},insertHorizontalRule:function(){this.ec("insertHorizontalRule",false,"ht");},justifyLeft:function(){this.ec("justifyLeft");},justifyCenter:function(){this.ec("justifyCenter");},justifyRight:function(){this.ec("justifyRight");},increaseFontSize:function(){if($.browser.msie){this.ec("fontSize",false,this.qc("fontSize")+1);}else if($.browser.safari){this.getRange().surroundContents($(this.iframe[0].contentWindow.document.createElement("span")).css("font-size","larger")[0]);}else{this.ec("increaseFontSize",false,"big");}},decreaseFontSize:function(){if($.browser.msie){this.ec("fontSize",false,this.qc("fontSize")-1);}else if($.browser.safari){this.getRange().surroundContents($(this.iframe[0].contentWindow.document.createElement("span")).css("font-size","smaller")[0]);}else{this.ec("decreaseFontSize",false,"small");}},forecolor:function(c){this.ec("foreColor",false,c||prompt("Enter HTML Color:","#"));},formatBlock:function(v){this.ec("formatblock",false,v||null);},showHTMLView:function(){this.updateTextArea();this.textarea.show();this.htmlarea.hide();$("ul li:not(li:has(a.html))",this.toolbar).hide();$("ul:not(:has(:visible))",this.toolbar).hide();$("ul li a.html",this.toolbar).addClass("highlighted");},hideHTMLView:function(){this.updateHtmlArea();this.textarea.hide();this.htmlarea.show();$("ul",this.toolbar).show();$("ul li",this.toolbar).show().find("a.html").removeClass("highlighted");},toggleHTMLView:function(){(this.textarea.is(":hidden"))?this.showHTMLView():this.hideHTMLView();},toHtmlString:function(){return this.editor.body.innerHTML;},toString:function(){return this.editor.body.innerText;},updateTextArea:function(){this.textarea.val(this.toHtmlString());},updateHtmlArea:function(){this.editor.body.innerHTML=this.textarea.val();}};jHtmlArea.fn.init.prototype=jHtmlArea.fn;jHtmlArea.defaultOptions={toolbar:[["html"],["forecolor"],["bold","italic","underline","strikethrough","|","subscript","superscript"],["increasefontsize","decreasefontsize"],["orderedlist","unorderedlist"],["indent","outdent"],["justifyleft","justifycenter","justifyright"],["link","unlink","image","horizontalrule"],["p","h1","h2","h3","h4","h5","h6"],["cut","copy","paste"]],css:null,toolbarText:{bold:"Bold",italic:"Italic",underline:"Underline",strikethrough:"Strike-Through",cut:"Cut",copy:"Copy",paste:"Paste",h1:"Heading 1",h2:"Heading 2",h3:"Heading 3",h4:"Heading 4",h5:"Heading 5",h6:"Heading 6",p:"Paragraph",indent:"Indent",outdent:"Outdent",horizontalrule:"Insert Horizontal Rule",justifyleft:"Left Justify",justifycenter:"Center Justify",justifyright:"Right Justify",increasefontsize:"Increase Font Size",decreasefontsize:"Decrease Font Size",forecolor:"Text Color",link:"Insert Link",unlink:"Remove Link",image:"Insert Image",orderedlist:"Insert Ordered List",unorderedlist:"Insert Unordered List",subscript:"Subscript",superscript:"Superscript",html:"Show/Hide HTML Source View"}};var priv={toolbarButtons:{strikethrough:"strikeThrough",orderedlist:"orderedList",unorderedlist:"unorderedList",horizontalrule:"insertHorizontalRule",justifyleft:"justifyLeft",justifycenter:"justifyCenter",justifyright:"justifyRight",increasefontsize:"increaseFontSize",decreasefontsize:"decreaseFontSize",html:function(btn){this.toggleHTMLView();}},initEditor:function(options){var edit=this.editor=this.iframe[0].contentWindow.document;edit.designMode='on';edit.open();edit.write(this.textarea.val());edit.close();if(options.css){var e=edit.createElement('link');e.rel='stylesheet';e.type='text/css';e.href=options.css;edit.getElementsByTagName('head')[0].appendChild(e);}},initToolBar:function(options){var that=this;var menuItem=function(className,altText,action){return $("<li/>").append($("<a href='javascript:void(0);'/>").addClass(className).attr("title",altText).click(function(){action.call(that,$(this));}));};function addButtons(arr){var ul=$("<ul/>").appendTo(that.toolbar);for(var i=0;i<arr.length;i++){var e=arr[i];if((typeof(e)).toLowerCase()==="string"){if(e==="|"){ul.append($('<li class="separator"/>'));}else{var f=(function(e){var m=priv.toolbarButtons[e]||e;if((typeof(m)).toLowerCase()==="function"){return function(btn){m.call(this,btn);};}else{return function(){this[m]();this.editor.body.focus();};}})(e.toLowerCase());var t=options.toolbarText[e.toLowerCase()];ul.append(menuItem(e.toLowerCase(),t||e,f));}}else{ul.append(menuItem(e.css,e.text,e.action));}}};if(options.toolbar.length!==0&&priv.isArray(options.toolbar[0])){for(var i=0;i<options.toolbar.length;i++){addButtons(options.toolbar[i]);}}else{addButtons(options.toolbar);}},attachEditorEvents:function(){var t=this;var fnHA=function(){t.updateHtmlArea();};this.textarea.click(fnHA).keyup(fnHA).keydown(fnHA).mousedown(fnHA).blur(fnHA);var fnTA=function(){t.updateTextArea();};$(this.editor.body).click(fnTA).keyup(fnTA).keydown(fnTA).mousedown(fnTA).blur(fnTA);$('form').submit(function(){t.toggleHTMLView();t.toggleHTMLView();});if(window.__doPostBack){var old__doPostBack=__doPostBack;window.__doPostBack=function(){if(t){if(t.toggleHTMLView){t.toggleHTMLView();t.toggleHTMLView();}}
return old__doPostBack.apply(window,arguments);};}},isArray:function(v){return v&&typeof v==='object'&&typeof v.length==='number'&&typeof v.splice==='function'&&!(v.propertyIsEnumerable('length'));}};})(jQuery);

//jHtmlArea - http://jhtmlarea.codeplex.com - (c)2009 Chris Pietschmann﻿
(function($){if(jHtmlArea){var oldForecolor=jHtmlArea.fn.forecolor;jHtmlArea.fn.forecolor=function(c){if(c){oldForecolor.call(this,c);}else{var that=this;var rng=this.getRange();jHtmlAreaColorPickerMenu($(".forecolor",this.toolbar),{colorChosen:function(color){if($.browser.msie){rng.execCommand("ForeColor",false,color);}else{that.forecolor(color);}}});}};}
var menu=window.jHtmlAreaColorPickerMenu=function(ownerElement,options){return new jHtmlAreaColorPickerMenu.fn.init(ownerElement,options);};menu.fn=menu.prototype={jhtmlareacolorpickermenu:"0.7.0",init:function(ownerElement,options){var opts=$.extend({},menu.defaultOptions,options);var that=this;var owner=this.owner=$(ownerElement);var position=owner.position();if(menu.instance){menu.instance.hide();}
jHtmlAreaColorPickerMenu.instance=this;var picker=this.picker=$("<div/>").css({position:"absolute",left:position.left+opts.offsetLeft,top:position.top+owner.height()+opts.offsetTop,"z-index":opts["z-index"]}).addClass("jHtmlAreaColorPickerMenu");for(var i=0;i<opts.colors.length;i++){var c=opts.colors[i];$("<div/>").css("background-color",c).appendTo(picker).click((function(color){return function(){if(opts.colorChosen){opts.colorChosen.call(this,color);}
that.hide();};})(c));}
$("<div/>").html("<div></div>Automatic").addClass("automatic").appendTo(picker).click(function(){if(opts.colorChosen){opts.colorChosen.call(this,null);}
that.hide();});var autoHide=false;picker.appendTo(owner.parent()).show().mouseout(function(){autoHide=true;that.currentTimeout=window.setTimeout(function(){if(autoHide===true){that.hide();}},1000);}).mouseover(function(){if(that.currentTimeout){window.clearTimeout(that.currentTimeout);that.currentTimeout=null;}
autoHide=false;});},hide:function(){this.picker.hide();this.picker.remove();}};menu.fn.init.prototype=menu.fn;menu.defaultOptions={"z-index":0,offsetTop:0,offsetLeft:0,colors:["#ffffff","#cccccc","#c0c0c0","#999999","#666666","#333333","#000000","#ffcccc","#ff6666","#ff0000","#cc0000","#990000","#660000","#330000","#ffcc99","#ff9966","#ff9900","#ff6600","#cc6600","#993300","#663300","#ffff99","#ffff66","#ffcc66","#ffcc33","#cc9933","#996633","#663333","#ffffcc","#ffff33","#ffff00","#ffcc00","#999900","#666600","#333300","#99ff99","#66ff99","#33ff33","#33cc00","#009900","#006600","#003300","#99FFFF","#33FFFF","#66CCCC","#00CCCC","#339999","#336666","#003333","#CCFFFF","#66FFFF","#33CCFF","#3366FF","#3333FF","#000099","#000066","#CCCCFF","#9999FF","#6666CC","#6633FF","#6600CC","#333399","#330099","#FFCCFF","#FF99FF","#CC66CC","#CC33CC","#993399","#663366","#330033"],colorChosen:null};})(jQuery);

//set jHtmlArea css
var timer = setInterval(function(){var iframe = $("#jHtmlIframe");var isFrame = iframe.length;if(isFrame > 0){clearInterval(timer);var self = window.location.href.split("/admin");iframe.contents().find("head").append("<link href='"+self[0]+"/system/lib/css/reset.css' rel='stylesheet' type='text/css' media='screen'/>").append("<link href='"+self[0]+"/system/admin_templates/css/jHtmlIframe.css' rel='stylesheet' type='text/css' media='screen'/>");}},100);

//-----custom image popup function-----//
function addImage(url,el){
	
	//get url of galleries
	var href 	= window.location.href.split("/admin");
	var galHref = href[0]+"/admin/galleries";
	var galHash = "galleries";
	
	//open popup
	openOverlay("fast",function(){
		openPopup("fast","Insert image","loading...","500",function(){
			//init popup gallery view
			initGalleryView();
		});
		$("#popup").addClass("insertImage");
		load(galHref,galHash);
	});
	
	//init the gallery view
	function initGalleryView(){
		
		//define content
		var popupContent = $("#popup .galleries");
		
		//bind clicks to popup links
		popupContent.find("a").live("click",function(e){
			e.preventDefault();
			var link = $(this);
			var hash = "images";
			var href = link.attr("href");
			load(href,hash,function(){
				var popup = $("#popup .popupContent");
				popup.append("<input type='button' class='button back' value='back'/>");
				popup.find(".back").click(function(e){
					e.preventDefault();
					popup.css("visibility","hidden");
					load(galHref,galHash,function(){
						popup.css("visibility","visible");
					});
				});
				//init popup image view
				initImageView();
			});
		});

	}
	
	//init images view
	function initImageView(){
		
		//define content
		var popupContent = $("#popup .images");
		
		//handle image choice
		popupContent.find(".imageHolder").click(function(){
			var url = $(this).find("img").attr("src");
			if($.browser.msie && !url){
				el.ec("insertImage",true);
			}else{
				el.ec("insertImage",false,(url));
			}
			//close popup
			closePopup("fast",function(){
				closeOverlay("fast");
			});
		});
			
	}
	
	//function to load page
	function load(url,hash,callback){
		var url = url+" #"+hash;
		var popup = $("#popup .popupContent");
		popup.attr("class","popupContent");
		popup.load(url,function(){
			popup.addClass(hash);
			if(callback){
				callback();
			}
		});
	}
	
}
