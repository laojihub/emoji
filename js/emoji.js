/**
 * 选择表情&表情输入
 */
!(function (e) {
    var iconUrl = "http://localhost:8888/img/emoji/";
    var icons = [
        {id: 101, desc: '亲亲'},
        {id: 102, desc: '小声'},
        {id: 103, desc: '酷'},
        {id: 104, desc: '恐怖'},
        {id: 105, desc: '不开心'},
        {id: 106, desc: '吐'},
        {id: 107, desc: '调皮'},
        {id: 108, desc: '色色'},
        {id: 109, desc: '晕'},
        {id: 110, desc: '傻笑'},
        {id: 111, desc: '哭笑'},
        {id: 112, desc: '下'},
        {id: 113, desc: '上'},
        {id: 114, desc: '赞'},
        {id: 115, desc: 'low'},
        {id: 116, desc: '右'},
        {id: 117, desc: '左'},
        {id: 118, desc: '胜利'},
        {id: 119, desc: 'OK'},
        {id: 120, desc: '再见'},
        {id: 121, desc: '鼓掌'},
        {id: 122, desc: '加油'},
        {id: 123, desc: '彩带'},
        {id: 124, desc: '捂脸'},
        {id: 125, desc: '心碎'},
        {id: 126, desc: '爱心'},
        {id: 127, desc: '女医生'},
        {id: 128, desc: '男医生'},
        {id: 129, desc: '无奈'},
        {id: 130, desc: '停止'},
        {id: 131, desc: '粑粑'},
        {id: 132, desc: '牛逼'},
        {id: 133, desc: '救护车'},
        {id: 134, desc: '水滴'},
        {id: 135, desc: '药'},
        {id: 136, desc: '花'},
        {id: 137, desc: '蔬菜'},
        {id: 138, desc: '水果'},
        {id: 139, desc: '吃饭'},
        {id: 140, desc: '干杯'},
        {id: 141, desc: '鸡腿'},
        {id: 142, desc: '无'},
        {id: 143, desc: '有'},
        {id: 144, desc: '奶瓶'},
        {id: 145, desc: '100分'},
        {id: 146, desc: '礼物'}
    ];


    var $box;

    var $target;

    var $content;


    var createElement = function () {
        var $ul = $("<ul class='face-list'></ul>");
        icons.map(function (icon) {
            $li = $("<li data-id='" + icon.id + "' title='" + icon.desc + "'></li>");
            $li.click(function () {
                addfaceContent($(this).attr("data-id"), $(this).attr("title"));
            });
            $ul.append($li);
        });
        $box.append($ul);
    };

    var showFaces = function ($element) {
        $box = $(document.body).find(".face-list-wrap");
        //已经创建了，就直接显示
        if ($box.length > 0) {
            $box.css("top", $element.offset().top + 46 + "px");
            $box.css("left", $element.offset().left - 21 + "px");
            $box.fadeIn(200);
            return false;
        }
        //重新创建
        $box = $("<div class='face-list-wrap'></div>");
        $box.css("top", $element.offset().top + 46 + "px");
        $box.css("left", $element.offset().left - 21 + "px");

        //点击其他地方时隐藏表情
        $(document.body).click(function (e) {
            if ($(e.target).closest(".face-list-wrap,.biaoqing").length < 1) {
                hideFaces();
            }
        });

        createElement();
        $(document.body).append($box);
    };


    var hideFaces = function () {
        $box.fadeOut(200);
    };


    var addfaceContent = function (id, title) {
        $content.focus();

        var src = iconUrl + id + ".png";
        var img = new Image();
        img.src = src;
        img.title = title;
        img.className = 'emoji';


        $content.append(img);
    };


    var replaceImgToStr = function (content) {
        var imgReg = /<img.*?(?:>|\/>)/gi;
        content = $.trim(content);
        content = content.replace(imgReg, function (img) {
            var $img = $(img);
            return "[" + $img.attr("title") + "]";

        });
        return content;
    };


    var getContent = function () {
        var content = $content.html();
        var imgReg = /<img.*?(?:>|\/>)/gi;

        content = content.replace(imgReg, function (img) {
            var $img = $(img);
            return "[" + $img.attr("title") + "]";
        });

        return content;
    };

    var getHtml = function () {
        return $content.html();
    };

    var init = function ($btn, $input) {
        $target = $btn;
        $content = $input;

        $target.click(function () {
            showFaces($btn);
        });
    };

    e.emoji = {
        init: init,
        getContent: getContent,
        getHtml: getHtml
    };
})(window);
