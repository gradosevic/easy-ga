<?php

namespace Gradosevic\EasyGA\Tests;

use Gradosevic\EasyGA\Analytics;

class EventTest extends TestCase
{
    public function test_send_simple_event(){
        Analytics::create($this->config)
            ->event('Event Simple Group', 'Event Simple Action')
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

    public function test_send_event_with_custom_data(){
        Analytics::create($this->config)
            ->event()
            ->setCategory('Event Category')
            ->setAction('Event with custom data')
            ->setLabel('Event wcd label')
            ->setCustomDimension('custom value 1', 1)
            ->setCustomDimension('custom value 2', 2)
            ->setValue(9)
            ->send();
    }

    public function test_send_advanced_event(){
        Analytics::create($this->config)
            ->event('Advanced Event Group', 'Advanced Event Action')
            ->api()
            ->setDocumentPath('/event/document/path')
            ->sendEvent();
    }
}