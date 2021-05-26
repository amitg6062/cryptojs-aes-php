<?php
include("../cryptojs-aes.php");
echo "<pre>";
print_r($_POST);
echo "123<br/>";
echo cryptoJsAesDecrypt($_POST["pass"], $_POST["json1"]);
echo "<br/>";
echo cryptoJsAesDecrypt($_POST["pass"], $_POST["json2"]);
echo "<br/>";
