<?php
/**
 * Created by PhpStorm.
 * User: Lin
 * Date: 2018/1/19
 * Time: 16:31
 */

$server = "localhost";
$username = "root";
$localPassword = "123";
$database = "acmoj0115";

$link = mysqli_connect($server, $username, $localPassword, $database) or die("Connect failed: " . mysqli_connect_error() . "\n");
mysqli_query($link, "SET names utf8");
mysqli_query($link, "SET CHARACTER SET utf8");
mysqli_query($link, "SET COLLATION_CONNECTION='utf8'");