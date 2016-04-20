<?php

namespace Gradosevic\EasyGA\Tests;

use Gradosevic\EasyGA\Analytics;

class EventTest extends TestCase
{
    public function test_send_simple_event(){
        Analytics::create($this->config)
            ->event('Event Group', 'Event Action')
            ->send();
    }

    public function test_send_complete_event_created_from_constructor(){
        Analytics::create($this->config)
            ->event('Event Constructor', 'Event Constr-Action', 'Event Constr-Label', 45)
            ->send();
    }

    public function test_send_complete_event_created_with_methods(){
        Analytics::create($this->config)
            ->event()
            ->setCategory('Event Methods')
            ->setAction('Event Methods-Action')
            ->setLabel('Event Methods-Label')
            ->setValue(11)
            ->send();
    }
}