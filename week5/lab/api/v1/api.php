<?php

include_once './bootstrap.php';

/*
 * The Rest server is sort of like the page is hosting the API
 * When a user calls the page (By url(HTTP), CURL, JavaScript etc.), the server(this Page) will handle the request.
 */
$restServer = new RestServer();

try {
    
    $restServer->setStatus(200);
    
    $resource = $restServer->getResource();
    $verb = $restServer->getVerb();
    $id = $restServer->getId();
    $serverData = $restServer->getServerData();

    if ( 'corps' === $resource ) {
        
        $resourceData = new CorpResource();
        
        if ( 'GET' === $verb ) {
            
            if ( NULL === $id ) {
                //if there is no id it will get all the corps
                $restServer->setData($resourceData->getAllCorps());                           
                
            } else {
                //if there is an id it will get that specific corp
                $restServer->setData($resourceData->getCorp($id));
                
            }            
            
        }
                
        if ( 'POST' === $verb ) {
            //if the corp is successfully addded set the success message
            if ($resourceData->post($serverData)) {
                $restServer->setMessage('Corp Added');
                $restServer->setStatus(201);
            } else {
                throw new Exception('Corp could not be added');
            }
        
        }
        
        
        if ( 'PUT' === $verb ) {
            
            if ( NULL === $id ) {
                //if the id is null when the user tries to update then display error message
                throw new InvalidArgumentException('Corp ID ' . $id . ' was not found');
            }else{
                if($resourceData->update($id, $serverData)){
                   $restServer->setMessage("Updated");
                   $restServer->setStatus(201);
                    
                }else {
                throw new Exception('Unable to update');
                }
              
            }
            
        }
        if ( 'DELETE' === $verb ) {
            
            if ( NULL === $id ) {
                //if the id is null when trying to delete a corp then display error message
                throw new InvalidArgumentException('Corp ID ' . $id . ' was not found');
            }else{
                if($resourceData->delete($id)){
                    $restServer->setMessage("Deleted");
                    $restServer->setStatus(201);
                }
                else {
                throw new Exception('Unable to Delete');
                }
            }
            
        }

            
        
        
    } else {
        throw new InvalidArgumentException($resource . ' Resource Not Found');
        
    }
   
    
    /* 400 exeception means user sent something wrong */
} catch (InvalidArgumentException $e) {
    $restServer->setStatus(400);
    $restServer->setErrors($e->getMessage());
    /* 500 exeception means something is wrong in the program */
} catch (Exception $ex) {    
    $restServer->setStatus(500);
    $restServer->setErrors($ex->getMessage());   
}


echo $restServer->getReponse();
die();