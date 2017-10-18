<?php namespace common\src\foundation\domain;

use Carbon\Carbon;
use yii\db\Command;

class Event extends Command
{
    /**
     * The payload of the event.
     *
     * @var mixed
     */
    public $payload;

    /**
     * Time when event was first published.
     *
     * @var null|\Carbon\Carbon
     */
    protected $published_at;

    public $event = 'event';

    /**
     * Create a new event.
     *
     * @param mixed $payload
     * @param $event_name
     * @param $class
     * @param $config
     */

    /**
     * Event constructor.
     * @param array $event_name
     * @param null $class
     * @param $function
     * @param array $config
     */
    public function __construct($class = null, $event_name = 'event', $function = 'handle', array $config = [])
    {
        parent::__construct($config);
        $this->event = $event_name;
        $this->on($event_name, [$class, $function]);
    }

    /**
     * Publish the event.
     */
    public function publish()
    {
        if (!isset($this->published_at)) {
            $this->published_at = new Carbon();
            $this->trigger($this->event);

        }
    }
}