/* Cazu Accordion Slide Plugin
 * @author: Pablo Cazorla
 * @e-mail: contact@pcazorla.com
 * @date: 09/13/2013
 */
(function($){
	$.fn.accordionSlide = function(options){
		//Settings
		var setting = $.extend({
			openWidth : 80, // %
			current : 0,
			margin : 0 // px
		}, options);
		
		
			
		return this.each(function(){
			
			//Store this
			var $this = $(this).css('paddingRight',setting.margin +'px'),
				len = $this.find('>.slide').css('marginLeft',setting.margin +'px').each(function(){				
					$(this).wrap('<div class="slideWrap"></div>');
				}).length,
			
				$slideWraps = $this.find('>.slideWrap').css({
					'padding': setting.margin +'px 0'
				}),
				
				current = setting.current,
				moving = false,
				change = function(num){
					if(!moving){
						var posX = 0,
							wd = (100 - setting.openWidth)/(len - 1);
						for(var i = 0; i < len; i++){
							var widthSlide = wd;
							if(i == num){widthSlide = setting.openWidth;}
							
							$slideWraps.eq(i).css({
								'left': posX +'%',
								'width': widthSlide + '%'								
							});
							posX += widthSlide;
						}
					}
				}
				
				change(current);
			
		});
	};
})(jQuery);