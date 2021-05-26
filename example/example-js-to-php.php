<?php error_reporting(E_ALL); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>CryptoJS AES and PHP</title>
        <script type="text/javascript" src="aes.js"></script>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="../aes-json-format.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(document.d).find(".val, .pass, .rahul").on("keyup init", function () {
                    document.d.json.value = CryptoJS.AES.encrypt(JSON.stringify(document.d.val.value), document.d.pass.value, {format: CryptoJSAesJson}).toString();
                    document.d.json2.value = CryptoJS.AES.encrypt(JSON.stringify(document.d.val2.value), document.d.pass.value, {format: CryptoJSAesJson}).toString();
//                    document.d.json.value = CryptoJS.AES.encrypt(JSON.stringify(document.d.val.value), document.d.pass.value, {format: CryptoJSAesJson}).toString();
//                    document.d.json2.value = CryptoJS.AES.encrypt(JSON.stringify(document.d.val2.value), document.d.pass.value, {format: CryptoJSAesJson}).toString();
                }).trigger("init");
            });
        </script>
    </head>
    <body>
        <h1>CryptoJS AES and PHP</h1>
        <h2>Example to encrypt with CryptoJS on client side and decrypt on PHP side</h2>
        <?php
        echo "<pre>";
        print_r($_POST);
        if (isset($_POST["decrypt"])) {
            include("../cryptojs-aes.php");
            ?>
            After POst
            <!--Json value received: <input type="text" value="<?php // echo htmlentities($_POST["json"])                                            ?>" size="90" disabled="disabled"/><br/>-->
            <!--Passphrase: <input type="text" value="<?php // echo $_POST["pass"]                                              ?>" size="90" disabled="disabled"/><br/>-->
            <!--Passphrase: <input type="text" value="<?php // echo $_POST["rahul"]                                              ?>" size="90" disabled="disabled"/><br/>-->
            Decrypted value: <input type="text" value="<?php echo cryptoJsAesDecrypt($_POST["pass"], $_POST["json"]) ?>" size="45" disabled="disabled"/><br/>
            Decrypted value 2 : <input type="text" value="<?php echo cryptoJsAesDecrypt($_POST["pass"], $_POST["json2"]) ?>" size="45" disabled="disabled"/><br/>
            <hr/>
            <br/><br/>
            <?php
        }
        ?>
        <form name="d" method="post" action="">
            Before post
            Value to encrypt: <input type="text"  name="val" value="My string - Could also be an JS array/object" class="val" size="45"/><br/>
            Pass phrase: <input type="text" name="pass" id="pass" class="pass" value="my secret passphrase" size="45"/><br/>
            Value to encrypt 2 : <input type="text"  name="val2" value="My string - Could also be an JS array/object" class="val" size="45"/><br/>
            Pass phrase 2 : <input type="hidden" name="pass2" class="pass" value="my secret passphrase" size="45"/><br/>
            CryptoJS encrypted json output: <input type="text" name="json" id="json1" class="json" size="90" onclick="this.select()"/>
            CryptoJS encrypted json output: <input type="text" name="json2" id="json2" class="json2" size="90" onclick="this.select()"/>
            <input type="button" id="decrypt" value="Send to server and decrypt"/>
        </form>
    </body>
    <script>
        $(document).ready(function () {
            $("#decrypt").click(function () {
                pass = $("#pass").val();
                json1 = $("#json1").val();
                json2 = $("#json2").val();
                $.ajax({
                    url: "example-js-to-php-post.php",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        id: 2, json1: json1, json2: json2, pass: pass
                    },
                    success: function (data)
                    {

                    }
                });
            });
        });
    </script>
</html>
