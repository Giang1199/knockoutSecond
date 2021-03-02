<?php

namespace Dtn\Knockout\Controller\Employee;

class Delete extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @var \Dtn\Knockout\Model\EmployeeFactory
     */
    private $employeeFactory;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $resultJsonFactory;

    /**
     * Delete constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Dtn\Knockout\Model\EmployeeFactory $employeeFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Dtn\Knockout\Model\EmployeeFactory $employeeFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->employeeFactory = $employeeFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $employee = $this->employeeFactory->create();
        $data = $this->getRequest()->getParams('data');
        try {
            $employee->load($data['employee_id'])->delete();
        } catch (\Exception $e) {

        }
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData($data);
    }
}
