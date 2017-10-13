<?php namespace common\src\foundation\domain\traits;

use common\src\foundation\domain\Event;

Trait EventPending
{
    /**
     * List of pending events.
     *
     * @var \common\src\foundation\domain\Event[]
     */
    protected $events = [];

    /**
     * Pend an event.
     *
     * @param \common\src\foundation\domain\Event $event
     */
    public function pendEvent(Event $event)
    {
        $this->events[] = $event;
    }

    /**
     * Publish all pending events.
     */
    public function publishEvents()
    {
        foreach ($this->events as $event) {
            $event->publish();
        }
        $this->events = [];
    }

}
