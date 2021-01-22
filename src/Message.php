<?php

namespace Emodyz\Flash;

class Message implements \ArrayAccess
{
    /**
     * The title of the message.
     *
     * @var string
     */
    public string $title;

    /**
     * The body of the message.
     *
     * @var string
     */
    public string $message;

    /**
     * The message level.
     *
     * @var string
     */
    public string $level = '';

    /**
     * Whether the message should auto-hide.
     *
     * @var bool
     */
    public bool $important = false;

    /**
     * Create a new message instance.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $this->update($attributes);
    }

    /**
     * Update the attributes.
     *
     * @param  array $attributes
     * @return $this
     */
    public function update($attributes = []): static
    {
        $attributes = array_filter($attributes);

        foreach ($attributes as $key => $attribute) {
            $this->$key = $attribute;
        }

        return $this;
    }


    /**
     * Whether the given offset exists.
     *
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->$offset);
    }

    /**
     * Fetch the offset.
     *
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->$offset;
    }

    /**
     * Assign the offset.
     *
     * @param mixed $offset
     * @param $value
     * @return void
     */
    public function offsetSet(mixed $offset, $value)
    {
        $this->$offset = $value;
    }

    /**
     * Unset the offset.
     *
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset(mixed $offset)
    {
        //
    }
}
