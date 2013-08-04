<?php
use Cygnite\Helpers\Url as Url;
use Cygnite\Helpers\Assets as Assets;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
        <title><?php echo $this->layoutparams['title']; ?> </title>
        <?php echo Assets::addstyle('webroot/css/cygnite/style.css'); ?>
    </head>
    <body>

        <div class="header" align="center"><?php echo $this->layoutparams['header_title']; ?> </div>