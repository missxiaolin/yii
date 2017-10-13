<?php namespace common\src\foundation\support;

use Illuminate\Contracts\Support\MessageProvider;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Support\MessageBag;

class Validation implements MessageProvider
{
    /**
     * @var \Illuminate\Support\MessageBag
     */
    protected $messages;

    /**
     * Construct and init MessageBag.
     */
    public function __construct()
    {
        $this->messages = new MessageBag();
    }

    /**
     * Get the messages for the instance.
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getMessageBag()
    {
        return $this->messages;
    }

    /**
     * Add a validation failure.
     *
     * @param string $key
     * @param string $message
     * @return $this
     */
    public function fail($key, $message)
    {
        $this->messages->add($key, $message);

        return $this;
    }

    /**
     * Determine if the validation.
     *
     * @return bool
     */
    public function isValid()
    {
        return $this->messages->count() === 0;
    }

    /**
     * callback after validation fails.
     *
     * @param callable $callable
     */
    public function onFailed(callable $callable)
    {
        if (!$this->isValid()) {
            call_user_func_array($callable, [$this->messages]);
        }
    }

    /**
     * Throw exception after validation fails.
     *
     * @throws \Illuminate\Contracts\Validation\ValidationException
     */
    public function throws()
    {
        if (!$this->isValid()) {
            throw new ValidationException($this);
        }
    }

}