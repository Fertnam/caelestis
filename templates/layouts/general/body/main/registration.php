<?php
    if (!empty($_SESSION)) {
?>
        <p>Вы уже авторизованы!</p>
        <div class="email-activating">
            <p>Подтвердите почту</p>
            <p>На указанный e-mail <span></span> выслано письмо с инструкциями для продолжения регистрации.</p>
        </div>
<?php
    } else {
?>
        <h1>Регистрация</h1>
        <p id="registration-message"></p>
        <form id="registration-form" class="form-model" action="/register" method="POST">
            <label for="registration-username-input">Логин:</label>
            <input name="username" id="registration-username-input" type="text">
            <p id="username-message"></p>
            <label for="registration-email-input">E-mail:</label>
            <input name="email" id="registration-email-input" type="email">
            <p id="email-message"></p>
            <label for="registration-password-input">Пароль:</label>
            <input name="password" id="registration-password-input" type="password">
            <p id="password-message"></p>
            <label for="registration-password-repeat-input">Повторите пароль:</label>
            <input name="repeat-password" id="registration-password-repeat-input" type="password">
            <p id="password-repeat-message"></p>
            <input type="hidden" class="recaptcha-input" name="recaptcha">
            <p class="recaptcha-message"><i class="fab fa-google"></i> This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy">Privacy Policy</a> and <a href="https://policies.google.com/terms">Terms of Service</a> apply.</p>
            <input type="submit" value="Зарегистрироваться">
        </form>
<?php
    }      
?>