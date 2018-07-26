<?php

/* 
 * Plugin Name: Livros Plugin
 * Plugin URI: 
 * Description: plugin para administração de coleções de livros
 * Author: Ed Vieira
 * Version: 1.0
 * Author URI:
 * 
 * 
 */

if(!defined( 'ABSPATH' )){
	exit();
}


require_once 'package/livros-post.php';

$app= new Plugin\App();
$app->run();



