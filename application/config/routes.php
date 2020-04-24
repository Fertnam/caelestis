<?php
    return [
        /**
         * Вывод страниц
         */
        '^$' => 'controllers\layouts\general/index',
        '^page-([0-9]+)$' => 'controllers\layouts\general/index/$1',
        '^banlist$' => 'controllers\layouts\general/tempbans',
        '^banlist/page-([0-9]+)$' => 'controllers\layouts\general/tempbans/$1',
        '^banlist/pernaments$' => 'controllers\layouts\general/pernamentbans',
        '^banlist/pernaments/page-([0-9]+)$' => 'controllers\layouts\general/pernamentbans/$1',
        '^donate$' => 'controllers\layouts\general/basic/donate',
        '^rules$' => 'controllers\layouts\general/basic/rules',
        '^registration$' => 'controllers\layouts\general/basic/registration',
        '^profile$' => 'controllers\layouts\general/basic/profile',

        /**
         * Работа с пользователем
         */
        '^authorization/launcher/(.*)/(.*)$' => 'controllers\user\authorization/launcher/$1/$2',
        '^authorization/(.*)/(.*)$' => 'controllers\user\authorization/site/$1/$2',
        '^register$' => 'controllers\user\registration/complex',
        '^activation/(.*)$' => 'controllers\user\activation/complex/$1',
        '^validator/username/(.*)$' => 'controllers\user\validation/username/$1',
        '^validator/email/(.*)$' => 'controllers\user\validation/email/$1',
        '^validator/password/(.*)/(.*)$' => 'controllers\user\validation/password/$1/$2'
    ];
?>