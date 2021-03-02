<?php

namespace Dtn\Knockout\Block;

//use Magento\Tests\NamingConvention\true\string;
use PHPUnit\Util\Log\JSON;

class Employee extends \Magento\Framework\View\Element\Template
{

    /**
     * @var array
     */
    protected $layoutProcessors;
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $jsonResultFactory;
    /**
     * @var \Dtn\Knockout\Model\ResourceModel\Employee\CollectionFactory
     */
    protected $employeeCollectFactory;
    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $request;
    /**
     * @var \Dtn\Knockout\Model\Employee
     */
    protected $employee;

    /**
     * Employee constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Dtn\Knockout\Model\ResourceModel\Employee\CollectionFactory $employeeCollectionFactory
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory
     * @param \Magento\Framework\App\Request\Http $request
     * @param \Dtn\Knockout\Model\Employee $employee
     * @param array $layoutProcessors
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Dtn\Knockout\Model\ResourceModel\Employee\CollectionFactory $employeeCollectionFactory,
        \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory,
        \Magento\Framework\App\Request\Http $request,
        \Dtn\Knockout\Model\Employee $employee,
        array $layoutProcessors = [],
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->jsLayout = isset($data['jsLayout']) && is_array($data['jsLayout']) ? $data['jsLayout'] : [];
        $this->layoutProcessors = $layoutProcessors;
        $this->employeeCollectFactory = $employeeCollectionFactory;
        $this->jsonResultFactory = $jsonResultFactory;
        $this->employee = $employee;
        $this->request = $request;
    }

    public function getJsLayout()
    {
        foreach ($this->layoutProcessors as $processor) {
            $this->jsLayout = $processor->process($this->jsLayout);
        }
        return \Zend_Json::encode($this->jsLayout);
    }

    /**
     * get data employee
     * @return string
     */
    public function getEmployees()
    {
        /**
         * get Data employee
         */
        $employees = $this->employeeCollectFactory->create();
        /**
         * process data
         */
        $result = array();
        foreach ($employees as $collection) {
            $result[] = $collection->getData();
        }
        return json_encode($result);
        //return $employees->getItems();
    }
}

