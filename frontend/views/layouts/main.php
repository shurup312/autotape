<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/js/vendor/jquery.fancybox/jquery.fancybox.css">
    <link rel="stylesheet" href="/js/vendor/slick/slick.css">
    <link rel="stylesheet" href="/js/vendor/mb2comparison/mb2comparison.css">
    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<?php $this->beginBody() ?>
<!-- Header  -->
    <header class="header">
    <div class="container">
        <div class="header-top">
            <a href="/" class="header-logo ir"></a>
            <div class="header-address">
                <span>Москва, мкр. Новокосино, ул. Салтыковская, д.53</span>
                <span>Ежедневно с 9:00 до 20:00</span>
            </div>
            <span class="header-phone"><span class="code">+7 (985)</span> 222-21-31</span>
            <span class="header-phone"><span class="code">+7 (926)</span>  169-23-13</span>
        </div>
        <div class="clearfix">
            <nav class="header-nav">
                <ul>
                    <li><a href="#">Защитные пленки</a></li>
                    <li><a href="#">Кузовные работы</a></li>
                    <li><a href="#">Тонирование</a></li>
                    <li><a href="#">Полировка</a></li>
                    <li><a href="#">Контакты</a></li>
                </ul>
                <a href="#form-request-block" class="leave-request">Отправить заявку</a>
            </nav>
            <div class="header-service clearfix">
                <a class="item1" href="#"><span>Защитная пленка</span></a>
                <a class="item2" href="#"><span>Тонирование</span></a>
                <a class="item3" href="#"><span>Полировка</span></a>
            </div>
        </div>
    </div>
</header>    
<!-- End of Header  -->

<?= $content ?>


    <!-- Footer -->
    <div class="form-request-block" id="form-request-block">
    <div class="container">
        <div class="form-request form-request-start">
            <form class="form-request-body">
                <div class="form-request-title">Оставьте заявку</div>
                <p>И близжайшее время с вами сяжется наш специалист</p>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Имя" data-validation="required" data-validation-error-msg="необходимо заполнить">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Телефон" data-validation="email" data-validation-error-msg="Укажите корректный email">
                </div>
                <button type="submit" class="btn btn-gray">отправить</button>
            </form>
        </div>
        <div class="form-request form-request-success">
            <div class="form-request-title">Спасибо за обращение!</div>
            <p>В близжайшее время с вами сяжется наш специалист</p>
            <span class="btn btn-gray">Закрыть</span>
        </div>
    </div>
</div>    <!-- End of Footer -->

    <!-- Footer -->
    <footer class="footer">
    <div class="container">
        <div class="footer-top">
            <span class="ogr-name">Тонировка Авто ©</span>
            <span class="org-location">Тонировка в Новокосино</span>
        </div>
        <nav class="footer-nav">
            <ul class="clearfix">
                <li><a href="#">Защитные пленки</a></li>
                <li><a href="#">Кузовные работы </a></li>
                <li><a href="#">Тонирование</a></li>
                <li><a href="#">Полировка</a></li>
                <li><a href="#">Контакты</a></li>
            </ul>
        </nav>
        <div class="footer-social">
            <div class="social-title">Поделиться с друзьями:</div>
            <ul class="clearfix">
                <li><a class="vk ir" href="#">Вконтакте</a></li>
                <li><a class="ok ir" href="#">Одноклассники</a></li>
                <li><a class="yandex ir" href="#">Яндекс</a></li>
                <li><a class="mailru ir" href="#">Mail.ru</a></li>
                <li><a class="fb ir" href="#">Facebook</a></li>
                <li><a class="tw ir" href="#">Twitter</a></li>
                <li><a class="soc01 ir" href="#">Social Network</a></li>
                <li><a class="li ir" href="#">Life Internet</a></li>
            </ul>
        </div>
    </div>
</footer>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script src="/js/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="/js/vendor/jquery.fancybox/jquery.fancybox.pack.js"></script>
<script src="/js/vendor/mb2comparison/mb2comparison.js"></script>
<script src="/js/vendor/jquery.form-validator.min.js"></script>
<script src="/js/vendor/slick/slick.min.js"></script>
<script src="/js/main.js"></script>    <!-- End of Footer -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
