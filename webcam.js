(function (){

var video = document.getElementById('video'),
	canvas = document.getElementById('canvas'),
	context = canvas.getContext('2d'),
	save = document.getElementById('save');
	image = document.getElementById('image');
	input = document.getElementById('input');
	vendorURL = window.URL || window.webkitURL;

	navigator.getMedia =	navigator.getUserMedia ||
							navigator.webkitGetUserMedia ||
							navigator.mozGetUserMedia ||
							navigator.msGetUserMedia;
	
	navigator.getMedia({
		video: true,
		audio: false
	}, function(stream){
		video.srcObject = stream;
		video.play();
	}, function(error){
		// error.code
	});

	document.getElementById('click').addEventListener('click', function(){
		context.drawImage(video, 0, 0, 400, 300);
		save.setAttribute("style", "display: block");
		image.setAttribute("style", "display: block");
		image.src = canvas.toDataURL("image/png");
		input.setAttribute("value", image.src);
	})

})();

	var file = document.forms.save_form;

	function save(file){
		xhr = new XMLHttpRequest();
		xhr.open('POST', 'save_img.php');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send();
	};