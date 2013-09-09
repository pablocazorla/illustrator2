//App Cazu
var cazu = {
	$window : null,
	$body : null,
	
	init : function(){
		//Common
		this.$window = $(window);
		this.$body = $('body');		
		
		if(!window.pageID){window.pageID = this.getPage();}
		
		this.headerMov();
		
		//Per page
		switch(window.pageID){
			case 'blog':
				this.searchInput();
				break;
			case 'blog-post':
				this.searchInput();
				break;
			case 'portfolio':
				this.portfolioGrid().portfolioItemAjax();
				break;
			default:
				//
		}
		return this;
	},
	getPage : function(){
		var pageID = $('article').eq(0).attr('id');
		if(pageID == undefined || pageID == ''){pageID = 'portfolio';}
		return pageID;
	},
	headerMov : function(){
		var self = this,
			$header = $('header.main'),
			prev = this.$window.scrollTop(),
			current = 0,
			fixed = true,
			
			$menuLauncher = $('#menu-launcher'),
			menuOpen = false,
			menuOpening = false,
			setMenu = function(overMenuLauncher){
				if(overMenuLauncher && !menuOpen){
					$header.addClass('opened-menu');
					setTimeout(function(){
						menuOpen = true;
					},500);					
				}
				if(menuOpen){					
					$header.removeClass('opened-menu');
					setTimeout(function(){
						menuOpen = false;
					},500);									
				}						
			},
			sideAct = false,
			setSideAct = function(){
				var w = self.$window.width();
				if(w <= 995 && !sideAct){
					$('#sidebar').appendTo('#side-act-content');
					sideAct = true;
				}
				if(w > 995 && sideAct){
					$('#sidebar').appendTo('#column-right');
					sideAct = false;
				}
			};
		this.$window.scroll(function(){
			current = self.$window.scrollTop();
			//console.log(current);
			if(!fixed && current < prev){
				$header.removeClass('hidden');
				fixed = true;
			}else if(fixed && current > prev){
				$header.addClass('hidden');
				fixed = false;
				setMenu();
			}
			prev = current;
		}).resize(function(){
			setSideAct();
		});
		
		$menuLauncher.click(function(ev){
			ev.preventDefault();
			setMenu(true);
		});
		
		
		setSideAct();
		//Set color links
		$('menu.main a').each(function(index){
			$(this).addClass('it-menu'+index);
		});
		
		return this;
	},
	portfolioGrid : function(){
		
		var grid = new cazuGrid('#gallery');
			
			var getn = function(n){
				return 300 *n + 20*(n-1);
			}
			for(var i = 6;i>0;i--){
				console.log(getn(i));
			}
			
		return this;
	},
	portfolioItemAjax : function(){
		var self = this,
			$itemShow = $('.item-show'),
			$itemContent = $("#item-content"),
			originalContent = $itemContent.html(),
			loadPost = function(pid, urlPost){
				//Show Item				
				$itemShow.fadeIn(400,function(){self.$body.addClass('overflow-hidden');});
				$.ajax({
					url : 'http://'+server+'/singleportfolio/',
					data : {id:pid,urlpost:urlPost},
					type : 'POST',
					success : function(html){
						$itemContent.html(html);
					},
					error : function(){
						$itemContent.html('<h3>Error loading data</h3>');						
					},
					complete : function(){}				
				});				
			},
			unloadPost = function(){
				//Hide Item
				$itemShow.fadeOut(250,function(){					
					self.$body.removeClass('overflow-hidden');
					$itemContent.html(originalContent);
				});
			}
		
		$.ajaxSetup({cache:false});
		
		// Events		 
	    $('.open-work').click(function(event){    	
	    	var ev = event || window.event;
	    	ev.preventDefault();        
	        loadPost($(this).attr('rel'),$(this).attr('href'));        
	        return false;
	    });
	    
	    $('.close-work').click(function(){ 
	        unloadPost();        
	        return false;
	    });
		
		return this;
	},
	searchInput : function(){
		$('#s').attr('placeholder','Search');
   
	}
}
$('document').ready(function(){cazu.init()});
