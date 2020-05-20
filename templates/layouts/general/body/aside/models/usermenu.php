<?php
    if (empty($_SESSION)) {
?>
        <form class="form-model" id="authorization-form" action="/register/mobile" method="POST">
            <h2>Авторизация</h2>
            <input name="username" id="authorization-username-input" type="text" placeholder="&#xf007; Логин">
            <input name="password" id="authorization-password-input" type="password" placeholder="&#xf023; Пароль">
            <input type="hidden" class="g-recaptcha-input" name="recaptcha">
            <p id="authorization-error"></p>
            <input type="submit" value="Войти">
        </form>
<?php
    } else {
?>
<h2 class="aside-h2-with-border">Привет, <span><?= $_SESSION['username'] ?></span>!</h2>
<div id="usermenu-wrapper">
    <div>
        <img src="/app/components/skin.php?user=<?= $_SESSION['username'] ?>&mode=3&size=62" alt="Аватарка">
    </div>
    <ul>
        <?= $_SESSION['cs_group_id'] >= 3 ? "<li><a href=\"\">Админ-панель</a></li>" : null; ?>
        <li><a href="">Личный кабинет</a></li>
        <li><a href="/profile">Профиль игрока</a></li>
        <li><a href="">Пополнить баланс</a></li>
        <li><a href="">Онлайн-магазин</a></li>
        <li><a href="">Выход</a></li>
    </ul>
</div>
<?php
    }
?>