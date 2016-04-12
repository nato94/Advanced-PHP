<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Messaging Web App</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script>
        $(function() {
            $( "#draggable" ).draggable().resizable();
        });
        </script>
    </head>
    <body>
        <?php
        
        require_once './autoload.php';
        $msg = new Message();
        $msg->addMessage("Name", "Name requires input");
        
        var_dump($msg->getAllMessages());
        
        $msg->removeMessage("Name");
        
        var_dump($msg->getAllMessages());
        
        ?>
        
        <div id="draggable" class="input-group">
            <input type="text" cols="40" rows="5" class="form-control ui-widget-content">
            <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Send Message<span class="caret"></span></button>
            </div>
        </div>
        
    </body>
</html>
