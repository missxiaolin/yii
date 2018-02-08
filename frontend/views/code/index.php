<div class="site-index">
    <div class="popup">
        <h2>弹出式Demo，使用ajax形式提交二次验证码所需的验证结果值</h2>
        <br>
        <p>
            <label>用户名：</label>
            <input id="username1" class="inp" type="text" value="极验验证">
        </p>
        <br>
        <p>
            <label>密&nbsp;&nbsp;&nbsp;&nbsp;码：</label>
            <input id="password1" class="inp" type="password" value="123456">
        </p>

        <br>
        <input class="btn" id="popup-submit" type="submit" value="提交">

        <div id="popup-captcha"></div>
    </div>
    <form class="popup" action="/api/code/verify" method="post">
        <h2>嵌入式Demo，使用表单形式提交二次验证所需的验证结果值</h2>
        <input class="inp" name="type" type="hidden" value="pc">
        <br>
        <p>
            <label for="username2">用户名：</label>
            <input class="inp" id="username2" type="text" value="极验验证">
        </p>
        <br>
        <p>
            <label for="password2">密&nbsp;&nbsp;&nbsp;&nbsp;码：</label>
            <input class="inp" id="password2" type="password" value="123456">
        </p>

        <div id="embed-captcha"></div>
        <p id="wait" class="show">正在加载验证码......</p>
        <p id="notice" class="hide">请先拖动验证码到相应位置</p>

        <br>
        <input class="btn" id="embed-submit" type="submit" value="提交">
    </form>
    <br><br>
    <hr>
    <br><br>
    <div class="popup-mobile">
        <h2>移动端手动实现弹出式Demo</h2>
        <br>
        <p>
            <labe for="username3">用户名：</labe>
            <input id="username3" class="inp" type="text" value="极验验证">
        </p>
        <br>
        <p>
            <label for="password3">密&nbsp;&nbsp;&nbsp;&nbsp;码：</label>
            <input id="password3" class="inp" type="password" value="123456">
        </p>
        <br>
        <input class="btn" id="popup-submit-mobile" type="submit" value="提交">
        <div id="mask"></div>
        <div id="popup-captcha-mobile"></div>
    </div>
</div>
