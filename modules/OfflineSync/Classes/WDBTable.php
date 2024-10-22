<?php declare(strict_types = 1);


namespace Modules\OfflineSync\Classes;

use entities\WdbSyncLog;
use entities\WdbSyncLogQuery;

class WDBTable
{

    var $tableName;
    var $idColName = "";
    var $customIdName = "";
    var $created = [];
    var $updated = [];
    var $deleted = [];

    // Setting up ID Params 
    private function setupIDs()
    {
        if($this->idColName == "") {return;}
        foreach($this->created as &$rec)
        {            
            if (!empty($this->customIdName)) {
                $id = strtoupper($this->customIdName).$rec[$this->idColName];
            } else {
                $id = strtoupper(substr($this->tableName,0,3)).$rec[$this->idColName];
            }

            if(isset($rec["Id"])) {
            
                $rec = array_merge([$this->tableName."_Id" => $rec["Id"],],$rec);
                unset($rec["Id"]);
            
            }

            $rec = array_merge(["id" => $id,],$rec);            
            
            $rec["created_at"] = null;
            $rec["updated_at"] = null;            

            if(isset($rec["CreatedAt"]))
            {
                if($rec["CreatedAt"] != null)
                {
                    $rec["created_at"] = strtotime($rec["CreatedAt"]);
                }

                if($rec["UpdatedAt"] != null)
                {
                    $rec["updated_at"] = strtotime($rec["UpdatedAt"]);
                }
            }
            

            //unset($rec["CreatedAt"]);
            //unset($rec["UpdatedAt"]);
                        
        }

        foreach($this->updated as &$rec)
        {
            if (!empty($this->customIdName)) {
                $id = strtoupper($this->customIdName).$rec[$this->idColName];
            } else {
                $id = strtoupper(substr($this->tableName,0,3)).$rec[$this->idColName];
            }

            if(isset($rec["Id"])) {
                
                $rec = array_merge([$this->tableName."_Id" => $rec["Id"],],$rec);
                unset($rec["Id"]);
            
            }

            $rec = array_merge(["id" => $id,],$rec);   

            if(isset($rec["CreatedAt"]) && isset($rec["UpdatedAt"]))
            {
                $rec["created_at"] = null;
                $rec["updated_at"] = null;            
                
                if($rec["CreatedAt"] != null)
                {
                    $rec["created_at"] = strtotime($rec["CreatedAt"]);                
                }

                if($rec["UpdatedAt"] != null)
                {
                    $rec["updated_at"] = strtotime($rec["UpdatedAt"]);                
                }
            }
            
            
            //unset($rec["CreatedAt"]);
            //unset($rec["UpdatedAt"]);
        }
    }

    // return format
    public function toArray()
    {
        $this->setupIDs();
        return [$this->tableName => [
            "created"  => $this->created,
            "updated" => $this->updated,
            "deleted" => $this->deleted
        ]];        
    }

    // receive format
    public function fromArray($table,$records)
    {
        $this->tableName = $table;

        if(isset($records["created"]))
        {
            $this->created = $records["created"];
        }

        if(isset($records["updated"]))
        {
            $this->updated = $records["updated"];
        }

        if(isset($records["deleted"]))
        {
            $this->deleted = $records["deleted"];
        }

    }
    
    public function LogUpdate($operation,$record,$user_id,$company_id) : WdbSyncLog
    {
        try {    
            $syncLog = new WdbSyncLog();

            $syncLog->setSysTable($this->tableName);
            $syncLog->setSysOperation($operation);
            $syncLog->setSysBody(json_encode($record));
            $syncLog->setUserId($user_id);
            $syncLog->setTokenId($_GET["apptoken"]);
            $syncLog->setCompanyId($company_id);
            $syncLog->setWdbKey($record["id"]);        
            $syncLog->setDeviceTimestamp($_GET["last_pulled_at"]);
            $syncLog->save();
            
            return $syncLog;
        }
        catch(\Exception $e)
        {             
            echo $e->getMessage();exit;
        }
    }

    public function isSyncDuplicate($operation,$record,$user_id,$company_id)
    {
        if($operation == "created")
        {
            $dbkey = $record["id"];
            $token = $_GET["apptoken"];

            $dblog = WdbSyncLogQuery::create()
                        ->select(['SysTable','WdbKey'])
                        ->filterBySysOperation($operation)
                        ->filterByWdbKey($dbkey)
                        ->filterBySysTable($this->tableName)
                        ->filterByTokenId($token)
                        ->findOne();
            if($dblog != null)
            {
                $this->LogUpdate("resync",$record,$user_id,$company_id);
                return true;
            }
            
            return false;
        }
    }
}