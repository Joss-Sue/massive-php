<?php

$zipcode = '';

const API_URL = "http://localhost/apirestphp/index.php/?zip=20115";
$result= file_get_contents(API_URL);

$result = json_decode($result, true);

print_r($result);

//echo '<script>alert("'.$result.'")</script>;';

?>

