jQuery(document).ready(function($){

	var cv = document.getElementById('stage');
	var ctx = cv.getContext('2d');

	if (!cv || !ctx){
		return;
	}

	$('#canvas-info').find('.pt').each(function(){
		$(this).data('x', parseInt($(this).css('left'))).data('y', parseInt($(this).css('top')));
	});

// Grid Dots
	$('#canvas-info #stage_dots .griddot').each(function(){
		ctx.fillStyle = 'rgba(35,125,135,0.75)';
		ctx.beginPath();
		ctx.arc($(this).data('x'), $(this).data('y'), 1, 0, 2 * Math.PI, true);
		ctx.fill();
		ctx.closePath();
	});

// Draw Stage Lines
	$('#canvas-info #stage_dots .griddot.edge').each(function(){
		ctx.strokeStyle = 'rgba(0,0,0,0.25)';
		ctx.beginPath();
		ctx.moveTo($('.griddot#center_dot').data('x'), $('.griddot#center_dot').data('y'));
		ctx.lineTo($(this).data('x'), $(this).data('y'));
		ctx.stroke();
		ctx.closePath();
	});

// Make Pieces
	$('#canvas-info .piece').each(function(){
		var begin = true;
		var back = new Array();

		ctx.fillStyle   = 'rgba(0,0,0,0.5)';
		ctx.strokeStyle = 'rgba(0,0,0,0.85)';
		ctx.lineWidth   = 1;

		ctx.beginPath();
		$(this).children('div').each(function(){
			if (begin){
				back = [$(this).data('x'), $(this).data('y')];
				ctx.moveTo($(this).data('x'), $(this).data('y'));
			} else {
				ctx.lineTo($(this).data('x'), $(this).data('y'));
			}

			begin = false;
		});
		ctx.lineTo(back[0], back[1]);
		ctx.fill();
		ctx.stroke();
		ctx.closePath();
	});

});