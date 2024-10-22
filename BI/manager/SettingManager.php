<?php

namespace BI\manager;

use entities\OrgUnitQuery;
use entities\SystemConfigs;
use entities\SystemConfigsQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class SettingManager 
{
    public function resetCompanySettings($companyId) {
        echo "Company Setting reset : Start" . PHP_EOL;

        if (empty($companyId)) {
            echo "Company Id not set" . PHP_EOL;
            return false;
        }

        $file = __DIR__.'/../../settings.php';
        $configs = [];
        if(file_exists($file)) {
            $configs = include($file);
        }

        foreach ($configs as $config) {
            if (empty($config['config_key']) || empty($config['description']) || empty($config['data_type']) || empty($config['config_options']) || empty($config['config_default']) || empty($config['config_scope']) || empty($config['module_name']) || empty($config['is_app'])) {
                echo "Not in standard format : " . json_encode($config) . PHP_EOL;
                continue;
            }

            $sysConfig = SystemConfigsQuery::create()
                            ->filterByCompanyId($companyId)
                            ->filterByConfigKey($config['config_key'])
                            ->filterByOrgunitId(null)
                            ->findOne();
            
            if (empty($sysConfig)) {
                $sysConfig = new SystemConfigs;
                $sysConfig->setCompanyId($companyId);
                $sysConfig->setConfigKey($config['config_key']);  
                $sysConfig->setConfigValue($config['config_default']);
            }

            $sysConfig->setModuleName($config['module_name']);
            $sysConfig->setDescription($config['description']);
            $sysConfig->setDataType($config['data_type']);
            $sysConfig->setConfigOptions($config['config_options']);
            $sysConfig->setConfigDefault($config['config_default']);
            $sysConfig->setConfigScope($config['config_scope']);
            $sysConfig->setIsApp($config['is_app']);
            $sysConfig->save();

            echo $config['config_key'] . " - config reset..." . PHP_EOL;
        }

        $this->reSyncConfigInredis();

        echo "Company Setting reset : End" . PHP_EOL;
        return true;
    }

    public function resetBuleavelSettings($companyId) {
        echo "Bu level Setting reset : Start" . PHP_EOL;

        if (empty($companyId)) {
            echo "Company Id not set" . PHP_EOL;
            return false;
        }

        $orgunits = OrgUnitQuery::create()
                        ->select(['Orgunitid'])
                        ->filterByCompanyId($companyId)
                        ->find()
                        ->toArray();

        $moduleDir = __DIR__.'/../../modules';
        $configs = [];
        
        $dh = opendir($moduleDir);
        while (($file = readdir($dh)) !== false){
            if(is_dir($moduleDir."/$file") && $file != "." && $file != "..") 
            {           
                if(file_exists($moduleDir."/$file/Settings.php")) {
                    $configs = array_merge($configs,include($moduleDir."/$file/Settings.php"));
                }
            }                
        }

        foreach ($configs as $config) {
            if (!isset($config['dependent_config_key']) || !isset($config['dependent_config_key_value']) || empty($config['module_name']) || empty($config['config_key']) || empty($config['description']) || empty($config['data_type']) || empty($config['config_options']) || empty($config['config_default']) || empty($config['config_scope']) || !isset($config['is_app'])) {
                echo "Not in standard format : " . json_encode($config) . PHP_EOL;
                continue;
            }

            foreach ($orgunits as $orgunitId) {
                $sysConfig = SystemConfigsQuery::create()
                            ->filterByCompanyId($companyId)
                            ->filterByOrgunitId($orgunitId)
                            ->filterByConfigKey($config['config_key'])
                            ->filterByModuleName($config['module_name'])
                            ->findOne();
            
                if (empty($sysConfig)) {
                    $sysConfig = new SystemConfigs;
                    $sysConfig->setCompanyId($companyId);
                    $sysConfig->setOrgunitId($orgunitId);
                    $sysConfig->setConfigKey($config['config_key']);
                    $sysConfig->setModuleName($config['module_name']);
                    $sysConfig->setConfigValue($config['config_default']);
                }

                $sysConfig->setDependentConfigKey($config['dependent_config_key']);
                $sysConfig->setDependentConfigKeyValue($config['dependent_config_key_value']);
                $sysConfig->setDescription($config['description']);
                $sysConfig->setDataType($config['data_type']);
                $sysConfig->setConfigOptions($config['config_options']);
                $sysConfig->setConfigDefault($config['config_default']);
                $sysConfig->setConfigScope($config['config_scope']);
                $sysConfig->setIsApp($config['is_app']);
                $sysConfig->save();
            }

            echo $config['config_key'] . " - config reset..." . PHP_EOL;
        }

        $this->reSyncConfigInredis();

        echo "Bu level Setting reset : End" . PHP_EOL;
        return true;
    }

    public function reSyncConfigInredis() {
        $configs = SystemConfigsQuery::create()
                            ->find()
                            ->toArray();
        
        $data = [];                 
        foreach ($configs as $config) {
            $key = $config['ModuleName'] . $config['ConfigKey'] . '_' . $config['CompanyId'];
            if (!empty($config['OrgunitId'])) {
                $key = $key . '_' . $config['OrgunitId'];
            }
            $data[$key] = $config['ConfigValue'];
        }

        $redisClient = new \Predis\Client($_ENV['REDIS_URL']."?ssl[verify_peer_name]=0&ssl[verify_peer]=0");
        $redisClient->del("SystemConfigs");
        $redisClient->set("SystemConfigs", json_encode($data));
    }
}