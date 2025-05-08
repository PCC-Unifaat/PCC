<?php 
    if(isset($_GET['url'])){
        $url = explode('/',$_GET['url']);
        $url = $url[0];
    }else
        $url = 'inicio';

    

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="description" content=''>
    <meta name="keywords" content="">
    <meta name="author" content="Kevin Freire">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">

    <link rel="icon" type="image/x-icon" href="<?php echo INCLUDE_PATH;?>favicon.ico">
    <title><?php echo $title?></title>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_STATIC?>css/style.css">
    <?php foreach ($css as $key => $value) { ?>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_STATIC?>css/<?php echo $value?>.css">
	<?php } ?>


</head>
<body>