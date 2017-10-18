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

    /**
     * @var array|string
     */
    public $event = 'event';

    /**
     * @var array
     */
    public $params = [];

    /**
     * Event constructor.
     * @param null $class
     * @param array $params
     * @param string $event_name
     * @param string $function
     * @param array $config
     */
    public function __construct($class = null,$params = [], $event_name = 'event', $function = 'handle', array $config = [])
    {
        parent::__construct($config);
        $this->event = $event_name;
        $this->params = $params;
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