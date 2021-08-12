<?php

namespace FORM\Core;

class Helper extends Singleton
{
    /**
     * @return array|string|string[]
     */
    public function replacePath($path)
    {

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {

            $path = str_replace('/', '\\'.'\\', $_SERVER['DOCUMENT_ROOT'].$path);

        } else {

            $path = $_SERVER['DOCUMENT_ROOT'].$path;
        }

        return $path;

    }
}