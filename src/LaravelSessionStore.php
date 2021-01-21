<?php

namespace Emodyz\Flash;

use Illuminate\Session\Store;
use Illuminate\Support\Collection;

class LaravelSessionStore implements SessionStore
{
    /**
     * @var Store
     */
    private Store $session;

    /**
     * Create a new session store instance.
     *
     * @param Store $session
     */
    function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Flash a message to the session.
     *
     * @param string $name
     * @param Collection $data
     */
    public function flash(string $name, Collection $data)
    {
        $this->session->flash($name, $data);
    }
}
