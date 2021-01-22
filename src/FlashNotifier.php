<?php

namespace Emodyz\Flash;

use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Macroable;

class FlashNotifier
{
    use Macroable;

    /**
     * The session store.
     *
     * @var SessionStore
     */
    protected SessionStore $session;

    /**
     * The messages collection.
     *
     * @var Collection
     */
    public Collection $messages;

    /**
     * Create a new FlashNotifier instance.
     *
     * @param SessionStore $session
     */
    function __construct(SessionStore $session)
    {
        $this->session = $session;
        $this->messages = collect();
    }

    /**
     * Flash an information message.
     *
     * @param string|null $title
     * @param string|null $message
     * @return $this
     */
    public function info($title = null, $message = null): FlashNotifier
    {
        return $this->message($title, $message, 'info');
    }

    /**
     * Flash a success message.
     *
     * @param  string|null $title
     * @param  string|null $message
     * @return $this
     */
    public function success($title = null, $message = null): FlashNotifier
    {
        return $this->message($title, $message, 'success');
    }

    /**
     * Flash a danger message.
     *
     * @param  string|null $title
     * @param  string|null $message
     * @return $this
     */
    public function danger($title = null, $message = null): FlashNotifier
    {
        return $this->message($title, $message, 'danger');
    }

    /**
     * Flash an error message.
     *
     * @param  string|null $title
     * @param  string|null $message
     * @return $this
     */
    public function error($title = null, $message = null): FlashNotifier
    {
        return $this->message($title, $message, 'error');
    }

    /**
     * Flash a warning message.
     *
     * @param  string|null $title
     * @param  string|null $message
     * @return $this
     */
    public function warning($title = null, $message = null): FlashNotifier
    {
        return $this->message($title, $message, 'warning');
    }

    /**
     * Flash a general message.
     *
     * string|null $title
     * @param string| null $title
     * @param string| null $message
     * @param string $level
     * @return $this
     */
    public function message($title = null, string $message = null, $level = ''): FlashNotifier
    {

        // dd($message);

        // If no message was provided, we should update
        // the most recently added message.
        if (! $message && ! $title) {
            return $this->updateLastMessage(compact('level'));
        }

        if (! $message instanceof Message) {
            $message = new Message(compact('title','message', 'level'));
        }

        $this->messages->push($message);

        return $this->flash();
    }

    /**
     * Modify the most recently added message.
     *
     * @param  array $overrides
     * @return $this
     */
    protected function updateLastMessage($overrides = []): FlashNotifier
    {

        // dd($this->messages);

        $this->messages->last()->update($overrides);

        return $this;
    }

    /**
     * Add an "important" flash to the session.
     *
     * @return $this
     */
    public function important(): FlashNotifier
    {
        return $this->updateLastMessage(['important' => true]);
    }

    /**
     * Clear all registered messages.
     *
     * @return $this
     */
    public function clear(): FlashNotifier
    {
        $this->messages = collect();

        return $this;
    }

    /**
     * Flash all messages to the session.
     */
    protected function flash(): FlashNotifier
    {
        $this->session->flash('flash_notifications', $this->messages);

        return $this;
    }
}

