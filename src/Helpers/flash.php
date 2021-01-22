<?php

use Emodyz\Flash\FlashNotifier;

if (!function_exists('flash')) {

    /**
     * Arrange for a flash message.
     *
     * @param string $title
     * @param string|null $message
     * @param string $level
     * @return FlashNotifier
     */
    function flash(string $title, $message = null, $level = ''): FlashNotifier
    {
        $notifier = app('flash');

        if (!is_null($title)) {
            return $notifier->message($title, $message, $level);
        }

        return $notifier;
    }

}
