<?php

namespace Marcoaag\Frenet\Block;

class PurchaseInfo extends \Magento\Framework\View\Element\Template
{
    public function getFormAction()
    {
        return '/frenetfrontend/cotacao/result';
     }
}