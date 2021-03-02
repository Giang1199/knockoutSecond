<?php

namespace Dtn\Knockout\Controller\Employee;

use Magento\Framework\View\Element\Messages;

class Create extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @var \Dtn\Knockout\Model\EmployeeFactory
     */
    protected $_employeeFactory;

    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    private $helper;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $resultJsonFactory;

    /**
     * Create constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Json\Helper\Data $helper
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     * @param \Dtn\Knockout\Model\EmployeeFactory $employeeFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Json\Helper\Data $helper,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Dtn\Knockout\Model\EmployeeFactory $employeeFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_employeeFactory = $employeeFactory;
        $this->helper = $helper;
        $this->resultJsonFactory = $resultJsonFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->helper->jsonDecode($this->getRequest()->getContent());
//        var_dump($data);die();
        if(empty($data['employee_id'])){
            unset($data['employee_id']);
            $employee = $this->_employeeFactory->create();
        } else {
            $id  = $data['employee_id'];
            $employee = $this->_employeeFactory->create()->load($id);
            if($employee->getId()){
                $employee = $this->_employeeFactory->create()->load($id);
            }
        }
        $employee->setData($data);
        try {
            $save = $employee->save();
            if ($save) {
                $response[] = [
                    'employee_id' => $employee->getId(),
                    'department' => $employee->getDepartment(),
                    'firstname' => $employee->getFirstname(),
                    'lastname' => $employee->getLastname(),
                    'email' => $employee->getEmail(),
                    'dob' => $employee->getDob(),
                    'salary' => $employee->getSalary(),
                    'note' => $employee->getNote(),
                ];
            }
        } catch (\Exception $e) {

        }
        // tra ve data dang  json , list ra ma k can load lai trang
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData($response,true);
    }
}
