
<?php
require('gantti/lib/gantti.php'); 
Include ('minecraft-utils/MinecraftParser.php');

$minecraftParser = new MinecraftParser("test/");
$data = $minecraftParser->printInfo();
//echo "<pre/>";
//print_r($data);

date_default_timezone_set('UTC');
setlocale(LC_ALL, 'en_US');

$gantti = new Gantti($data, array(
  'title'      => 'Minecraft',
  'cellwidth'  => 50,
  'cellheight' => 35,
  'today'      => true
));


?>


<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Minecraft Gantt Chart nach Mahatma Gantti </title>
  <meta charset="utf-8" />

  <link rel="stylesheet" href="gantti/styles/css/screen.css" />
  <link rel="stylesheet" href="gantti/styles/css/gantti.css" />

  <!--[if lt IE 9]>
  <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

</head>

<body>

<header>

<h1>Minecraft Gantt Chart</h1>
<h2>A overview in hours</h2>

</header>

<?php echo $gantti ?>


</body>


</html>
