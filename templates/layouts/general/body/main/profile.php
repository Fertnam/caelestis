<?php
    if (empty($_SESSION)) {
?>
        <p>Для просмотра содержимого необходимо авторизоваться!</p>
<?php
    } else {
?>
        <h1>Профиль игрока</h1>
        <div id="profile-wrapper">
            <div>
                <img id="back-profile-skin-img-id" src="/app/components/skin.php?user=<?= $_SESSION['username'] ?>&mode=2&size=205" alt="Задняя часть скина">
                <img id="front-profile-skin-img-id" src="/app/components/skin.php?user=<?= $_SESSION['username'] ?>&mode=1&size=205" alt="Передняя часть скина">
            </div>
            <div>
                <table class="table-model profile-table without-general-adaptive">
                    <tr>
                        <td>Ник</td>
                        <td><?= $_SESSION['username']; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?= $_SESSION['email']; ?></td>
                    </tr>
                    <tr>
                        <td>Группа</td>
                        <td><?= $_SESSION['group']['name']; ?></td>
                    </tr>
                    <tr>
                        <td>Дата регистрации</td>
                        <td><?= $_SESSION['registration_time']; ?></td>
                    </tr>
                    <tr>
                        <td>Баланс</td>
                        <td><?= $_SESSION['balance'] . ' руб'; ?></td>
                    </tr>
                </table>
                <div class="profile-change-wrapper">
                    <div>
                        <button id="email-change-button"><i class="fas fa-plus"></i>Смена email</button>
                        <form id="email-change-form" class="form-model" method="post">
                            <label for="">Новый email:</label>
                            <input type="email" name="email">
                            <label for="">Ваш пароль:</label>
                            <input type="password" name="password">
                            <input type="submit" value="Изменить">
                        </form>
                    </div>
                    <div>
                        <button id="password-change-button"><i class="fas fa-plus"></i>Смена пароля</button>
                        <form id="password-change-form" class="form-model" method="post">
                            <label for="">Старый пароль:</label>
                            <input type="password" name="old-password">
                            <label for="">Новый пароль:</label>
                            <input type="password" name="new-password">
                            <label for="">Повторите новый пароль:</label>
                            <input type="password" name="repeat-new-password">
                            <input type="submit" value="Изменить">
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
?>