<?php
    return [
        /**
         * Вывод страниц
         */
        '^$' => 'controllers\layouts\General/index',
        '^page-([0-9]+)$' => 'controllers\layouts\General/index/$1',
        '^banlist$' => 'controllers\layouts\General/tempbans',
        '^banlist/page-([0-9]+)$' => 'controllers\layouts\General/tempbans/$1',
        '^banlist/pernaments$' => 'controllers\layouts\General/pernamentbans',
        '^banlist/pernaments/page-([0-9]+)$' => 'controllers\layouts\General/pernamentbans/$1',
        '^donate$' => 'controllers\layouts\General/basic/donate',
        '^rules$' => 'controllers\layouts\General/basic/rules',
        '^registration$' => 'controllers\layouts\General/basic/registration',
        '^profile$' => 'controllers\layouts\General/basic/profile',

        /**
         * Работа с пользователем
         */
        '^auth/launcher\?username=(.*)&password=(.*)$' => 'controllers\user\Authorization/launcher/$1/$2',
		'^auth/mobile/(.*)/(.*)$' => 'controllers\user\Authorization/mobile/$1/$2',
        '^auth/(.*)/(.*)$' => 'controllers\user\Authorization/site/$1/$2',
        '^register$' => 'controllers\user\Registration/complex',
        '^activation/(.*)$' => 'controllers\user\Activation/complex/$1',
        '^validator/username/(.*)$' => 'controllers\user\Validation/username/$1',
        '^validator/email/(.*)$' => 'controllers\user\Validation/email/$1',
        '^validator/password/(.*)/(.*)$' => 'controllers\user\Validation/password/$1/$2'
    ];
?>