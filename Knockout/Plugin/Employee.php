<?php

namespace Dtn\Knockout\Plugin;

class Employee extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @var \Dtn\Knockout\Model\EmployeeFactory
     */
    protected $employeeFactory;

    protected $employeeCollectionFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Dtn\Knockout\Model\EmployeeFactory $employeeFactory,
        \Dtn\Knockout\Model\ResourceModel\Employee\CollectionFactory $employeeCollectionFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->employeeFactory = $employeeFactory;
        $this->employeeCollectionFactory = $employeeCollectionFactory;
        return parent::__construct($context);

    }

    public function execute()
    {
//       $employeess = $this->employeeCollectionFactory->create();
//       return json_encode($employeess);
    }
}
