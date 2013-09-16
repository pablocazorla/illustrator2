//App Cazu
var cazu = {
	$window : null,
	$body : null,
	
	init : function(){
		//Common
		this.$window = $(window);
		this.$body = $('body');		
		
		if(!window.pageID){window.pageID = this.getPage();}
		
		this.headerMov().headerSlide().currentMenu();
		
		//Per page
		switch(window.pageID){
			case 'home':
				this.homeSlide().portfolioGrid().portfolioItemAjax().searchInput();
				break;
			case 'blog':
				this.searchInput();
				break;
			case 'blog-post':
				this.searchInput().validateForm().preHighlight();;
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
	headerSlide : function(){
		var $li = $('#header-banner .sl'),
			c = 0,
			l = $li.length,
			slidetime = 500,
			duration = 8000,
			change = function(){
				var n = c + 1;
				if(n >= l){n = 0;}
				$li.eq(n).css({'z-index':'11099'});
				$li.eq(c).animate({'opacity':'0'},slidetime,function(){
					$li.eq(n).css({'z-index':'11100'});
					$li.eq(c).css({'z-index':'11000','opacity':'1'});
					c = n;
				});				
			};
		setInterval(change,duration);
		return this;
	},
	homeSlide : function(){
		var $li = $('#home-slide .slide'),
		
			l = 10,
			c = Math.floor((Math.random()*l)),
			$li_c = 0,			
			slidetime = 500,
			duration = 7000,
			
			change = function(){
				var n = c + 1,
					$li_n = $li_c + 1;
				if(n >= l){n = 0;}
				if($li_n > 1){$li_n = 0;}
				
				$li.eq($li_n).css({
					'background-image': 'url("'+templateURL +'/img/home/'+ c +'.jpg")'
				});
				
				$li.eq($li_c).animate({'opacity':'0'},slidetime,function(){
					$li.eq($li_c).css({'opacity':'1','z-index':'63'});
					$li.eq($li_n).css({'z-index':'64'});					
					c = n;$li_c = $li_n;
				});
							
			};
		
		$li.eq(0).css({
			'z-index':'64',
			'background-image': 'url("'+templateURL +'/img/home/'+ c +'.jpg")'
		});
		setInterval(change,duration);
			
			
		return this;
	},
	currentMenu : function(){
		var cMenu = $('article').eq(0).attr('currentmenu');
		if(cMenu != undefined || cMenu != ''){
			$('#menu-principal a').each(function(){
				var $a = $(this);
				if($a.text().toLowerCase().indexOf(cMenu) != -1){
					$a.addClass('current');
				}
			});
		}
		return this;
	},
	portfolioGrid : function(){
		
		var grid = new cazuGrid('#gallery');
						
		return this;
	},
	portfolioItemAjax : function(){
		var self = this,
			$itemShow = $('.item-show'),
			$itemDimmer = $('#item-dimmer'),
			$itemContent = $("#item-content").css('min-height',self.$window.height()+'px'),
			originalContent = $itemContent.html(),
			loadPost = function(pid, urlPost){
				//Show Item
				
				$itemShow.scrollTop(0).fadeIn(400,function(){self.$body.addClass('overflow-hidden');});
				$.ajax({
					url : 'http://'+server+'/singleportfolio/',
					data : {id:pid,urlpost:urlPost},
					type : 'POST',
					success : function(html){
						$itemContent.html(html);$itemShow.scrollTop(0);
						$itemDimmer.height($itemContent.height());	
					},
					error : function(){
						// On error, redirect to urlPost
						window.location.href = urlPost;						
					},
					complete : function(){
						self.validateForm();
						$.getScript('//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4d9270a3495656e9',function(){
							addthis.toolbox(".addthis_toolbox");
						});
					}				
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
		
		$itemShow.scroll(function(){
			$itemDimmer.height($itemContent.height());			
		});
		
		return this;
	},
	searchInput : function(){
		$('#s').attr('placeholder','Search');
   		return this;
	},
	validateForm : function(){
		var $f = $('fieldset.validate'),
			valid = true,
			validate = function(){
				valid = true;
				$f.each(function(){
					var $this = $(this),
						$input = $this.find('input,textarea'),
						min = parseInt($this.attr('min')) || 0,
						val = $input.val(),
						emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i,
						isEmail = false;
					if($this.hasClass('email')){
						isEmail = true;
					}	
					
					if(val.length < min){
						valid = false;
						$this.addClass('error');
						$input.focus();
					}else{					
						$this.removeClass('error');
					}
					if(isEmail){
						if(val.search(emailRegEx) == -1){
							valid = false;
							$this.addClass('error');
							$input.focus();
						}else{
							$this.removeClass('error');
						}				
					}			
				});
			},
			clearFiels = function(){				
				$f.removeClass('error').find('input,textarea').val('');
				$f.eq(0).find('input').focus();				
			};
			
		$('#submit').click(function(e){
			validate();
			if(!valid){e.preventDefault();} 
		});
		$('#clearFields').click(function(e){
			e.preventDefault();
			clearFiels();
		});
		return this;
	},
	preHighlight : function(){
		var $pre = $('pre').addClass('prettyprint').each(function(){
			$(this).text($(this).html());
		});
		if($pre.length > 0){
			$.getScript('//google-code-prettify.googlecode.com/svn/loader/run_prettify.js');
		}		
	}
}
$('document').ready(function(){cazu.init()});
