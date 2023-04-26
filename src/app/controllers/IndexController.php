<?php

use Phalcon\Mvc\Controller;
use handler\Aware\Aware;
use handler\Listener\Listener;
use Phalcon\Events\Manager as EventsManager;

class IndexController extends Controller
{
    public function indexAction()
    {
        //redirect to view
    }
    public function registerAction()
    {
        $products = new Products();
        $products->assign(
            $this->request->getPost(),
            [
                'name',
                'qty',
                'price'
            ]
        );
        echo "<pre>";
        $products->save();
        $eventsManager = new EventsManager();
        $componant = new Aware();
        $componant->setEventsManager($eventsManager);
        $eventsManager->attach(
            'application',
            new Listener()
        );
        $componant->process();
        $this->response->redirect();
    }
}
