<?php

namespace Dtn\Knockout\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;

class Employee extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('employee', 'employee_id');
    }
}

