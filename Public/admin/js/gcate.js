(function($){
	$.fn.getGcate = function(options){
		var opts = $.extend({}, $.fn.getGcate.defaults, options);
		getFirst(this);
		
		/*获取一级列表*/
		function getFirst(obj){
			var t = "gcate";
			$.get(url,{type:t,id:0},function(data){
				$(obj).html(data);
				selBind(obj);		
			});
		};
		
		/*获取二级以上列表*/
		function getList(pid,obj,obj2){
			var t = "gcate";
			$.get(url,{type:t,id:pid},function(data){	
				if(data){			
					$(obj).after(data);
					selBind(obj2);
				}
			});
		};
		
		/*绑定onchange事件*/
		function selBind(obj){
			$(obj).find('select').each(function(){
				$(this).unbind();
				$(this).change(function(){
					$(this).nextAll('select').remove();
					if($(this).val() > 0){
						getList($(this).val(),this,obj);						
						var selVal = $(this).val();
						var selSelects = $(obj).find("select option:selected").text();
						//alert(selSelects);
						var selData = selSelects;
						for(var s in selSelects){
							//alert(s+"|"+selSelects[s]);
							//selData += $(selSelects[s]).text();
						}
						$('#'+opts.aid).val(selVal);
						$('#'+opts.anid).val(selData);
					}
				});
			});
		};
	};
	
	
	$.fn.getGcate.defaults = {    
		aid: '',    
		anid: ''    
	};
})(jQuery);
	
/*判断是否是最后一级*/
function selLast(obj){
	var t = "gcate";
	var lastVal = $(obj).val();
	$.get(url,{type:t,id:lastVal},function(data){
		if(data){
			alert("请选择分类！（必须选到最后一级）");
		}
	});
}