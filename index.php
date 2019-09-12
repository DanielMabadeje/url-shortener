<?php
include'func.inc.php';
if (isset($_GET['code']) && !empty($_GET['code'])){
    $code = $_GET['code'];
    redirect($code);
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>URL shortener</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
    <script src="jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#url').focus();
        });

        function go(url) {
            $.post('url.php', { url: url}, function(data) {
                    if (data == 'error_no_url') {
                        $('#message').html('<p>no URL specified</p>');
                    } else if(data=='error_invalid_url'){
                        $('#message').html('<p>not valid URL</p>');

                    }else if(data=='error_is_min'){
                        $('#message').html('<p>Already a url here</p>');
                    }else{
                        $('#url').val(data);
                        $('#url').select();
                        $('#message').html('<p>Successfully Shortened you URL</p>');
                    }
                });
        }
    </script>
</head>

<body>
    <div id="container">
        <h1>its simple url.test</h1>
        <p>Have it shortened now...save the stress</p>
        <p><input type="" name="url" id="url" size="60" onkeydown="if(event.keyCode == 13 || event.which == 13){go($('#url').val()); }" /><input type="button" value="Shorten" onclick="go($('#url').val());"></p>

        <div id="message">
            <p>&nbsp;</p>
        </div>
        <div id="copyright">&copy; Daniel Mabadeje</div>
    </div>
</body>

</html>