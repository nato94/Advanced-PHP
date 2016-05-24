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
        <h1 class="page-header">Welcome to Dank Forums!</h1>
        
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
                

        include('./SuccessMessage.html.php');
        include('./ErrorMessage.html.php');
        
       ?>

<h1>Upload A Topic</h1>

    <form action="index.php" method="POST">   
        <div class="form-group">
            <label for="topic">Topic:</label>
            <input type="text" name="topic" placeholder="Type Topic Here" class="form-control" />
        </div>
       <input id="loginBtn" type="Submit" name="Upload" class="btn btn-primary" />
    </form>

<?php 
$topicHandler = new topicHandler();
$topics = $topicHandler->getAllTopics();

?>

<div class="table-responsive">
  <table class="topicsTable">
      <tr>
      <th>Topic ID</th>
      <th>Subject</th>
      </tr>
      
         <?php foreach( $topics as $key => $results ):  $topic_id = $results['topic_id']; $subject = $results['subject']; ?>
      <tr>
          <td><?php echo $topic_id ?></td>
          <td><a href="posts.php?topic_id=><?php echo $topic_id ?>&subject=<?php echo $subject ?>"<?php echo $subject ?></a></td>
          </tr>
          <?php endforeach; ?>

  </table>
</div>


    </div><!-- end div container -->
    </body>
</html>