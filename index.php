<!DOCTYPE html>
<html>
	<head>
		<title>Photo Frame Editor</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<style>
			html{
				width:100%;
				height:100%;
			}
			body{
				margin:0;
				padding:0;
				width:100%;
				height:100%;
				background:#fff;
			}
			canvas#testCanvas{
				display:block;
				margin:0 auto;
				width:100%;
				min-width:60px;
				height:100%;
				min-height:60px;
				cursor:pointer;
			}
		img{border:solid 1px; margin:10px;}
		.selected{
		box-shadow:0px 12px 22px 1px #333;
		}
		</style>
		<script src="js/flashcanvas/canvas2png.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
		<script src="js/frame.js"></script>
		<link rel="stylesheet" href="resources/jquery.contextmenu/jquery.contextMenu.css" media="screen">
		<script src="resources/jquery.contextmenu/jquery.contextMenu.js"></script>
	</head>
	<body>
		<?php
		error_reporting(0);
		session_start();
		$session_picture = $_SESSION['picture'];
		if(empty($session_picture)){
			 $width='200';
			 $height='200';
		}else{
		list($width, $height) = getimagesize($session_picture);
		}

		?>
		<div class="container">
			<br>
			<br>
			<div class="row" style="background: #aad5d5;border:1px solid #000;padding: 50px 20px 50px 20px;">
				
				<div class="col-md-5">
					<!-- <img src="<?= $session_picture;?>"> -->
				<canvas id="testCanvas"></canvas>
				</div>
				<div class="col-md-7">
					<div class="col-md-12">
					<h4> Step 1: Enter your photo width and height</h4>
					<br>
					<form action="action.php" method="post" enctype="multipart/form-data">
					<div class="col-md-4">
						<label>Height *</label>
						<input type="number" name="height" min="1" placeholder="Enter Height" required />
					</div>
					<div class="col-md-4">
						<label>width *</label>
						<input type="number" name="width"  min="1" placeholder="Enter Width" required/>
					</div>
				</div>
				<div class="col-md-12">
				<br>
				<h4>Step 2: Choose your photo or upload your own photo</h4>
				<br>
				<div id="uploadedPhotos" style="display:flex; flex-wrap:wrap; gap:10px;">
					<?php
					$uploadedFiles = glob('upload/*_thump.*');
					foreach($uploadedFiles as $file) {
						echo '<img src="'.$file.'" class="uploaded-photo" style="height:60px;width:60px;object-fit:cover;cursor:pointer;border:2px solid #ccc;" onclick="selectPhoto(\''.$file.'\')">';
					}
					?>
				</div>
				<br>

				<input type="file" name="image" onchange='single_attachment(this,"jpg","jpeg","png","PNG","JPG","JPEG",")' accept="image/x-png,image/jpeg"  required/>
				<br>
				<input type="submit" name="submit" value="Submit" />
				</div>		
				<div class="col-md-12" >
				<br>
				<h4>Step 3: Choose your photo frame</h4>
				<div class="col-md-2"  >
					<a id="frame1"><img id="fselect" class="img"  src="fr1.png"  onclick="setFrame(this);" style="height:55px;width:  55px;cursor: pointer;"></a>
				</div><div class="col-md-2" >
					<a id="frame2"><img  class="img" onclick="setFrame(this);" src="fr3.png"style="height:55px;width: 55px;cursor: pointer;"></a>
				</div>
				</div>
				</form>
			</div>
		</div>
	</div>
<script>
	var selectedPhoto = '<?= $session_picture;?>';
	var selectedFrame = 'fr1.png';

	function setFrame(value) {
		if (value == null) {
			value = 'fr1.png';
		}
		selectedFrame = (typeof value === 'string') ? value : value.src;
		renderCanvas();
		// Highlight selected frame
		$('.img').removeClass('selected');
		if (typeof value !== 'string') $(value).addClass('selected');
	}

	function selectPhoto(photo) {
		selectedPhoto = photo;
		renderCanvas();
		// Highlight selected photo
		$('.uploaded-photo').css('border', '2px solid #ccc');
		$("img[src='"+photo+"']").css('border', '2px solid #007bff');
	}

	function renderCanvas() {
		$('#testCanvas').width(<?=  $width; ?>).height(<?=  $height; ?>);
		var myFrame = new Frame({
			canvas: $('#testCanvas'),
			frame: {
				file: selectedFrame,
				thickness: 15
			},
			mount: {
				imagePadding: { row: 50, column: 75 },
				sections: [
					[
						{
							width: 100,
							height: 100
						}
					]
				]
			},
			photos: [selectedPhoto]
		});
	}

	$(window).on('load', function () {
		// Highlight default frame
		$('#fselect').addClass('selected');
		// Highlight default photo if exists
		if (selectedPhoto) {
			$("img[src='"+selectedPhoto+"']").css('border', '2px solid #007bff');
		}
		renderCanvas();
	});

	function single_attachment(input, ext) {
		var validExtensions = ext; //array of valid extensions
		var fileName = input.files[0].name;
		var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
		if ($.inArray(fileNameExt, validExtensions) == -1) {
			input.type = ''
			input.type = 'file'
			alert("Only these file types are accepted : " + validExtensions.join(', '));
		} else {
			if (input.files && input.files[0]) {
				var filerdr = new FileReader();
				filerdr.onload = function (e) {
				}
				filerdr.readAsDataURL(input.files[0]);
			}
		}
	}
</script>
</body>
</html>