<?php 

/*
 * USE: insert this in the script of the work you want to know how many people visited it.
 * 
 
 $.ajax({
      type: "POST",
      url: "/ajax/counter.php"
      //data: data,
      //success: success,
      //dataType: dataType
    });
     
  
 * 
 */

$servername = "localhost";
$username = "root"; // "eldile5_edd_user";
$password = ""; //3n0ur4NC3!";
$dbname = "eldile5_edd_db";
$ip = getUserIP();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    exit(); //die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO counter (ip) VALUES ('$ip')";

if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

