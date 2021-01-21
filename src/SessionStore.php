<?php

namespace Emodyz\Flash;

use Illuminate\Support\Collection;

interface SessionStore
{
    /**
     * Flash a message to the session.
     *
     * @param string $name
     * @param Collection $data
     */
    public function flash(string $name, Collection $data);
}
