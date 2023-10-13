<?php

namespace Seepossible\GiftMessage\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;


class Index extends Action
{
    protected $resultPageFactory;

    /**
     * @var \Magento\Quote\Model\QuoteRepository
     */
    protected $quoteRepository;

    /**
     * @param \Magento\Quote\Model\QuoteRepository $quoteRepository
     */

     private $quoteItemFactory;
    private $itemResourceModel;

    public function __construct(Context $context, PageFactory $resultPageFactory,
    \Magento\Quote\Model\Quote\ItemFactory $quoteItemFactory,
    \Magento\Quote\Model\ResourceModel\Quote\Item $itemResourceModel)
    {
        parent::__construct($context);
        $this->quoteItemFactory = $quoteItemFactory;
        $this->itemResourceModel = $itemResourceModel;
        $this->_resultFactory = $context->getResultFactory();
    }

    public function execute()
    {
       $post = $this->getRequest()->getPostValue();
       if($post){
        $itemId = isset($post['quote_id']) ? $post['quote_id'] : NULL;
        $giftMessage = isset($post['gift_message']) ? $post['gift_message'] : '';
        try{
            $quoteItem = $this->quoteItemFactory->create()->load($itemId);
            $quoteItem->setGiftMessage($giftMessage);
        }catch(\Exception $e){
           echo $e->getMessage();
        }
       }

       $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
        
    }
}