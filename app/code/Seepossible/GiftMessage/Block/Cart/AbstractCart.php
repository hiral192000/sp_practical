<?php
namespace Seepossible\GiftMessage\Block\Cart;

class AbstractCart
{
    public function afterGetItemRenderer(\Magento\Checkout\Block\Cart\AbstractCart $subject, $result)
    {
        $result->setTemplate('Seepossible_GiftMessage::cart/item/default.phtml');

        return $result;
    }
}