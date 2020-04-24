<h1>Банлист</h1>
<div>
    <form id="banned-user-search-form" class="form-model">
        <input type="text" name="username" placeholder="Введите ник игрока">
        <input type="submit" value="Найти">
    </form>
    <table class="table-model banlist-table">
        <thead>
            <tr>
                <td>Нарушитель</td>
                <td>Заблокировал</td>
                <td>Начало</td>
                <td>Окончание</td>
                <td>Причина</td>
            </tr>
        </thead>
        <tbody>
            <?php
                require 'pagination/banlist.php';
            ?>
        </tbody>
    </table>
</div>
<div class="pagination">
    <?= $Pagination->getHTML() ?>
</div>