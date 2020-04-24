<!DOCTYPE html>
<html lang="ru">
    <head>
        <!-- META -->
        <?php
            include_once 'head/general/meta/general.php';
        ?>
        <title><?= $this->pagesComponents['title'] ?></title>

        <!-- CSS -->
        <?php
            include_once 'head/general/css/general.php';
            include_once 'head/general/css/' . $this->pagesComponents['css'];
        ?>
    </head>
    <body>
        <div id="wrapper">
            <header>
                <img id="logo"draggable="false" src="templates/images/logo.png" alt="Логотип">
            </header>
            <nav id="navigation">
                <ul>
                    <?php
                        include_once 'body/general/nav/' . $this->pagesComponents['nav'];
                    ?>
                </ul>
                <button class="button-nav-model" id="start-game-button-id">Пора играть</button>
                <button id="mobile-menu-button-id"><i class="fas fa-bars"></i></button>
            </nav>
            <nav id="mobile-menu-id">
                <ul>
                    <?php
                        include_once 'body/general/mobile_nav/' . $this->pagesComponents['mobile-nav'];
                    ?>
                </ul>
            </nav>
            <main>
                <?php
                    include_once 'body/general/main/' . $this->pagesComponents['main'];
                ?>
            </main>
            <aside>
                <?php
                    include_once 'body/general/aside/aside.php';
                ?>
            </aside>
            <footer>
                <?php
                    include_once 'body/general/footer/footer.php';
                ?>
            </footer>
        </div>
        
        <!-- JS -->
        <?php
            include_once 'body/general/js/general.php';
            include_once 'body/general/js/' . $this->pagesComponents['js'];
        ?>
    </body>
</html>