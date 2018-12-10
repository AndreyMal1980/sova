$(document).ready(function(){	
	
	$.preloadCssImages({statusBarEl: '#statusbar'});
	
	
	/************************
	PORTFOLIO TAG
	************************/
	$('#portfolio-tag').hover(
		function(){
			$(this).animate({'backgroundColor':'#FEDE00'}, 'normal');
		},
		function(){
		$(this).stop().animate({'backgroundColor':'#FFFFFF'}, 'normal');
	});
	
	$('#quotationtag .content').hide();	
	$('.frame a.open_quotation, #quotationtag .tag, #quotationtag .content a.fechar').click(function(){
		$('#quotationtag .content').slideToggle();
		return false;
	});
	
	$('#footer .view-awards, #footer #awards-panel a.fechar').click(function(){
		$('#awards-panel').slideToggle();
		return false;
	});
	
	$('#footer li .newsletter, #newsletter a.fechar').click(function(){
		$('#newsletter').slideToggle();
		return false;
	});
	
	
	$('#footer #awards #cda, #footer #awards-panel li a').prepend('<span></span>').hover(function(){
		$(this).find('span').stop().animate({opacity:'0'});
	},function(){
		$(this).find('span').stop().animate({opacity:'1'});
	});
			
	
	/************************
	MENU HOVER
	************************/
	
	$('#topheader #navigation li').prepend('<span></span>');
	$('#topheader #navigation li span').hide();
	
	$('#topheader #navigation li a').hover(
	function(){
		$(this).css({'color':'#000000'});
		$(this).parent().find('span').slideToggle('fast');
	},
	function(){
		if($.address.value() == '/portfolio') {
		$(this).css({'color':'#000000'});
		}
		else {
		$(this).css({'color':'#FFFFFF'});
		}
		$(this).parent().find('span').slideToggle('fast');
	}
	);
	
	$('.scrollable-area span.yellow').hide();
	
	$('.scrollable-area').hover(
	function(){
		$(this).find('h1').css({'color':'#000000'});
		$(this).find('span.yellow').slideDown('fast');
	},
	function(){
		$(this).find('h1').css({'color':'#FFFFFF'});
		$(this).find('span.yellow').slideUp('fast');
	}
	);
	

	function loadURL(url) {
		console.log("loadURL: " + url);
		$("#contentpanel").load(url);
	}

	// Event handlers
	$.address.init(function(event) {
		$.address.strict(true);
		$.address.crawlable(true);
	}).change(function(event) {
		if(event.path.indexOf("portfolio") != '-1') {
			$('a.back').removeClass('cboxElement');
			
			$('#contentpanel').animate({opacity:'hide', marginLeft:'-600px'},'normal');			
			$('#portfolio-panel .middle-section').show();	
			
			$("#fooweb").carouFredSel({
				items: 3,
				scroll:{
					items : 1
				},
				direction: "left",
				auto: false,
				prev : "#fooweb_prev",
    			next : "#fooweb_next"
			}).find(".item a").hover(
				function() { $(this).find(".info").slideDown('fast'); $(this).find("img").stop().animate({height: '200', 'margin-left': '-40px', 'margin-top': '-20px', width: '290'}, 'fast'); },
				function() { $(this).find(".info").slideUp('fast'); $(this).find("img").stop().animate({height: '160', 'margin-left': '0px', 'margin-top': '0', width: '250'}, 'fast'); }
			).click(function(){ $(this).find(".info").hide(); });
			
			$("#foodesign").carouFredSel({
				items: 3,
				scroll:{
					items : 1
				},
				direction: "left",
				auto: false,
				prev : "#foodesign_prev",
    			next : "#foodesign_next"
			}).find(".item a").hover(
				function() { $(this).find(".info").slideDown('fast'); $(this).find("img").stop().animate({height: '200', 'margin-left': '-40px', 'margin-top': '-20px', width: '290'}, 'fast'); },
				function() { $(this).find(".info").slideUp('fast'); $(this).find("img").stop().animate({height: '160', 'margin-left': '0px', 'margin-top': '0', width: '250'}, 'fast'); }
			).click(function(){ $(this).find(".info").hide(); });
	
			
			
			//entrada do portfolio
			$('.scrollable-area span.yellow').hide();
			$('#portfolio-panel').animate({'width':'100%'}, 'slow', function(){
				$('#topheader #navigation li a').css({color:'#000'});
				$('.scrollable-area span.yellow').hide();
			});
			
			// Open Shadowbox
			if(event.path.indexOf("gallery") != '-1')
			{
						
				var galleryName = event.path.split('/');
				//Shadowbox opens here
				$(".scrollable-area .item a."+galleryName[3]).colorbox({
					onCleanup:function(){ $.address.value('portfolio'); $("#cboxContent .gs-link, #cboxContent .gs-share, #cboxContent .fb").remove(); },
					maxHeight: '95%',
					open: true,
					title : $("#portfolio-panel .item a."+galleryName[3]).attr('name'),
					current : '{current}/{total}',
					opacity : '.80',
					onOpen: function(){ 
					var siteURL = $("#portfolio-panel .item a."+galleryName[3]).parent().find('.site_url').text();
					if( siteURL != '' ) {
					$("#cboxContent").prepend('<div class="gs-link"><a href="'+siteURL+'" target="_blank" title="Visit website">Visit Site</a></div><div class="gs-share"><a class="mail a2a_dd" href="http://www.addtoany.com/share_save" title="Share by Email">Share</a><script type="text/javascript"> var a2a_config = a2a_config || {}; a2a_config.menu_type = "mail"; a2a_config.color_main = "000000"; a2a_config.color_border = "000000"; a2a_config.color_link_text = "333333"; a2a_config.color_link_text_hover = "fede00";</script><script type="text/javascript" src="http://static.addtoany.com/menu/page.js"></script><a class="fb" href="http://www.facebook.com/sharer.php?u='+escape(top.location.href)+'&t='+$("#portfolio-panel .item a."+galleryName[3]).attr('title')+' » Portfolio » OwlConcept" title="Share on Facebook">Share on Facebook</a></div>'); }
					else {
					$("#cboxContent").prepend('<div class="gs-share"><a class="mail a2a_dd" href="http://www.addtoany.com/share_save" title="Share by Email">Share</a><script type="text/javascript"> var a2a_config = a2a_config || {}; a2a_config.menu_type = "mail"; a2a_config.color_main = "000000"; a2a_config.color_border = "000000"; a2a_config.color_link_text = "333333"; a2a_config.color_link_text_hover = "fede00";</script><script type="text/javascript" src="http://static.addtoany.com/menu/page.js"></script><a class="fb" target="_blank" href="http://www.facebook.com/sharer.php?u='+escape(top.location.href)+'&t='+$("#portfolio-panel .item a."+galleryName[3]).attr('title')+' » Portfolio » OwlConcept" title="Share on Facebook">Share on Facebook</a></div>');
					}
					$('.cboxCurrent').remove();
				 },  // end onOpen funciton
				onComplete : function(){
					$('#cboxCurrent:hidden').parent().append('<div class="cboxCurrent">1/1</div>');
				}
				});
				
				}
			
			
		}
		
		
		else {
		
		$.colorbox.close();	
			
		/* selected effect  */
		var pageurl = event.path;
		$('#navigation a').each(function(){
			if($(this).attr('rel') == 'address:' + pageurl) {
				$(this).parent().addClass('selected');
			}
			else {
				$(this).parent().removeClass('selected');
			}
		});
				
		$('#portfolio-panel .middle-section').fadeOut(0,	function(){
			$('#contentpanel').animate({opacity:'hide', marginLeft:'-600px'},'normal', function(){
				$('#portfolio-panel').animate({'width':'0px'}, 'slow');
				$('#topheader #navigation li a').css({color:'#FFF'});
				$("#contentpanel").show().load('templates/' +$('[rel=address:' + event.value + ']').attr('href') + '.php', function(response, status, xhr){
					if (status == "error") {
						
						if(pageurl == '/')
						{
							$("#contentpanel").load('templates/home.php', function(){
								$('#contentpanel').hide().animate({opacity:'show', marginLeft:'0px'},'normal');
							});
							}
						else {
							$("#contentpanel").load('templates/404.php', function(){
								$('#contentpanel').hide().animate({opacity:'show', marginLeft:'0px'},'normal');
							});
							}
					  }
					  else {
						//novidades
						$('#newstabs').tabs({ select: function(event, ui) { $('.ui-tabs-panel').animate({paddingTop:'500px', opacity:'0'},'normal'); }, show: function(event, ui) { $('.ui-tabs-panel').animate({paddingTop:'0px', opacity:'1'},'normal'); $('.scroll-pane').jScrollPane(); } });
						$('.scroll-pane').jScrollPane();
						
						//contactos
						$('.contactos .done').hide();
						$('.contactos .erro').hide();
						
						$('.contactos #submit').click(function () {
							//Get the data from all the fields
							var nome = $('#formulariocontacto input[name=nome]');
							var email = $('#formulariocontacto input[name=email]');
							var assunto = $('#formulariocontacto textarea[name=assunto]');
							var ip = $('#formulariocontacto input[name=ip]');
							
							//Validation
							if (nome.val()=='') {
								nome.effect( "shake", {times:3, distance:10}, 50 );
								$('#formulariocontacto label[for=nome]').effect( "shake", {times:3, distance:10}, 50 );
								return false;
							}
							
							if (email.val()=='') {
								email.effect( "shake", {times:3, distance:10}, 50 );
								$('#formulariocontacto label[for=email]').effect( "shake", {times:3, distance:10}, 50 );
								return false;
							}
							
							if (assunto.val()=='') {
								assunto.effect( "shake", {times:3, distance:10}, 50 );
								$('#formulariocontacto label[for=assunto]').effect( "shake", {times:3, distance:10}, 50 );
								return false;
							}
							
							//organize the data properly
							var dataString = 'nome=' + nome.val() + '&ip=' + ip.val() + '&email=' + email.val() + '&assunto='  + encodeURIComponent(assunto.val());
							
							//disabled all the text fields
							$('.contactos .textfield').attr('disabled','true');
							$('.contactos .textfield, .contactos label, .contactos #submit').animate({opacity: 0.25},{queue:false, duration:500}, function(){
								$('img.loading').fadeIn('fast');
							});
							
							$.ajax({
								//this is the php file that processes the data and send mail
								url: "mail.php",	
								
								//GET method is used
								type: "GET",
					
								//pass the data			
								data: dataString,		
								
								//Do not cache the page
								cache: false,
								
								//success
								success: function (html, status) {
									//if process.php returned 1/true (send mail success)
									if (status=='success') {					
										//hide the form
										$('#formulario').slideUp().hide();					
										//show the success message
										$('.contactos .done').fadeIn(2000);
										
									//if process.php returned 0/false (send mail failed)
									} else {
									
									//enable all the text fields again
									
									$('.contactos .erro').fadeIn('slow');
									
									$('.contactos .erro').click(function () {
									
										$('.contactos .erro').fadeOut('fast');
										$('.contactos .textfield').animate({opacity: 1 },{queue:false, duration:1});
										$('.contactos #submit').animate({opacity: 1 },{queue:false, duration:1});
										$('.contactos .textfield').removeAttr('disabled','true');
																   
									});
									
									
									//hide the loading sign
									$('.contactos .loading').hide();
									
									}
									
					
									
									//alert('Ocorreu um erro. Tente novamente.');				
								}		
							});
							return false;

							
						});
						
						//entrada
						$('#contentpanel').hide().animate({opacity:'show', marginLeft:'0px'},'normal');
						
					  }
				});
			});
		});
		}
		
	});
	
	
	/**********************
	* Pedido de Orçamento *
	***********************/
	
	//contactos
	$('#quotationtag .content .done').hide();
	$('#quotationtag .content .erro').hide();
	$('#quotationtag .content .loading').hide();
	$('#quotationtag .content #submit').click(function () {
		var quot_nome = $('#quotationtag .content input[name="nome"]');
		var quot_email = $('#quotationtag .content input[name="email"]');
		var quot_detalhes = $('#quotationtag .content textarea[name="detalhes"]');
		var quot_ip = $('#quotationtag .content input[name=ip]');
		//Validation
		if (quot_nome.val()=='') {
			quot_nome.effect( "shake", {times:3, distance:10}, 50 );
			$('#quotationtag .content label[for="nome"]').effect( "shake", {times:3, distance:10}, 50 );
			return false;
		}
		if (quot_email.val()=='') {
			quot_email.effect( "shake", {times:3, distance:10}, 50 );
			$('#quotationtag .content label[for="email"]').effect( "shake", {times:3, distance:10}, 50 );
			return false;
		}
		if (quot_detalhes.val()=='') {
			quot_detalhes.effect( "shake", {times:3, distance:10}, 50 );
			$('#quotationtag .content label[for="detalhes"]').effect( "shake", {times:3, distance:10}, 50 );
			return false;
		}
		//organize the data properly
		var quotationString = 'nome=' + quot_nome.val() + '&ip=' + quot_ip.val() + '&email=' + quot_email.val() + '&detalhes='  + encodeURIComponent(quot_detalhes.val());
		//disabled all the text fields
		$('#quotationtag .content .textfield').attr('disabled','true');
		$('#quotationtag .content .textfield, #quotationtag label, #quotationtag #submit').animate({opacity: 0.25},{queue:false, duration:500}, function(){
			$('#quotationtag .content .loading').fadeIn('fast');
		});
		$.ajax({
			//this is the php file that processes the data and send mail
			url: "quotation.php",	
			//GET method is used
			type: "GET",
			//pass the data			
			data: quotationString,		
			//Do not cache the page
			cache: false,
			//success
			success: function (html, status) {				
					//hide the form
					$('#quotationtag .content .formulario').slideUp().hide();					
					//show the success message
					$('#quotationtag .content .done').fadeIn(2000);
				//if process.php returned 0/false (send mail failed)
				//enable all the text fields again
				/*$('quotationtag .content .erro').fadeIn('slow');
				$('quotationtag .content .erro').click(function () {
					$('quotationtag .content .erro').fadeOut('fast');
					$('quotationtag .content .textfield').animate({opacity: 1 },{queue:false, duration:1});
					$('quotationtag .content #submit').animate({opacity: 1 },{queue:false, duration:1});
					$('quotationtag .content .textfield').removeAttr('disabled','true');
				});
				//hide the loading sign
				$('quotationtag .content .loading').hide();
				}
				//alert('Ocorreu um erro. Tente novamente.');*/				
			}		
		});
		return false;
	});

});

	
$(window).load(function(){
	
	$('#pageloading').fadeOut('normal', function(){
	/***********************
	Entry animation
	***********************/
	$('#header h1').delay(1000).animate({
		opacity:'show',
		marginLeft:'+=170px',
		marginTop:'+=135px'
	}, 'slow' , function(){
		$('#footer').animate({opacity:'show' },'slow');
		$('#navigation').slideDown('slow', function(){
			$('#portfolio-tag').animate({opacity:'show' },'slow');
		});
	});
	});
		
});