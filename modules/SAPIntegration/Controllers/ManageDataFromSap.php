<?php

namespace Modules\SAPIntegration\Controllers;

use entities\BrandsQuery;
use entities\OutletOrgDataQuery;
use entities\OutletStockOtherSummary;
use entities\OutletStockOtherSummaryQuery;
use entities\ProductsQuery;

class ManageDataFromSap
{
    private $curlRequest;
    private $companyId;
    private $customerListArray, $isSetCustomerList;
    private $productListArray, $isSetProductList;
    private $brandListArray, $isSetBrandList;

    public function __construct($companyId) {
        $this->curlRequest = new \Modules\System\Processes\WebRequestManager;
        $this->companyId = $companyId;
        $this->customerListArray = [];
        $this->isSetCustomerList = false;
        $this->productListArray = [];
        $this->isSetProductList = false;
        $this->brandListArray = [];
        $this->isSetBrandList = false;
    }

    private function getCustomerByCodeFromArray($code)
    {
        $list = $this->getCustomersArray();
        return isset($list[strtolower($code)]) ? $list[strtolower($code)] : [];
    }

    private function getProductByCodeFromArray($code)
    {
        $list = $this->getProductsArray();
        return isset($list[strtolower($code)]) ? $list[strtolower($code)] : [];
    }

    private function getBrandByCodeFromArray($code)
    {
        $list = $this->getBrandsArray();
        return isset($list[strtolower($code)]) ? $list[strtolower($code)] : [];
    }

    private function getCustomersArray()
    {
        if (!$this->isSetCustomerList) {
            echo "Start to get outlet array" . PHP_EOL;
            $Outletlist = OutletOrgDataQuery::create()
                            ->select(["OutletOrgId", "OutletOrgCode", "OrgUnitId", "OutletId"])
                            ->filterByCompanyId($this->companyId)
                            ->find()->toArray();

            foreach ($Outletlist as $outs) {
                $this->customerListArray[strtolower($outs['OutletOrgCode'])] = ['OutletOrgId' => $outs['OutletOrgId'], 'OutletId' => $outs['OutletId'], 'OrgUnitId' => $outs['OrgUnitId']];
                unset($outs);
            }
            unset($Outletlist);
            $this->isSetCustomerList = true;
            echo "End to get outlet array : " . count($this->customerListArray) . PHP_EOL;
        }
        return $this->customerListArray;
    }

    private function getProductsArray()
    {
        if (!$this->isSetProductList) {
            echo "Start to get product array" . PHP_EOL;
            $productList = ProductsQuery::create()
                            ->select(['Id', 'ProductSku', 'BrandId', 'OrgunitId'])
                            ->filterByCompanyId($this->companyId)
                            ->find()->toArray();

            foreach ($productList as $product) {
                $this->productListArray[strtolower($product['ProductSku'])] = ['Id' => $product['Id'], 'BrandId' => $product['BrandId'], 'OrgUnitId' => $product['OrgunitId']];
                unset($product);
            }
            unset($productList);
            $this->isSetProductList = true;
            echo "End to get product array : " . count($this->productListArray) . PHP_EOL;
        }
        return $this->productListArray;
    }

    private function getBrandsArray()
    {
        if (!$this->isSetBrandList) {
            echo "Start to get brand array" . PHP_EOL;
            $brandList = BrandsQuery::create()
                            ->select(['BrandId', 'BrandCode', 'Orgunitid'])
                            ->filterByCompanyId($this->companyId)
                            ->find()->toArray();

            foreach ($brandList as $brand) {
                $this->brandListArray[strtolower($brand['BrandCode'])] = ['BrandId' => $brand['BrandId'], 'OrgUnitId' => $brand['Orgunitid']];
                unset($brand);
            }
            unset($brandList);
            $this->isSetBrandList = true;
            echo "End to get brand array : " . count($this->brandListArray) . PHP_EOL;
        }
        return $this->brandListArray;
    }

    public function getOpeningStockDistributorWise() {
        $url = 'https://appsapi.natcopharma.co.in:4433/api/sales?token=07946ab7e8064175a7b14d9f09f24f3b&Customer=all';
        $response = $this->curlRequest->setUrl($url)->callRequest();
        $response = json_decode($response, true);
        $records = isset($response['report']) ? $response['report'] : [];
        echo "No of records : " . count($records) . PHP_EOL;

        foreach ($records as $record) {
            if (!isset($record['Customer_Code']) || 
                !isset($record['Material']) || 
                !isset($record['Material_Group']) || 
                !isset($record['Salequantity']) || 
                !isset($record['Salevalue']) || 
                !isset($record['Returnvalue']) || 
                !isset($record['Returnquantity']) || 
                !isset($record['Month_Year'])) {
                continue;
            }

            $customer = $this->getCustomerByCodeFromArray($record['Customer_Code']);
            $product = $this->getProductByCodeFromArray($record['Material']);
            $brand = $this->getBrandByCodeFromArray($record['Material_Group']);
            $moye = $record['Month_Year'];

            if (isset($customer['OutletOrgId']) && 
                    isset($product['Id']) && 
                    isset($brand['BrandId']) &&
                    isset($customer['OrgUnitId']) &&
                    isset($product['OrgUnitId']) &&
                    isset($brand['OrgUnitId']) &&
                    isset($customer['OutletId']) &&
                    isset($product['BrandId']) &&
                    ($customer['OrgUnitId'] == $product['OrgUnitId']) &&
                    ($product['OrgUnitId'] == $brand['OrgUnitId']) &&
                    ($product['BrandId'] == $brand['BrandId'])) {
                
                $summary = OutletStockOtherSummaryQuery::create()
                            ->filterByOutletOrgId($customer['OutletOrgId'])
                            ->filterByOutletId($customer['OutletId'])
                            ->filterByProductId($product['Id'])
                            ->filterByBrandId($brand['BrandId'])
                            ->filterByOrgunitid($customer['OrgUnitId'])
                            ->filterByMoye($moye)
                            ->filterByCompanyId($this->companyId)
                            ->findOne();
                
                if (empty($summary)) {
                    $summary = new OutletStockOtherSummary;
                    $summary->setOutletId($customer['OutletId']);
                    $summary->setOutletOrgId($customer['OutletOrgId']);
                    $summary->setProductId($product['Id']);
                    $summary->setBrandId($brand['BrandId']);
                    $summary->setOrgunitid($customer['OrgUnitId']);
                    $summary->setCompanyId($this->companyId);
                    $summary->setMoye($moye);
                }

                $summary->setSaleQty($record['Salequantity']);
                $summary->setSaleValue($record['Salevalue']);
                $summary->setReturnQty($record['Returnquantity']);
                $summary->setReturnValue($record['Returnvalue']);
                $summary->save();
            }
        }
    }
}