<html>
    <head>
         <meta charset="UTF-8">
        <title>Assignment 4</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <!-- call the main css file that has all the style -->
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        
        <?php
        //call autoload class to load all classes for the page
        require_once './models/autoload.php';
         include('./ErrorMessage.html.php'); 
            include ('./SuccessMessage.html.php');
        
        $util = new util();
        
        session_start();
        if($_SESSION['logged-in'] != true){
            header("Location: index.php");
            die();
        }
        else{
            $SuccessMessage = "Welcome to the upload Page!";
        }
        
        
        
        ?>
        
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Dank MEME's</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
        <li><a href="sign-in.php">Sign-in<span class="sr-only">(current)</span></a></li>
        <li><a href="signup.php">Sign-up<span class="sr-only">(current)</span></a></li>
        <!-- if the login session is set and equals to true then display the link for the administrator -->
        <?php if(isset($_SESSION["logged-in"]) && $_SESSION["logged-in"] == true): ?>
        <li><a href="admin.php">Administrator<span class="sr-only">(current)</span></a></li>
        <li class="active"><a href="uploadPage.php">Upload<span class="sr-only">(current)</span></a></li>
        <li role="presentation" id="logoutBtn"><a href="logout.php">Logout</a></li>
        <?php endif; ?>
        <li><span class="sr-only">(current)</span></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        <br />
        <br />
        
        <div class="container">
        
   
    <h1 class="page-header">Upload File</h1>
    
    <form enctype="multipart/form-data" action="#" method="POST">   
        <div class="form-group">
            <label for="file">Picture Upload: </label>
            <input type="file" id="file" name="file" /><br />
        </div>
        
        <div class="form-group">
            <label for="memeTitle">Title: </label>
            <input type="text" class="form-control" id="memeTitle" name="memeTitle" placeholder="Enter The Title Of The Meem Here">
        </div>
        
        <div class="form-group">
            <label for="topText">Top Text: </label>
            <input type="text" class="form-control" id="memetop" name="memetop" placeholder="Enter Top Text Here">
        </div>
        
        <div class="form-group">
            <label for="bottomText">Bottom Text: </label>
            <input type="text" class="form-control" id="memebottom" name="memebottom" placeholder="Enter Bottom Text Here">
        </div>
       <input id="loginBtn" type="button" value="Upload" name="upload" class="btn btn-primary" />
    </form>
    </div>
        <pre id="img-file-content"></pre>
        <script type="text/javascript"> 
        
        var fileUpload = document.querySelector('input[name="file"]');
        var fileContentPaneImg = document.querySelector('#img-file-content');
        var memeTopText = document.querySelector('input[name="memetop"]');
        var memeBottomText = document.querySelector('input[name="memebottom"]');
        var SubmitBtn = document.querySelector('input[type="button"]');
        
         SubmitBtn.addEventListener("click", uploadImage);
        
           // Read the contents of a file.
            function readTexImg(file) {
                var readerimg = new FileReader();
                readerimg.onloadend = function (e) {
                    if(e.target.readyState === FileReader.DONE) {
                        var img = new Image();
                        img.src = readerimg.result;
                        fileContentPaneImg.innerHTML = '';
                        fileContentPaneImg.appendChild(img);
                        imageReady = true;
                        fileToUpload = file;
                    }
                };
                readerimg.readAsDataURL(file);
            }
            function uploadImage() {
                    makeAJAXCall(fileToUpload);
            }
               
            function makeAJAXCall(data) {
            var verb = 'POST';
            var url = 'upload2.php';
            var formData = new FormData();
            formData.append('upfile', data);
            formData.append(memeTopText.name, memeTopText.value);
            formData.append(memeBottomText.name, memeBottomText.value);
            xmlhttp.open(verb, url, true);
            xmlhttp.send(formData);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState === 4) {
                    var status = (xmlhttp.status === 200 ? "success" : "failure");
                    var response = JSON.parse(xmlhttp.responseText);
                    uploadProgress.innerHTML = response.message;
                    var img = new Image();
                    img.src = response.location;
                    fileContentPaneImg.innerHTML = '';
                    fileContentPaneImg.appendChild(img);
                } else {
    // waiting for the call to complete
                }
            };
        }
        
        
        
             </script>

        
        
 
    </body>
</html>