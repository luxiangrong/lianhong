(function($){
	$.fn.getArea = function(options){
		var opts = $.extend({}, $.fn.getArea.defaults, options);
		getFirst(this);
		
		/*获取一级列表*/
		function getFirst(obj){
			var t = "region";
			$.get(url,{type:t,id:0},function(data){
				$(obj).html(data);
				selBind(obj);		
			});
		};
		
		/*获取二级以上列表*/
		function getList(pid,obj,obj2){
			var t = "region";
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
	
	
	$.fn.getArea.defaults = {    
		aid: '',    
		anid: ''    
	};
})(jQuery);
