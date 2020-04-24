<!DOCTYPE html>
<html lang="ru">
    <head>
        <!-- META -->
        <?php
            require 'head/meta/basic.php';
        ?>
        <title><?= $this->_pagesComponents['title'] ?></title>
        
        <!-- FAVICON -->
        <link rel="icon" href="/templates/images/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="/templates/images/favicon.ico" type="image/x-icon">

        <!-- CSS -->
        <?php
            require 'head/css/basic.php';
            require "head/css/pages/{$this->_pagesComponents['content']}.php";
        ?>
    </head>
    <body>
        <div id="wrapper">
            <header>
                <img id="logo" draggable="false" src="/templates/images/logo.png" alt="Логотип">
            </header>
            <nav id="menu">
                <button id="mobile-menu-button"><i class="fas fa-bars"></i></button>
                <ul>
                    <?php
                        require "body/nav/{$this->_pagesComponents['navigation']}.php";
                    ?>
                </ul>
                <button id="start-game-button">Пора играть</button>
            </nav>
            <nav id="mobile-menu">
                <ul>
                    <?php
                        require "body/nav/{$this->_pagesComponents['navigation']}.php";
                    ?>
                </ul>
            </nav>
            <main>
                <?php
                    require "body/main/{$this->_pagesComponents['content']}.php";
                ?>
            </main>
            <aside>
                <?php
                    require 'body/aside/aside.php';
                ?>
            </aside>
            <footer>
                <p>Копирование элементов дизайна запрещено</p>
            </footer>
        </div>
        
        <!-- JS -->
        <?php
            require 'body/js/basic.php';
            require "body/js/pages/{$this->_pagesComponents['content']}.php";
        ?>
    </body>
</html>