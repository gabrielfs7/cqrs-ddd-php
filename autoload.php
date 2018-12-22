<?php declare(strict_types=1);

spl_autoload_register(
    function ($className) {
        $file = str_replace(
            'Sample' . DIRECTORY_SEPARATOR,
            '',
            str_replace(
                '\\',
                DIRECTORY_SEPARATOR,
                $className
            )
        ) . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }
);
