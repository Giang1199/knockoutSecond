<?php

namespace Dtn\Knockout\Model;

class Employee extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Dtn\Knockout\Model\ResourceModel\Employee::class);
    }
}
