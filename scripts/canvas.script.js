jQuery(document).ready(function($){

	var count = 0;
	var drift = $('body').attr('drift');
	var view = $('#canvas-info').attr('view');
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

if (drift){

	// Make Pieces
		switch(view){
			case 'back':
				for (var cnt = 0; cnt <= 5; cnt++){
					$.each(['x', 'y', 'z'], function(index, value){
						var piece = $('#canvas-info .piece[plane="'+value+cnt+'"]');
						if (piece.length){
							displayPiece(piece, value);
						}
					});
				}
				break;
			case 'side':
				for (var cnt = 5; cnt >= 0; cnt--){
					$.each(['x', 'y', 'z'], function(index, value){
						var piece = $('#canvas-info .piece[plane="'+value+cnt+'"]');
						if (piece.length){
							displayPiece(piece, value);
						}
					});
				}
				break;
			case 'bottom':
				for (var cnt = 5; cnt >= 0; cnt--){
					$.each(['x', 'z', 'y'], function(index, value){
						var piece = $('#canvas-info .piece[plane="'+value+cnt+'"]');
						if (piece.length){
							displayPiece(piece, value);
						}
					});
				}
				break;
			default:
				for (var cnt = 0; cnt <= 5; cnt++){
					$.each(['y', 'x', 'z'], function(index, value){
						var piece = $('#canvas-info .piece[plane="'+value+cnt+'"]');
						if (piece.length){
							displayPiece(piece, value);
						}
					});
				}
		}


	// Make Pieces
		function displayPiece(piece, value){
			var begin = true;
			var back = new Array();

			if (value == 'x'){
				ctx.fillStyle   = 'rgba(12,112,212,1)';
			} else if (value == 'y'){
				ctx.fillStyle   = 'rgba(212,112,12,1)';
			} else if (value == 'z'){
				ctx.fillStyle   = 'rgba(112,12,112,1)';
			} else {
				ctx.fillStyle   = 'rgba(255,255,255,1)';
			}
			ctx.strokeStyle = 'rgba(0,0,0,0.85)';
			ctx.lineWidth   = 1;

			ctx.beginPath();
			piece.children('div').each(function(){
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

			count++;
		}
} else {
	$('#canvas-info .piece').each(function(num){
		var begin = true;
		var back = new Array();

		if (num == 0){
			ctx.fillStyle   = 'rgba(12,112,212,0.67)';
		} else if (num == 2){
			ctx.fillStyle   = 'rgba(212,112,12,0.67)';
		} else if (num == 4){
			ctx.fillStyle   = 'rgba(112,12,112,0.67)';
		} else {
			ctx.fillStyle   = 'rgba(0,0,0,0.0.67)';
		}
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
}
});