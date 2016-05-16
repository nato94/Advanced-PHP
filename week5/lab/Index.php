<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <!-- call to main css file -->
        <link rel="stylesheet" href="./api/v1/css/main.css">
    </head>
    <body>

        <h2>Corporations</h2>
        
        <p>Method:</p>
        <select name="verb">
            <option value="GET">GET</option>
            <option value="POST">POST</option>
            <option value="PUT">PUT</option>
            <option value="DELETE">DELETE</option>
        </select>
        <br />
        <br />
        <p>Resource for endpoint: (add / and the id of the corp if you wish to find one corp)</p>
        <br />
        <input name="resource" value="corps" />
        <br />
        <p>Corporation:</p>   
        <input type="text" name="corp" value="" />
        <br />
        <p>Found On: </p>
        <input type="date" name="incorp_dt" value="" />
        <br />
        <p> Email:</p> <input type="email" name="email" value="" />
        <br />
        <p>Owner:</p> <input type="text" name="owner" value="" />
        <br />
        <p>Phone:</p> <input type="text" name="phone" value="">
        <br />
        <p>Location:</p> <input id="address" type="text" placeholder="Enter address here" name='address' />
        <br />
        <br />        
        <div id="coder"style="display: none;">
           <p>Location:
            <input type="text" id="local" readonly name="local" />
           </p>
        </div>
        <button>Make Call</button>
        
        <p>Results</p>
        <textarea name="results"></textarea>
        

        <?php  require_once './api/v1/models/autoload.php'; ?>
        
        <script type="text/javascript">
            
            function getLocation(callback, address) {
                // If adress is not supplied, use default value
                address = address || 'United States,Rhode Island, East Greenwich';
                // Initialize the Geocoder
                geocoder = new google.maps.Geocoder();
                if (geocoder) {
                    geocoder.geocode({
                        'address': address
                    }, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            callback(results[0]);
                        }
                    });
                }
            }//end getLocation function
            
            function displayResults(result) {
                document.getElementById('local').value = result.geometry.location;
            }
            
            var btn = document.querySelector('button');
            
            btn.addEventListener('click', function () {
                //get the address
                var address = document.getElementById('address').value;
                //get the latitude and longitude
                getLocation(displayResults, address); 
                //get the type (Post, get, etc)
                var verbfield = document.querySelector('select[name="verb"]');
                //verb added to an array
                var verb = verbfield.options[verbfield.selectedIndex].value;
                //get the resource needed
                var resource = document.querySelector('input[name="resource"]').value;

                //display the data based on the input
                var data = {
                    'corp' : document.querySelector('input[name="corp"]').value,
                    'incorp_dt' : document.querySelector('input[name="incorp_dt"]').value,
                    'email' : document.querySelector('input[name="email"]').value,
                    'owner' : document.querySelector('input[name="owner"]').value,
                    'phone' : document.querySelector('input[name="phone"]').value,
                    'location':document.querySelector('input[name="local"]').value
                }; 
                //set the values 
                var results = document.querySelector('textarea[name="results"]');
                //set results to display in the textarea
                var xmlhttp = new XMLHttpRequest();
                //set the url for the resource
                var url = './api/v1/' + resource;
                xmlhttp.open(verb, url, true);
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState === 4 ) {

                        console.log(xmlhttp.responseText);
                        results.value = xmlhttp.responseText;
                       
                    } //end if 
       
                };//end onreadystatechange function
                


                 if ( verb === 'GET' ) {
                      xmlhttp.send(null);
                 } 
                 else {
                    xmlhttp.setRequestHeader('Content-type','application/json;charset=UTF-8');
                    xmlhttp.send(JSON.stringify(data));
                }
                if ( verb === 'POST' ) {
                      xmlhttp.send(null);
                 } 
                 else {
                    xmlhttp.setRequestHeader('Content-type','application/json;charset=UTF-8');
                    xmlhttp.send(JSON.stringify(data));
                }
                if ( verb === 'PUT' ) {
                      xmlhttp.send(null);
                 } 
                 else {
                    xmlhttp.setRequestHeader('Content-type','application/json;charset=UTF-8');
                    xmlhttp.send(JSON.stringify(data));
                }
            });
        </script>

    </body>
</html>
