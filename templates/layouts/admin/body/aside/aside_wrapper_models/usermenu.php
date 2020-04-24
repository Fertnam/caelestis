<?php
    if (empty($_SESSION)) {
?>
<form class="form-model" id="authorization-form-id">
    <h2>Авторизация</h2>
    <input name="authorization-login-input" id="authorization-login-input-id" type="text" placeholder="&#xf007; Логин">
    <input name="authorization-password-input" id="authorization-password-input-id" type="password" placeholder="&#xf023; Пароль">
    <input type="hidden" class="g-recaptcha-input" name="g-recaptcha-input">
    <p id="authorization-error-message-id"></p>
    <input type="submit" value="Войти">
</form>
<?php
    } else {
?>
<h2 class="h2-with-border">Привет, <span><?= $_SESSION['username'] ?></span>!</h2>
<div class="personal-info-wrapper">
    <div>
        <img src="php/skin.php?user=<?= $_SESSION['username'] ?>&mode=3&size=62" alt="Аватарка">
    </div>
    <ul>
        <?= $_SESSION['site_user_group_id'] == 5 ? "<li><a href=\"\">Админ-панель</a></li>" : null; ?>
        <li><a href="">Личный кабинет</a></li>
        <li><a href="profile.php" class="spa-hyperlink">Профиль игрока</a></li>
        <li><a href="">Пополнить баланс</a></li>
        <li><a href="">Онлайн-магазин</a></li>
        <li><a href="logout.php">Выход</a></li>
    </ul>
</div>
<?php
    }
?>