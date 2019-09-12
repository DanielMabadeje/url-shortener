<?php
include 'func.inc.php';
if (isset($_POST['url'])) {
    $url = trim($_POST['url']);
    if (empty($url)) {
        echo 'error_no_url';
    } elseif (filter_var($url, FILTER_VALIDATE_URL) === false) {
        echo 'error_invalid_url';
    } elseif (is_min($url)) {
        echo 'error_is_min';
    } else {
        // $code =gen_code();
        while(!code_exists($code = gen_code())){
        echo 'http://url.test/'.shorten($url, $code);
        break 1;
        // echo 'http://url.test/'.$code;
        // echo ($url);
        }
    }
}
