<?php

namespace BI\manager;

use BI\requests\SGPITransferRequest;
use entities\SgpiTrans;
use Exception;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Description of SGPI Manager
 *
 * @author Chintan Parikh
 */
class SGPIManager
{

    public function doTransfer(SGPITransferRequest &$trnf): SGPITransferRequest
    {
        try {
            $creditTran = new SgpiTrans();
            $debitTran = new SgpiTrans();

            $debitTran->setSgpiAccountId($trnf->getFrom_sgpi_account_id());
            $creditTran->setSgpiAccountId($trnf->getTo_sgpi_account_id());

            $debitTran->setCd("D");
            $creditTran->setCd("C");

            $debitTran->setSgpiId($trnf->getSgpi_id());
            $creditTran->setSgpiId($trnf->getSgpi_id());

            $debitTran->setQty($trnf->getQty());
            $creditTran->setQty($trnf->getQty());

            $debitTran->setRemark($trnf->getRemark());
            $creditTran->setRemark($trnf->getRemark());

            $debitTran->setCompanyId($trnf->getCompany_id());
            $creditTran->setCompanyId($trnf->getCompany_id());

            $voucherID = time() . rand(100, 999);

            $debitTran->setVoucherNo($voucherID);
            $creditTran->setVoucherNo($voucherID);
            $trnf->setVoucherId($voucherID);

            if ($trnf->getFrom_sgpi_account_id() > 0) {
                $debitTran->save();
            }

            if ($trnf->getTo_sgpi_account_id() > 0) {
                $creditTran->save();

            }

            $trnf->setMessage("Voucher Saved As : " . $voucherID);
        } catch (Exception $e) {
            $trnf->setMessage($e->getMessage());
        }

        return $trnf;

    }

    public function rcpaSummaryWorker()
    {

        $query = \entities\BrandRcpaQuery::create()
            ->select(['BrandRcpaOutletId', 'OutletOrgId', 'BrandId', 'OutletName', 'OutletClassification', 'VisitFq', 'TerritoryId', 'OrgUnitId', 'Tags', 'RcpaMoye', 'BrandName', 'RcpaValue', 'Potential', 'Own', 'Competition', 'CreatedAt', 'UpdatedAt', 'MinValue', 'PositioinId'])
            ->withColumn('brand_rcpa.outlet_id', 'BrandRcpaOutletId')
            ->withColumn('outlet_org_data.outlet_org_id', 'OutletOrgId')
            ->withColumn('brand_rcpa.brand_id', 'BrandId')
            ->withColumn('outlets.outlet_name', 'OutletName')
            ->withColumn('outlets.outlet_classification', 'OutletClassification')
            ->withColumn('outlet_org_data.visit_fq', 'VisitFq')
            ->withColumn('beats.territory_id', 'TerritoryId')
            ->withColumn('brands.orgunitid', 'OrgUnitId')
            ->withColumn('outlet_org_data.tags', 'Tags')
            ->withColumn('brand_rcpa.rcpa_moye', 'RcpaMoye')
            ->withColumn('brands.brand_name', 'BrandName')
            ->withColumn('sum(brand_rcpa.rcpa_value)', 'RcpaValue')
            ->withColumn('sum(CASE WHEN brand_rcpa.competitor_id = 0 THEN brand_rcpa.rcpa_value * products.base_price ELSE brand_rcpa.rcpa_value * brand_competition.drate END)', 'Potential')
            ->withColumn('sum(CASE WHEN brand_rcpa.competitor_id = 0 THEN brand_rcpa.rcpa_value * products.base_price ELSE 0::numeric END)', 'Own')
            ->withColumn('sum(CASE WHEN brand_rcpa.competitor_id = 0 THEN 0::numeric ELSE brand_rcpa.rcpa_value * brand_competition.drate END)', 'Competition')
            ->withColumn('max(brand_rcpa.created_at)', 'CreatedAt')
            ->withColumn('max(brand_rcpa.updated_at)', 'UpdatedAt')
            ->withColumn('brands.min_value', 'MinValue')
            ->withColumn('territories.position_id', 'PositioinId')
            ->withColumn('brand_rcpa.company_id', 'CompanyId')
            ->addjoin('brand_rcpa.brand_id', 'brands.brand_id', Criteria::INNER_JOIN)
            ->addjoin('brand_rcpa.product_id', 'products.id', Criteria::INNER_JOIN)
            ->addjoin('brand_rcpa.outlet_id', 'outlets.id', Criteria::INNER_JOIN)
            ->addjoin('brand_rcpa.outlet_id', 'outlet_org_data.outlet_id', Criteria::INNER_JOIN)
            ->addjoin('outlet_org_data.outlet_org_id', 'beat_outlets.beat_org_outlet', Criteria::INNER_JOIN)
            ->addjoin('beat_outlets.beat_id', 'beats.beat_id', Criteria::INNER_JOIN)
            ->addjoin('beats.territory_id', 'territories.territory_id', Criteria::LEFT_JOIN)
            ->addjoin('brand_rcpa.competitor_id', 'brand_competition.competitor_id', Criteria::LEFT_JOIN)
            ->where('outlet_org_data.org_unit_id = brands.orgunitid')
            ->groupBy('brand_rcpa.outlet_id', 'outlet_org_data.outlet_org_id', 'brand_rcpa.brand_id', 'outlets.outlet_name', 'outlets.outlet_classification', 'outlet_org_data.visit_fq', 'beats.territory_id', 'brands.orgunitid', 'outlet_org_data.tags', 'brand_rcpa.rcpa_moye', 'brands.brand_name', 'MinValue', 'territories.position_id')
            ->find()->toArray();

        if (count($query) > 0) {
            foreach ($query as $data) {
                if ($data["Own"] >= $data["MinValue"]) {
                    $IsRxer = true;
                } else {
                    $IsRxer = false;
                }
                $rcpaSummary = new \entities\RcpaSummaryData();
                $rcpaSummary->setMoye($data["RcpaMoye"]);
                $rcpaSummary->setTerritoryId($data["TerritoryId"]);
                $rcpaSummary->setPositionId($data["PositioinId"]);
                $rcpaSummary->setOutletId($data["BrandRcpaOutletId"]);
                $rcpaSummary->setOutletOrgId($data["OutletOrgId"]);
                $rcpaSummary->setBrandId($data["BrandId"]);
                $rcpaSummary->setContribution($data["Competition"]);
                $rcpaSummary->setOwn($data["Own"]);
                $rcpaSummary->setMinValue($data["MinValue"]);
                $rcpaSummary->setIsRxer($IsRxer);
                $rcpaSummary->setCompanyId($data["CompanyId"]);
                $rcpaSummary->save();
            }
        }
    }

}
