<?php

namespace Gradosevic\EasyGA;


class Page extends Base
{
    private $path;
    private $title;
    private $hostName;
    private $referrer;

    public function setDocumentHostName($hostName)
    {
        $this->hostName = $hostName;
        return $this;
    }

    public function setDocumentReferrer($referrer)
    {
        $this->referrer = $referrer;
        return $this;
    }

    public function setDocumentPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function setDocumentTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function send()
    {
        $this->validate();
        $this->setApiData();
        $this->api()->sendPageview();
    }

    public function setAnalytics($easyAnalytics){
        parent::setAnalytics($easyAnalytics);
    }

    /**
     * Sets Api data from privately stored data
     * Not required to call if Page->send() method is used
     */
    public function setApiData()
    {
        if ($this->title) {
            $this->api()->setDocumentTitle($this->title);
        }

        if ($this->hostName) {
            $this->api()->setDocumentHostName($this->hostName);
        }

        if ($this->referrer) {
            $this->api()->setDocumentReferrer($this->referrer);
        }
    }

    protected function validate()
    {
        if (!$this->path) {
            throw new \Exception('Page path can not be empty');
        }
    }
}