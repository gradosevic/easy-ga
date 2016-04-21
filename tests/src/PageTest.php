<?php

namespace Gradosevic\EasyGA\Tests;

use Gradosevic\EasyGA\Analytics;

class PageTest extends TestCase
{
    function test_send_simple_page_view(){
        Analytics::create($this->config)
            ->page('/simple/page/view', 'Simple Page View')
            ->send();
    }

    function test_send_complete_page_view_created_from_constructor(){
        $path = '/document/page/from/constructor';
        $title = 'Page Complete From Constructor';
        $hostname = 'mydomain.com';
        $referrer = 'myblog.com';

        Analytics::create($this->config)
            ->page($path, $title, $hostname, $referrer)
            ->send();
    }

    function test_send_complete_page_view_created_from_methods(){
        $path = '/document/page/from/methods';
        $title = 'Page Complete From Methods';
        $hostname = 'mydomain.com';
        $referrer = 'myblog.com';

        Analytics::create($this->config)
            ->page()
            ->setDocumentPath($path)
            ->setDocumentTitle($title)
            ->setDocumentHostName($hostname)
            ->setDocumentReferrer($referrer)
            ->send();
    }

    /**
     * Sends page view with additional methods from API
     */
    function test_send_advanced_page_view(){
        $path = '/advanced/page/view';
        $title = 'Advanced Page View';

        Analytics::create($this->config)
            ->page($path, $title)
            ->api()
            ->setDocumentLocationUrl('location/url')
            ->setClientId('234235')
            ->sendPageview();
    }
}