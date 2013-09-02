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
			case 'portfolio':
				//this.portfolioGrid().portfolioItemAjax();
				break;
			case 'slide':
				//this.slideGrid().slideItemAjax();searchInput
				break;
			case 'blog':
				this.searchInput();
				break;
			case 'blog-post':
				this.searchInput();
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
		var TEMPaddnews = function(count){
				var news = '';				
				for(var ei = count; ei > 0; ei--){
					var h = (Math.round(Math.random()*300)+200);
					news += '<figure>';
					news += '<a href="" rel="'+ei+'" class="item-portfolio-link"><img src="http://lorempixel.com/230/'+h+'?rnd='+(Math.random()*4000)+'" width="230" height="'+h+'" alt="a"/></a>';
					news += '<figcaption><h2>Imagine Luna</h2><div class="categories"><a href="">Fantasy</a></div></figcaption>'
					news += '</figure>'				
				}
				return news;
			}
		//-----------------------------------------------------------------------
		var grid = new cazuGrid('#gallery'),
			self = this,
			loading = false,
			$loading = $('#loading-gallery'),
			loadNews = function(){
				if(!loading){
					loading = true;
					$loading.css({
						'visibility':'visible',
						'opacity':'1'
					});
					
					setTimeout(function(){
						$loading.css({
							'visibility':'hidden',
							'opacity':'0'
						});
						//Success
						grid.add(TEMPaddnews(24));
						loading = false;	
					},500);
				}
			}
		
		loadNews();		
		this.$window.scroll(function(){
			var scrollDistance = Math.abs(self.$body.outerHeight() - (self.$window.scrollTop()+self.$window.height()));
			if(scrollDistance < 100){
				loadNews();
			}
		});
		return this;
	},
	portfolioItemAjax : function(){
		var self = this,
			$itemPortfolio = $('#item-portfolio'),
			$content = $('#item-portfolio .content'),
			open = false;
			openingORclosing = false;
			overContent = false,
			
			openItemPortfolio = function(postID){
				if(!open && !openingORclosing){
					open = true;
					openingORclosing = true;
					self.$body.addClass('show-item-portfolio');
					$itemPortfolio.animate({'opacity':'1'},300,function(){openingORclosing = false;});
									
					setTimeout(function(){					
						var htmlContent = '<img class="image-post" src="http://lorempixel.com/1000/1600?rnd='+(Math.random()*4000)+'" width="1000" height="1600"/>dsfsdf sfd sdf sd sdf<a href="sad">LINK</a>';
						
						//Success
						if(open){
							var $htmlContent = $(htmlContent);
							
							$content.append($htmlContent).find('img').load(function(){
								$(this).addClass('visible');
							});;
							
						}
					},500);
				}
			},
			closeItemPortfolio = function(postID){
				if(open && !openingORclosing){
					open = false;
					openingORclosing = true;
					$itemPortfolio.animate({'opacity':'0'},300,function(){
						self.$body.removeClass('show-item-portfolio');
						$content.html('');
						openingORclosing = false;
					});	
				}
			};
		
		$(document).on('click', '.item-portfolio-link',function(ev){
			ev.preventDefault();
			var postID = $(this).attr('rel');
			openItemPortfolio(postID);
		});
		
		$('#item-portfolio').click(function(){
			if(!overContent){			
				closeItemPortfolio();
			}
		});
		
		$content.hover(function(){overContent = true;},function(){overContent = false;});
		
		
		return this;
	},
	slideGrid : function(){
		var $gallery = $('#slideGallery').scrollLeft(0),
			$slideGrab = $('#slideGrab'),
			dragging = false,
			origX,origScroll,v;
		
		
		
		
		$slideGrab.mousedown(function(ev){
			if(!dragging){
				dragging = true;
				origX = ev.pageX;
				origScroll = $gallery.scrollLeft();
			}
		}).mousemove(function(ev){
			if(dragging){
				$gallery.scrollLeft(origScroll + origX - ev.pageX);
			}
		});
		
		this.$body.mouseup(function(){
			if(dragging){
				dragging = false;
				
			}
		});
		
		
		return this;
	},
	slideItemAjax : function(){
		return this;
	},
	searchInput : function(){
		$('#s').attr('placeholder','Search');
   
	}
}
$('document').ready(function(){cazu.init()});
