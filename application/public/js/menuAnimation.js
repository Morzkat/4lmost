$(document).ready(function(){
var contadore = 1;

    //aqui la otra funcion
    $(".nav").click(function(){
			if(contadore == 1){



				$(".men").animate({
						opacity: '100',
						right: '0.1%',
						width: '290px',
	        });
				$(".boton").animate({
						opacity: '100',

	        });


			jQuery(".anticontenedor").addClass('contenedorr');
			jQuery(".men").addClass('display');
        	jQuery("*").addClass('menufun');
				contadore = 0;
				} else {
					contadore = 1;
					$(".men").animate({
						opacity: '0',
						right: '-300px',
	        		});
	        		$(".boton").animate({
						opacity: '0',

	        });
					jQuery("*").removeClass('menufun');

				}
    });
});
