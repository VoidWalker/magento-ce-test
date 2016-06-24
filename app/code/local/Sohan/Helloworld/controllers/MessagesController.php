<?php

class Sohan_Helloworld_Controller extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo 'Hello World';
    }

    public function goodbyeAction()
    {
        echo 'Goodbye World!';
    }
}