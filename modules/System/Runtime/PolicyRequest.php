<?php declare(strict_types = 1);

namespace Modules\System\Runtime;


class PolicyRequest
{    
    private $Employee;
    private $Grade;
    private $ActivePolicy;
    private $PolicyKey;
    private $RequestVal;
    private $status;
    private $validated;
    private $message;
    private $limit1;
    private $limit2;
    private $is_readonly;
    private $policyRow;

    function __construct($PolicyKey, $RequestVal) {
        //$this->Employee = $Employee;
        $this->PolicyKey = $PolicyKey;
        $this->RequestVal = $RequestVal;
    }

    
    public function getPolicyRow() : \entities\PolicyRows
    {
        return $this->policyRow;
    }
    public function getEmployee() : \entities\Employee {
        return $this->Employee;
    }

    function getGrade() : \entities\GradeMaster {
        return $this->Grade;
    }

    function getActivePolicy() : \entities\PolicyMaster {
        return $this->ActivePolicy;
    }

    function getPolicyKey() : string {
        return $this->PolicyKey;
    }

    function getRequestVal()  {
        return $this->RequestVal;
    }

    function getStatus() : int {
        return $this->status;
    }

    function getValidated() : bool {
        return $this->validated;
    }

    function getMessage() : string {
        return $this->message;
    }

    function getLimit1()  {
        return $this->limit1;
    }

    function getLimit2()  {
        return $this->limit2;
    }

    function getIsReadonly()  {
        return $this->is_readonly;
    }

    function setEmployee(\entities\Employee $Employee) {
        $this->Employee = $Employee;
    }

    function setGrade(\entities\GradeMaster $Grade) {
        $this->Grade = $Grade;
    }

    function setActivePolicy(\entities\PolicyMaster $ActivePolicy) {
        $this->ActivePolicy = $ActivePolicy;
    }

    function setPolicyKey($PolicyKey) {
        $this->PolicyKey = $PolicyKey;
    }

    function setRequestVal($RequestVal) {
        $this->RequestVal = (float) $RequestVal;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setValidated($validated) {
        $this->validated = $validated;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function setLimit1($limit1) {
        $this->limit1 = $limit1;
    }

    function setLimit2($limit2) {
        $this->limit2 = $limit2;
    }

    function setIsReadonly($is_readonly)  {
        $this->is_readonly = $is_readonly;
    }

    public function setPolicyRow(\entities\PolicyRows $row)
    {
        $this->policyRow = $row;
    }
    
    public function toArray()
    {
        return [
            "Status" => $this->status,
            "PolicyKey" => $this->PolicyKey,
            "Message" => $this->message,
            "Limit1"=> $this->limit1,
            "Validated" => $this->validated            
            
        ];
    }

}
