jQuery(document).ready(function($){

	var renderer = new THREE.WebGLRenderer({antialias:true});
	renderer.setSize(document.body.clientWidth, document.body.clientHeight);

	$('body').html(renderer.domElement);

	renderer.setClearColorHex(0xEEEEEE, 1.0);
	renderer.clear();
	renderer.shadowCameraFov = 50;
	renderer.shadowMapWidth = 1024;
	renderer.shadowMapHeight = 1024;

	var fov = 45;								// camera field-of-view in degrees
	var width = renderer.domElement.width;
	var height = renderer.domElement.height;
	var aspect = width / height; 				// view aspect ratio
	var near = 1; 								// near clip plane
	var far = 10000;							// far clip plane

	var camera = new THREE.PerspectiveCamera(fov, aspect, near, far);
	camera.position.z = -400;
	camera.position.x = 200;
	camera.position.y = 350;
	var scene = new THREE.Scene();
/*
	new THREE.ColladaLoader().load('scripts/models/drift.dae', function(collada) {
		var model = collada.scene;
		skin = collada.skins[0];
		model.scale.set(0.1, 0.1, 0.1);
		model.rotation.x = -Math.PI/2;
		model.castShadow = model.receiveShadow = true;
		scene.add(model);
	});
*/
	var plane = new THREE.Mesh(
		new THREE.PlaneGeometry(400, 200, 10, 10),
		new THREE.MeshLambertMaterial({color: 0xffffff}));
	plane.rotation.x = -Math.PI/2;
	plane.position.y = -25.1;
	plane.receiveShadow = true;
	scene.add(plane);

	var light = new THREE.SpotLight();
	light.castShadow = true;
	light.position.set(170, 330, -160);
	scene.add(light);

	renderer.shadowMapEnabled = true;

	renderer.render(scene, camera);

/*
	var scene = new THREE.Scene();

	var loader = new THREE.ColladaLoader();
	loader.load('../assets/models/drift.dae', function(result){
		scene.add(result.scene);
	});

//----------

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
*/
});