<?php

namespace Dtn\Knockout\Controller\Adminhtml\Test;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $pageFactory;

    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
//        $resultPage = $this->pageFactory->create();
//        $resultPage->setActiveMenu('Dtn_Img::main_img');
//        $resultPage->getConfig()->getTitle()->prepend(__('Img'));
//        return $resultPage;
        echo "abcd";
    }
}
