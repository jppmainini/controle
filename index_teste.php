<?php
/**
 * Created by PhpStorm.
 * User: Jeferson
 * Date: 17/08/2018
 * Time: 15:46
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>ola mundo</h1>
<?php
$url = (isset($_GET['url'])) ? $_GET['url']:'';
$url = array_filter(explode('/', $url));
var_dump($url);
echo '<br>';

?>
</body>
</html>
