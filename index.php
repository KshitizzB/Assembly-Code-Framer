<!DOCTYPE html>

<?php
	$current = "";
	$answer = "";
	if(!empty($_POST)){
		$current = $_POST['cppcode'];
		$file = "code.cpp";
		file_put_contents($file, $current);
		putenv("PATH=MinGW\bin");
		shell_exec("g++ -S code.cpp");
		shell_exec("g++ code.cpp -o code.exe");
		$answer = file_get_contents("code.s");
		if(!file_exists("code.exe")){
			$answer = shell_exec("error.exe");	
		}
		unlink("code.s");
	}
?>	

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>OnlineCompiler - C/C++</title>
		<link rel="stylesheet" href="bootstrap.min.css">
		<style>
			body{
				background: #ECD2E3;
			}
			.jumbotron1{
				width: 100% !important;
				height: 75px !important;
				background: linear-gradient(black,#800080) !important;
				border: 0px !important;
				border-radius: 0px !important;	
			}
			.jumbotronlink{
				font-size: 40px !important;
				color: white !important;
				text-shadow: 2px 2px 4px #FF00FF !important;
				position: relative;
				bottom: 20px;
				left: 20px;
				text-decoration: none !important;
				margin-bottom: 0px !important;
			}
			#inputarea,#outputarea{
				width: 450px;
				height: 500px;
				padding: 10px;
				border-radius: 10px;
			}
			.btn-primary{
				position: relative;
				top: 125px;
			}
			.btn-danger{
				position: relative;
				bottom: 225px;
				left: 500px;
			}
		</style>
	</head>
	<body>
		<div class="jumbotron jumbotron1">
			<a class="jumbotronlink" href="#">OnlineCompiler.com</a>
		</div>
		<div class="container">
			<div class="row">
				<form method="POST">	
					<div class="col-md-5">
						<textarea class="form-control" name="cppcode" id="inputarea" placeholder="Input your C/C++ code here!"><?php echo $current; ?></textarea>	
					</div>
					<div class="col-md-2">
						<input class="btn btn-primary" type="submit" value="Check the Result >>" onclick="emptyalert()">
					</div>
					<div class="col-md-5">
						<textarea class="form-control" name="cppcode2" disabled id="outputarea" placeholder="Output will appear here!"><?php echo $answer; ?></textarea>	
					</div>
				</form>
				<input class="btn btn-danger" type="submit" value="<< Reset your Code " onclick="reset()">
			</div>
		</div>
		
		<?php
			$temp = "k";
			file_put_contents("code.cpp", $temp);
			putenv("PATH=MinGW\bin");
			shell_exec("g++ code.cpp -o code.exe");
			$file1 = "code.cpp";
			$file2 = "code.exe";
			if(file_exists($file1)){
				unlink("code.cpp");
			}
			if(file_exists($file2)){
				unlink("code.exe");
			}
		?>
		
		<script>
			function reset(){
				document.getElementById("inputarea").value = "";
				document.getElementById("outputarea").value = "";
			}
			function emptyalert(){
			if(document.getElementById("inputarea").value == ""){
			alert("Please write some code!");
			}
		}
		</script>
		<script src="jquery-3.2.1.min.js"></script>
		<script src="bootstrap.min.js"></script>
		
	</body>
</html>	
