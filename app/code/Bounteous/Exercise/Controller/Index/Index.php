<?php

declare(strict_types=1);

namespace Bounteous\Exercise\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{

    public function __construct(
        Context $context
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        // 1. POST request : Get booking data
//        $post = (array) $this->getRequest()->getPost();
//
//        if (!empty($post)) {
//            // Retrieve your form data
//            $temp   = $post['temp'];
//            $wind    = $post['wind'];
//            $countryCode       = $post['countryCode'];
//            $zip = $post['zip'];
//
//            // Doing-something with...
//
//            // Display the succes form validation message
//            $this->messageManager->addSuccessMessage('Booking done !');
//
//            // Redirect to your form page (or anywhere you want...)
//            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
//            $resultRedirect->setUrl('/companymodule/index/booking');
//
//            return $resultRedirect;
//        }
    }
}
