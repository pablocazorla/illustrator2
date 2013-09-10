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
				this.searchInput().validateForm();
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
						$itemDimmer.height($itemContent.height());
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
}
$('document').ready(function(){cazu.init()});
