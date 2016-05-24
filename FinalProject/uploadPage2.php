<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Final Project</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <!-- call the main css file that has all the style -->
        <link rel="stylesheet" href="css/main.css">

        <style type="text/css"> 
            #files-img {
                border: 5px dashed #D9D9D9;
                border-radius: 10px;
                padding: 1em 2em;
                text-align: center;
            }
            .over {
                background: #F7F7F7;
            }
            input {
                margin: 0.5em;
                padding: 0.5em;
            }
            #img-file-content img {
                max-width: 100%;
            }
            
            #uploadForm{
                position: relative;
                left: 500px;
            }
        </style>
        
    </head>
    <body>
            <?php session_start(); ?>
        
        
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
        <li class="active"><a href="admin.php">Administrator<span class="sr-only">(current)</span></a></li>
        <li><a href="uploadPage2.php">Upload<span class="sr-only">(current)</span></a></li>
        <li role="presentation" id="logoutBtn"><a href="logout.php">Logout</a></li>
        <?php endif; ?>
        <li><span class="sr-only">(current)</span></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        <br />
        <br />
        
        <h1 class="page-header">Upload A Meme: </h1>
        

        <form id="uploadForm">
            <div class="form-group">
            <label for="memeTitle">Meme Title: </label>
                <input type="text" placeholder="title" name="memeTitle" value="" required="required" /> <br />
            </div>
            <div class="form-group">
            <label for="memetop">Meme Top Text: </label>
                <input type="text" placeholder="Meme Top text" name="memetop" value="" required="required" /> <br />
            </div>
            <div class="form-group">
            <label for="memebottom">Meme Bottom Text: </label>
                <input type="text" placeholder="Meme Botom text" name="memebottom" value="" required="required" /> 
            </div>
            <br />
            <input class="btn btn-primary" type="reset" value="Reset" />
            <input type="button" value="Submit" class="btn btn-primary" />

        </form>
                    <br />
            <br />
        
        <?php
        
        $user_id = $_SESSION['userid']; ?>
        
         <input hidden="true" type="text" name="ID" value="<?php echo $user_id ?>" />
        
 
    <div id="files-img">
        <p>Drag an image file from your computer here</p>
        <p>or</p>
        <p><input type="file" name="picked" /></p> 
    </div>
    <div class="progress"></div>
    <pre id="img-file-content"></pre>
    <script type="text/javascript">
        /*
         switch(fileList[0].type) {
         case 'image/png': 
         case 'image/gif': 
         case 'image/jpeg': 
         case 'image/pjpeg':
         case 'text/plain':
         case 'text/html':
         case 'application/x-zip-compressed':
         case 'application/pdf':
         case 'application/msword':
         case 'application/vnd.ms-excel':
         case 'video/mp4':
         case 'audio/mp3':
         case 'audio/mpeg':
         break;
         default:
         'Unsupported file type!';
         return false;
         }
         */
    // call initialization file
        if (window.File && window.FileList && window.FileReader) {
            document.addEventListener("DOMContentLoaded", Init);
        }
        var dropZoneImg = document.querySelector('#files-img');
        var fileUpload = document.querySelector('input[name="picked"]');
        var fileContentPaneImg = document.querySelector('#img-file-content');
        var uploadProgress = document.querySelector('.progress');
        var memeTopText = document.querySelector('input[name="memetop"]');
        var memeBottomText = document.querySelector('input[name="memebottom"]');
        var memeTitle = document.querySelector('input[name="memeTitle"]');
        var SubmitBtn = document.querySelector('input[type="button"]');
        var ID = document.querySelector('input[name="ID"]');
        var imageReady = false,
                fileToUpload;
        function Init() {
    // Event Listener for when the dragged file is over the drop zone.
            dropZoneImg.addEventListener('dragover', function (e) {
                if (e.preventDefault)
                    e.preventDefault();
                if (e.stopPropagation)
                    e.stopPropagation();
                e.dataTransfer.dropEffect = 'copy';
            });
    // Event Listener for when the dragged file enters the drop zone.
            dropZoneImg.addEventListener('dragenter', function (e) {
                this.classList.add('over');
            });
    // Event Listener for when the dragged file leaves the drop zone.
            dropZoneImg.addEventListener('dragleave', function (e) {
                this.classList.remove('over');
            });
    // Event Listener for when the dragged file dropped in the drop zone.
            dropZoneImg.addEventListener('drop', function (e) {
                if (e.preventDefault)
                    e.preventDefault();
                if (e.stopPropagation)
                    e.stopPropagation();
                this.classList.remove('over');
                var fileList = e.dataTransfer.files;
                var textType = /image\/[jpeg|png|gif]/;
                if (fileList.length > 0) {
                    console.log(fileList[0]);
                    if (fileList[0].size > 10000000) {
                        fileContentPaneImg.innerHTML = "Exceeded filesize limit.";
                        imageReady = false;
                    } else if (fileList[0].type.match(textType)) {
                        readTexImg(fileList[0]);
                    } else {
                        fileContentPaneImg.innerHTML = "File not supported!";
                        imageReady = false;
                    }
                }
            });
            fileUpload.addEventListener("change", function () {
                var fileList = this.files;
                var textType = /image\/[jpeg|png|gif]/;
                if (fileList.length > 0) {
                    if (fileList[0].size > 10000000) {
                        fileContentPaneImg.innerHTML = "Exceeded filesize limit.";
                        imageReady = false;
                    } else if (fileList[0].type.match(textType)) {
                        readTexImg(fileList[0]);
                    } else {
                        fileContentPaneImg.innerHTML = "File not supported!";
                        imageReady = false;
                    }
                }
            });
            SubmitBtn.addEventListener("click", uploadImage);
        }
        ;
    // Read the contents of a file.
        function readTexImg(file) {
            var readerimg = new FileReader();
            readerimg.onloadend = function (e) {
                if (e.target.readyState == FileReader.DONE) {
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
            if (imageReady === true) {
                makeAJAXCall(fileToUpload);
            }
        }
        /*
         * Need extra help visit
         * https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/Using_XMLHttpRequest
         */
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.addEventListener("progress", updateProgress, false);
        xmlhttp.addEventListener("load", transferComplete, false);
        function makeAJAXCall(data) {
            var verb = 'POST';
            var url = 'upload2.php';
            var formData = new FormData();
            formData.append('upfile', data);
            formData.append(memeTopText.name, memeTopText.value);
            formData.append(memeBottomText.name, memeBottomText.value);
            formData.append(memeTitle.name, memeTitle.value);
            formData.append(ID.name,ID.value);
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
        function updateProgress(e) {
            if (e.lengthComputable) {
                uploadProgress.innerHTML = Math.ceil(e.loaded / e.total) * 100 + '%';
                ;
            } else {
    // Unable to compute progress information since the total size is unknown
            }
        }
        function transferComplete(e) {
    //uploadProgress.innerHTML = 'The transfer is complete.';
        }
    </script>
</body>
</html>