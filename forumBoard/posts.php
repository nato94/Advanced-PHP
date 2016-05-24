<html>
    <head>
         <meta charset="UTF-8">
        <title>Dank Forums</title>
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
        
        ?>
        
        
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Dank Forums</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
        <li><a href="sign-in.php">Topics<span class="sr-only">(current)</span></a></li>
        <li><a href="#">Posts<span class="sr-only">(current)</span></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        <br />
        <br />
        <div class="container">
        <h1 class="page-header">Dank Forums Posts!</h1>
        
        <?php
       
                $util = new util();
                if($util->isPostRequest()){
                    $values = filter_input_array(INPUT_POST);
                    $created = date("Y-m-d H:i:s");
                    $topic = $values['topic'];
                    if($topicHandler->AddTopic($topic, $created)){
                        $SuccessMessage = "Successfully added topic!";
                    }
                }
                
                if($util->isGetRequest()){
                    
                }
                

        include('./SuccessMessage.html.php');
        include('./ErrorMessage.html.php');
        
       ?>

<h1>Make A Post!</h1>

<?php 
$postHandler = new postHandler();

$postsHandler->getAllPosts();

?>



<div class="table-responsive">
  <table class="postsTable">
      <tr>
      <th>Subject</th>
      <th>Message</th>
      </tr>
      
         <?php foreach( $topics as $key => $results ):  $topic_id = $results['topic_id']; ?>
          <tr>
          <td><?php echo $results['subject'] ?></td>
          <td><a href="posts.php?topic_id="><?php echo $results['message'] ?></a></td>
          </tr>
          <?php endforeach; ?>

  </table>
    <h1>Make A Post</h1>

    <form action="posts.php" method="POST">   
        <div class="form-group">
            <label for="message">Message:</label>
            <input type="text" name="message" placeholder="Type Message Here" class="form-control" />
        </div>
       <input id="loginBtn" type="Submit" name="post" value="Post" class="btn btn-primary" />
    </form>
</div>


    </div><!-- end div container -->
    </body>
</html>