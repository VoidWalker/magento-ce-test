<?php

class Ism_News_Model_Observer
{
    public function addTopmenuLink(Varien_Event_Observer $observer)
    {
        $menu = $observer->getMenu();
        $tree = $menu->getTree();

        $node = new Varien_Data_Tree_Node(array(
            'name' => 'News',
            'id' => 'news',
            'url' => Mage::getUrl('news'),
        ), 'id', $tree, $menu);

        $menu->addChild($node);
    }
}