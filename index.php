<?php

require("Emoji.php");

$msgs = [
    '你好[亲亲]',
    '[调皮][调皮][调皮][调皮]',
    '真不错[赞]',
    '加油[胜利]',
    '老司机[捂脸][捂脸][捂脸][捂脸]',
]
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>表情输入</title>
    <link rel="stylesheet" href="css/main.css"/>
</head>
<body>
<div class="wrap">
    <table>
        <?php foreach ($msgs as $msg): ?>
            <tr>
                <td><?= $msg ?></td>
                <td><?= Emoji::replaceStrToEmoji($msg) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <div class="textarea" contenteditable="true"></div>
    <div class="controls">
        <span class="biaoqing"></span>
        <button class="btn-send">发送</button>
    </div>
</div>

<script src="js/libs/jquery-3.3.1.min.js"></script>
<script src="js/emoji.js"></script>
<script>
    var $biaoqing = $(".biaoqing");
    var $textarea = $(".textarea");

    emoji.init($biaoqing, $textarea);

    $(".btn-send").click(function () {
        var content = emoji.getContent();
        var html = emoji.getHtml();

        if (content != "") {
            $("table tbody").append("<tr><td>" + content + "</td><td>" + html + "</td></tr>");
            $textarea.html("");
        }
    });
</script>
</body>
</html>
