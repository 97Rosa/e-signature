<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>jQuery Signature Pad & Canvas Image</title>
		<link href="./css/jquery.signaturepad.css" rel="stylesheet">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="./js/numeric-1.2.6.min.js"></script> 
		<script src="./js/bezier.js"></script>
		<script src="./js/jquery.signaturepad.js"></script> 
		
		<script type='text/javascript' src="https://github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script>
		<script src="./js/json2.min.js"></script>
		
		
		<style type="text/css">
			body{
				font-family:monospace;
				text-align:center;
			}
			#btnDelSign {
				color: #fff;
				background: #ea1515;
				padding: 5px;
				border: none;
				border-radius: 5px;
				font-size: 20px;
				margin-top: 10px;
			}
			#btnSaveSign {
				color: #fff;
				background: #f99a0b;
				padding: 5px;
				border: none;
				border-radius: 5px;
				font-size: 20px;
				margin-top: 10px;
			}
			#signArea{
				width:304px;
				margin: 50px auto;
			}
			.sign-container {
				width: 60%;
				margin: auto;
			}
			.sign-preview {
				width: 150px;
				height: 50px;
				border: solid 1px #CFCFCF;
				margin: 10px 5px;
			}
			.tag-ingo {
				font-family: cursive;
				font-size: 12px;
				text-align: left;
				font-style: oblique;
			}
		</style>
	</head>
	<body>

		<h2>Learn Infinity | jQuery Signature Pad & Canvas Image</h2>
		
		<div id="signArea" >
			<h2 class="tag-ingo">Put signature below,</h2>
			<div class="sig sigWrapper" style="height:auto;">
				<div class="typed"></div>
				<canvas class="sign-pad" id="sign-pad" width="300" height="100"></canvas>
			</div>
		</div>
		
		<button id="btnDelSign">Clear</button>
		<button id="btnSaveSign">Save Signature</button>
		
		<div class="sign-container">
		<?php
		$image_list = glob("./image/*.png");
		foreach($image_list as $image){
			//echo $image;
		?>
		<img src="<?php echo $image; ?>" class="sign-preview" />
		<?php
		
		}
		?>
		</div>
		
		
		<script>
			$(document).ready(function() {
				$('#signArea').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
			});
			
			$("#btnSaveSign").click(function(e){
				html2canvas([document.getElementById('sign-pad')], {
					onrendered: function (canvas) {
						var canvas_img_data = canvas.toDataURL('image/png');
						var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
						//ajax call to save image inside folder
						$.ajax({
							url: 'save.php',
							data: { img_data:img_data },
							type: 'post',
							dataType: 'json',
							success: function (response) {
							   window.location.reload();
							}
						});
					}
				});
			});

			$("#btnDelSign").click(function(e){
				$("#signArea").signaturePad().clearCanvas();
			});
		  </script> 
		

	</body>
</html>