jQuery(document).ready(function($){
	var timer;
	if($.browser.msie && $.browser.version < 9){
		$('a', '.js-header-nav').css({
				opacity: 0
			});
			$('a.first', '.js-header-nav').css({
				opacity: 1
				});
	}
	var btns = $('a', '.js-header-nav').each(function(){
		$(this).click(function(){
            if(!$(this).hasClass('currentBtn')){
                $('.currentPicture').fadeOut(1000).removeClass('currentPicture').css('display', 'block');
                $($(this).attr('pic')).fadeIn(1000).addClass('currentPicture');
                $('.currentBtn').animate({
                    opacity: 0
                    }).removeClass('currentBtn');
                $(this).animate({
                    opacity: 1
                    }).addClass('currentBtn');
                    clearInterval(timer);
                timer = setInterval(switchSlide, 2500);
            }
			});
		});
	timer = setInterval(switchSlide, 2500);

	function switchSlide(){
		var next = $('.currentBtn').parent().next().children();
		if(next.parent().index() == -1){
			$('a.first', '.js-header-nav').trigger('click');
		}
		else
			next.trigger('click');
	}
	})

function mostrar(num){
//alert(document.getElementById("celda1").style.display.value);
		if(num==1){
			document.getElementById("celda1").style.display='block';
			document.getElementById("celda2").style.display='none';
			document.getElementById("titulo1").style.color="black";
			document.getElementById("titulo2").style.color="white";
			document.getElementById("fondo_titulo1").style.background="#D5D3D3";
			document.getElementById("fondo_titulo2").style.background="#6E1310";
		}
		if(num==2){
			document.getElementById("celda1").style.display='none';
			document.getElementById("celda2").style.display='block';
			document.getElementById("titulo1").style.color="white";
			document.getElementById("titulo2").style.color="black";
			document.getElementById("fondo_titulo1").style.background="#6E1310";
			document.getElementById("fondo_titulo2").style.background="#D5D3D3";
		}
	}
