/* CazuGrid Plugin
 * @author: Pablo Cazorla
 * @e-mail: pablo.cazorla@huddle.com.ar
 * @date: 08/02/2013
 */
;(function(){
	var cazuGrid = function(sel){this.init(sel);}
	
	cazuGrid.prototype ={
		// Functions	
		init : function(sel){
			
			if(typeof sel !== 'string'){
				var options = sel;
			}else{
				var options = {gridID : sel};
			}
			this.cfg = $.extend({
				gridID : 'gallery',
				elemClass : 'figure'
			}, options);
			
			this.$window = $(window);
			this.grid = $(this.cfg.gridID).css('position','relative').addClass('cazu-grid');
			this.prevGridWidth = 0;
			this.add(this.grid.find(this.cfg.elemClass)).setEvents();
			
			return this;
		},
		add : function(elem){
			if(typeof elem !== 'string'){
				var newElem = elem;
			}else{
				var newElem = $(elem);
			}
			
			newElem.css({
				'float':'none',
				'position':'absolute',
				'top':'0',
				'left':'0'
			}).addClass('cazu-grid-child');
			
			if(typeof this.elem === 'undefined'){
				this.elem = newElem;
			}else{
				this.elem = this.elem.add(newElem);
			}
			this.grid.append(newElem);
			
			this.draw();
			return this;
		},
		draw : function(){
			var elemDraw = this.elem.not('.hidden'),
				length = elemDraw.length,
				gridHeightMax = 0;
				
			if(length > 0){
				
			this.prevGridWidth = this.grid.width()
			
			var gridWidth = this.prevGridWidth,				
				elemWidth = this.elem.outerWidth(true),
				rowCount = Math.ceil((gridWidth + parseInt(this.elem.css('marginRight'))+1)/elemWidth)-1,
				col = 0,
				posYarray = [],
				firstRow = true;
				
				for(var i=0;i<length;++i){
					var el = elemDraw.eq(i),
						posX = elemWidth * col;
					if(firstRow){
						var posY = 0;
					}else{
						var posY = posYarray[i-rowCount];
					}					
					var elemHeightY = posY + el.outerHeight(true);
					
					posYarray.push(elemHeightY);
					if(elemHeightY > gridHeightMax){gridHeightMax = elemHeightY;}					
					
					el.css({
						'left' : posX + 'px',
						'top' : posY + 'px'
					});
					
					++col;				
					if(col>=rowCount){
						col = 0;
						firstRow = false;
					}					
				}						
			}
			this.grid.css('height',gridHeightMax+'px');
			return this;
		},
		showOnly : function(sel){
			this.elem.removeClass('hidden').not(sel).addClass('hidden');
			this.draw();
			return this;
		},
		setEvents : function(){
			var self = this;
			this.$window.resize(function(){
				if(self.prevGridWidth != self.grid.width()){
					self.draw();
				}				
			});
			return this;
		}
	}
	if(!window.cazuGrid){window.cazuGrid = cazuGrid;}
})();