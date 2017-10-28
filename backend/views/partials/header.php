<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="logo-box">
                <a href="/">小林后台信息管理系统</a>
            </div>

            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        Hi，<?= Yii::$app->user->identity->username ?>
                    </a>
                </li>
                <li>
                    <a href="<?= route('site/logout') ?>">退出</a>
                </li>
            </ul>
        </div>
    </div>
</nav>