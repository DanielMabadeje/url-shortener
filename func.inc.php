<?php
include 'db.inc.php';
function is_min($url)
{
    return (preg_match("/url\.test/i", $url)) ? true : false;
}

function gen_code()
{
    $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    return substr(str_shuffle($charset), 0, 6);
}
function code_exists($code)
{
    $data=mysqli_connect('localhost', 'root', '', 'min_shortener');
    $code = mysqli_real_escape_string($data, $code);
    $code_exists = mysqli_query($data, "SELECT COUNT(`url_id`) FROM 'urls' WHERE 'code'='$code' LIMIT 1");
    if($code_exists ==true){
        return true;
    }else{
        return false;
    }
}
function shorten($url, $code)
{
    $data=mysqli_connect('localhost', 'root', '', 'min_shortener');
    $url = mysqli_real_escape_string($data, $url);
    $code = mysqli_real_escape_string($data, $code);
    mysqli_query($data, "INSERT INTO `urls` (url, code) VALUES ('$url', '$code')");
    return $code;
}

function redirect($code)
{
    $data=mysqli_connect('localhost', 'root', '', 'min_shortener');
    $code =mysqli_real_escape_string($data, $code);
    // var_dump($code);
    $check_code=code_exists($code);
    // var_dump($check_code);
if($check_code =true){
    $data=mysqli_connect('localhost', 'root', '', 'min_shortener');
    $url_query =mysqli_query($data, "SELECT url FROM urls WHERE code='$code'");
    $url= mysqli_fetch_row($url_query);
    header('location: '.$url[0]);
}
}