<?php
/**
 * Created by PhpStorm.
 * User: goran
 * Date: 20/04/16
 * Time: 18:49
 */

namespace Gradosevic\EasyGA;


class Page extends Base
{
    public function setDocumentHostName($affiliation){
        if($affiliation){
            $this->api()->setDocumentHostName($affiliation);
        }
        return $this;
    }

    public function setDocumentReferrer($affiliation){
        if($affiliation){
            $this->api()->setDocumentReferrer($affiliation);
        }
        return $this;
    }

    public function setDocumentPath($affiliation){
        if($affiliation){
            $this->api()->setDocumentPath($affiliation);
        }
        return $this;
    }

    public function setDocumentTitle($affiliation){
        if($affiliation){
            $this->api()->setDocumentTitle($affiliation);
        }
        return $this;
    }

    /*$a = Analytics::create(config('session.user.id'))->getAnalytics();
        $a->setDocumentHostName('cusmin.com')
            ->setDocumentReferrer('myblog.com')
            ->setDocumentPath('/app/service/activate')
            ->setDocumentTitle('Page Title')
            ->sendPageview();*/

}