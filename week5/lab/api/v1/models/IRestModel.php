<?php

/**
 *
 * @author GFORTI
 */
interface IRestModel {
    //put your code here
    function getAllCorps();
    function getCorp($id); 
    function post($serverData);
    function update($id,$serverData);
    function delete($id);
}
