<?php

use Emodyz\Flash\FlashNotifier;

if (! function_exists('flash')) {

    /**
     * Arrange for a flash message.
     *
     * @param  string|null $title
     * @param  string|null $message
     * @param  string      $level
     * @return FlashNotifier
     */
    function flash($title = null, $message = null, $level = 'info'): FlashNotifier
    {
        $notifier = app('flash');

        if (! is_null($message) && ! is_null($title)) {
            return $notifier->message($title, $message, $level);
        }

        return $notifier;
    }

}
