<?php declare(strict_types = 1);

namespace Modules\System\Processes;

use DateTime;
use entities\BeatOutlets;
use entities\BeatOutletsQuery;
use entities\Beats;
use entities\BeatsQuery;
use entities\Branch;
use entities\BranchQuery;
use entities\Outlets;
use entities\Products;
use entities\Categories;
use entities\ProductsQuery;
use entities\CategoriesQuery;
use entities\UnitmasterQuery;
use entities\ClassificationQuery;
use entities\Designations;
use entities\DesignationsQuery;
use entities\EmployeeQuery;
use entities\OutletMapping;
use entities\OutletMappingQuery;
use entities\OutletsQuery;
use entities\Positions;
use entities\PositionsQuery;
use entities\PricebooksQuery;
use entities\Territories;
use entities\TerritoriesQuery;
use entities\TownCorrection;
use entities\TownMaster;
use entities\Users;
use entities\UsersQuery;

class MasterImports extends \App\Core\Process
{

    var $company_id = 9;
    public function importGeoLocations()
    {
       //["geonameid","name","asciiname","alternatenames","latitude","longitude","feature class","feature code","country code ","cc2"]
       $collection = new \Propel\Runtime\Collection\ObjectCollection();
       $collection->setModel(\entities\GeoLocations::class);
       try{
           $file = fopen(_SYSTEM."/../imports/GeoData_IN.txt","r");           
           $recs = 0;
           while(! feof($file))
                {
                $line =  explode("\t", fgets($file));
                $recs = $recs + 1;    
                $rec = new \entities\GeoLocations();
                $rec->setGeonameId($line[0]);
                $rec->setName($line[1]);
                $rec->setAsciiName($line[2]);
                $rec->setAlternateNames($line[3]);
                $rec->setLatitude($line[4]);
                $rec->setLongitude($line[5]);
                $rec->setCountryCode($line[8]);
                $collection->append($rec);
                
                if($collection->count() == 10000)
                    {
                        $collection->save();
                        $collection->clear();
                        echo $recs." Rows".PHP_EOL;
                    }
                  
                }

            fclose($file);
           
       } 
    catch (\Exception $e )
        {
           var_dump($e);
        }
    }

    function importCategories($filepath)
    {
        try{
            $file = fopen($filepath,"r");           
            $recs = 0;
            $firstRow = true;
            while (($line = fgetcsv($file, 1000, ",")) !== FALSE) 
                 {
                    if($firstRow) {$firstRow = false; continue;}                    
                    $recs = $recs + 1;    

                    $name = $line[0];
                    $type = $line[1];
                    $description = $line[2];
                    $order = $line[3];
                    $parent = $line[4];
                    $company_id = $line[5];

                    $parent_id = 0;
                    
                    if(trim($parent) != "")
                    {
                        $parent_rec = CategoriesQuery::create()->filterByCategoryName($parent)->filterByCompanyId($company_id)->find();
                        if($parent_rec->count() == 0)
                        {
                            echo $recs.") ".$parent." : Does not exists".PHP_EOL;
                            continue;
                        }
                        else 
                        {
                            $parent_id = $parent_rec->getFirst()->getPrimaryKey();
                        }
                    }

                    $category = CategoriesQuery::create()
                                        ->filterByCategoryName($name)
                                        ->filterByCompanyId($company_id)
                                        ->filterByCategoryParentId($parent_id)
                                        ->find();
                    if($category->count() > 0)
                    {
                        echo $recs.") ".$name." : Already Exists".PHP_EOL;
                        continue;
                    }

                    $cat = new Categories();
                    $cat->setCategoryName($name);
                    $cat->setCategoryType($type);
                    $cat->setCategoryDescription($description);
                    $cat->setCategoryDisplayOrder($order);
                    $cat->setCategoryParentId($parent_id);
                    $cat->setCompanyId($company_id);
                    $cat->setCategoryMedia(2337);
                    $cat->save();

                    echo $recs.") ".$name." Imported".PHP_EOL;

                 }
            }
        catch (\Exception $e )
        {
        var_dump($e);
        }

    }

    function importTownMaster($filepath)
    {
        try{
            $file = fopen($filepath,"r");           
            $recs = 0;
            $firstRow = true;
            while (($line = fgetcsv($file, 1000, ",")) !== FALSE) 
                 {
                    if($firstRow) {$firstRow = false; continue;}                    
                    $recs = $recs + 1;    

                    $stateId = $line[0];
                    $stateName = $line[1];
                    $cityId = $line[2];
                    $cityName = $line[3];
                    $townId = $line[4];
                    $townName = $line[5];
                    $uniqueTownCode = $line[6];
                    if($line[7] == null){
                        $toBeRemoved = false;
                    }else{
                        $toBeRemoved = $line[7];
                    }

                    $townMater = \entities\TownCorrectionQuery::create()
                                    ->filterByStateId($stateId)
                                    ->filterByCityId($cityId)
                                    ->filterByTownId($townId)
                                    ->findOne();

                    if($townMater == null){
                        $townMater = new TownCorrection();
                    }
                    
                    $townMater->setStateId($stateId);
                    $townMater->setStateName($stateName);
                    $townMater->setCityId($cityId);
                    $townMater->setCityName($cityName);
                    $townMater->setTownId($townId);
                    $townMater->setTownName($townName);
                    $townMater->setUniqueTownCode($uniqueTownCode);
                    $townMater->setToBeRemoved($toBeRemoved);
                    $townMater->save();

                    $code = $stateId.'-'.$cityId.'-'.$townId;

                    echo $recs.") ".$code." Imported".PHP_EOL;

                 }
            }
        catch (\Exception $e )
        {
        var_dump($e);
        }

    }

    public function importProducts($filepath)
    {

        try{

            $unitArray = UnitmasterQuery::create()->find()->toKeyValue("UnitCode","UnitId");
            $unitArray = array_change_key_case($unitArray,CASE_LOWER);

            $file = fopen($filepath,"r");           
            $recs = 0;
            $firstRow = true;
            while (($line = fgetcsv($file, 1000, ",")) !== FALSE) 
                 {
                    if($firstRow) {$firstRow = false; continue;}                    
                    $recs = $recs + 1;    

                    //if($recs < 400) {continue;}

                    $name = $line[0];
                    $summary = $line[1];
                    $description = $line[2];
                    $sku = $line[3];
                    $unit = $line[4];
                    $packingDesc = $line[5];
                    $packingQty = $line[6];
                    $parent = $line[7];
                    $category_name = $line[8];
                    $company_id = $line[9];

                    $parent_id = 0;
                    $category_id = 0;                    
                    
                    if(trim($parent) != "")
                    {
                        $parent_rec = CategoriesQuery::create()->filterByCategoryName($parent)->filterByCompanyId($company_id)->find();
                        if($parent_rec->count() == 0)
                        {
                            echo $recs.") >>>>>>>>>> ".$parent." : Does not exists".PHP_EOL;
                            continue;
                        }
                        else 
                        {
                            $parent_id = $parent_rec->getFirst()->getPrimaryKey();
                        }
                    }

                    $category = CategoriesQuery::create()
                    ->filterByCategoryName($category_name)
                    ->filterByCompanyId($company_id)
                    ->filterByCategoryParentId($parent_id)
                    ->find();
                    if($category->count() == 0)
                    {
                        echo $recs.") >>>>>>>>>> (".$sku.") ".$category." : Does not exists".PHP_EOL;
                        continue;
                    }
                    else {

                        $category_id = $category->getFirst()->getPrimaryKey();
                    }

                    if(!isset($unitArray[strtolower($unit)]))
                    {
                        echo $recs.") >>>>>>>>>> ".$name." : (".$sku.") ".$unit." : Does not exists".PHP_EOL;
                        continue;
                    }

                    $sku_rec = ProductsQuery::create()
                            ->filterByProductSku($sku)
                            ->filterByCompanyId($company_id)
                            ->find();
                    if($sku_rec->count() > 0)
                    {
                        echo $recs.") >>>>>SKU>>>>> ".$name." : ".$sku." : exists".PHP_EOL;
                        continue;
                    }        

                    $product = new Products();

                    $product->setProductName($name);
                    $product->setProductSummary($summary);
                    $product->setProductDescription($description);
                    $product->setProductSku($sku);
                    $product->setUnitD($unitArray[strtolower($unit)]);
                    $product->setPackingDesc($packingDesc);
                    $product->setPackingQty($packingQty);
                    $product->setCategoryId($category_id);
                    $product->setCompanyId($company_id);
                    $product->setProductImages(2337);
                    $product->save();

                    
                    echo $recs.") ".$name." Imported".PHP_EOL;

                 }
            }        
        catch (\Exception $e )
        {
        var_dump($e);
        }

    }

    public function importOutlets($filepath)
    {
        $recs = 0;

        try{

            $cArray = ClassificationQuery::create()->filterByCompanyId($this->company_id)->find()->toKeyValue("Classification","Id");
            $cArray = array_change_key_case($cArray,CASE_LOWER);

            $terrotries = TerritoriesQuery::create()->filterByCompanyId($this->company_id)->find()->toKeyValue("TerritoryName","TerritoryId");
            $terrotries = array_change_key_case($terrotries,CASE_LOWER);

            $file = fopen($filepath,"r");                       
            $firstRow = true;

            $ifReupload = true;

            while (($line = fgetcsv($file, 1000, "\t")) !== FALSE) 
                 {
                    if($firstRow) {$firstRow = false; continue;}                    
                    $recs = $recs + 1;    

                    if(count($line) <> 24 )
                    {
                        echo $recs. ") ". count($line) . " Lines Found ".PHP_EOL ;
                        continue;
                    }
                    
                    if($recs <= 4358) {continue;}
                    
                    $name = utf8_encode($line[0]);
                    $code = $this->clean($line[1]);
                    $email = substr($line[2],0,100);
                    $salutation = $line[3];
                    $openning_date = $line[4];
                    $contact_name = utf8_encode($line[5]);
                    $landline = $line[6];
                    $alt_landline = $line[7];
                    $bday = $line[8];
                    $annivarsary = $line[9];
                    $isd_code = trim($line[10]);
                    $contact_no = substr($this->clean($line[11]),0,15);
                    $status = $line[12];
                    $address = utf8_encode($line[13]);
                    $street = $line[14];
                    $city = $line[15];
                    $state = $line[16];
                    $country = $line[17];
                    $pincode = $this->clean($line[18]);
                    $gps = $line[19];
                    $territory_name = trim($line[20]);
                    $outlet_type = $line[21];
                    $classification = trim($line[22]);
                    $company_id = $line[23];
                    
                    $classification_id = 0;
                    if(isset($cArray[strtolower($classification)])) {
                        $classification_id = $cArray[strtolower($classification)];
                    } else {
                        echo $recs.") >>>>>Classification>>>>> ".$name." : ".$classification." : not found".PHP_EOL;
                        exit;
                    }
                    
                    $territory_id = 0;
                    if(isset($terrotries[strtolower($territory_name)])) {
                        $territory_id = $terrotries[strtolower($territory_name)];
                    }
                    else 
                    {
                        $territoryRec = new Territories();                        
                        $territoryRec->setTerritoryName($territory_name);
                        $territoryRec->setCompanyId($this->company_id);
                        $territoryRec->setZoneId(87);
                        $territoryRec->save();                        
                        $territory_id = $territoryRec->getPrimaryKey();

                        $terrotries = TerritoriesQuery::create()->filterByCompanyId($this->company_id)->find()->toKeyValue("TerritoryName","TerritoryId");
                        $terrotries = array_change_key_case($terrotries,CASE_LOWER);
                        
                        echo $recs.") >>>>>New Territory Created >>>>> ".$name." : ".$territory_name.PHP_EOL;
                                                
                    }



                    if($ifReupload) {
                    $outlet_rec = OutletsQuery::create()
                        ->filterByOutletCode($code)
                        ->filterByCompanyId($this->company_id)
                    ->find();
                        if($outlet_rec->count() > 0)
                        {
                            echo $recs.") >>>>>CODE>>>>> ".$name." : ".$code." : exists".PHP_EOL;
                            continue;
                        }       
                    }

                    //echo $recs.") >>>>>CODE>>>>> ".$outlet_type." : ".$code." : ".PHP_EOL;
                    
                    $outlet = new Outlets();

                    $outlet->setOutletName($name);
                    $outlet->setOutletCode($code);
                    $outlet->setOutletEmail($email);
                    $outlet->setOutletSalutation($salutation);
                    //$outlet->setOutletOpeningDate($openning_date);
                    $outlet->setOutletContactName($contact_name);
                    $outlet->setOutletLandlineno($landline);
                    $outlet->setOutletAltLandlineno($alt_landline);

                    if($bday != "" && $this->validateDate($bday)) {
                        $outlet->setOutletContactBday($bday);
                    }
                    if($annivarsary != "" && $this->validateDate($annivarsary)) {
                        $outlet->setOutletContactAnniversary($annivarsary);
                    }
                    
                    $outlet->setOutletIsdCode($isd_code);
                    $outlet->setOutletContactNo($contact_no);
                    $outlet->setOutletStatus("active");
                    $outlet->setOutletAddress($address);
                    $outlet->setOutletStreetName($city);
                    $outlet->setOutletCity($city);
                    $outlet->setOutletState($state);
                    $outlet->setOutletCountry("India");
                    $outlet->setOutletPincode($pincode);
                    $outlet->setOutletGps("0,0");
                    $outlet->setTerritoryId($territory_id);
                    $outlet->setOutlettypeId($outlet_type);
                    $outlet->setOutletClassification($classification_id);
                    $outlet->setCompanyId($this->company_id);

                    $outlet->save();
                    
                    echo $recs.") ".$name." : ".$code." : imported".PHP_EOL;

                }        
            }
        catch (\Exception $e )
        {
            echo "Line  no".$recs.PHP_EOL;
            var_dump($e);
        }
    }
    
    public function importBeats($filepath)
    {
        $recs = 0;

        try{

            $cArray = EmployeeQuery::create()
            ->filterByCompanyId(11)
            ->find()->toKeyIndex("FirstName");
            $cArray = array_change_key_case($cArray,CASE_LOWER);


            $file = fopen($filepath,"r");                       
            $firstRow = true;

            while (($line = fgetcsv($file, 1000, ",")) !== FALSE) 
                 {
                    if($firstRow) {$firstRow = false; continue;}                    
                    $recs = $recs + 1;    

                    $employee = strtolower($line[0]);
                    $desc = $line[1];
                    $name = $line[2];                    
                    $company_id = $line[3];

                    if(!isset($cArray[$employee]))
                    {
                        echo $recs.") >>>>>Employee>>>>> ".$employee." : not found".PHP_EOL;
                        continue;   
                    }

                    $employee_rec = $cArray[$employee];

                    $beat_rec = BeatsQuery::create()
                    ->filterByBeatName($name)
                    ->filterByCompanyId($company_id)
                    ->findOne();

                    if($beat_rec != null)
                    {
                        echo $recs.") >>>>>Beat>>>>> ".$name." : found".PHP_EOL;
                        continue;   
                    }

                    $beat = new Beats();

                    $beat->setBeatName($name);
                    $beat->setBeatCode($name);
                    $beat->setBeatRemark($desc);
                    $beat->setEmployeeId($employee_rec->getPrimaryKey());
                    $beat->setTerritoryId($employee_rec->getTerritoryId());
                    $beat->setCompanyId($company_id);
                    $beat->save();

                    echo $recs.") ".$name." : Imported".PHP_EOL;


                 }
        }
         catch (\Exception $e )
        {
            echo "Line  no".$recs.PHP_EOL;
            var_dump($e);
        }
    }

    function validateDate($date, $format = 'Y-m-d')
        {
            $d = DateTime::createFromFormat($format, $date);
            // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
            return $d && $d->format($format) === $date;
        }
        
    public function importPriceBook($filepath)
    {
        $recs = 0;

        try{

            $cArray = ProductsQuery::create()->find()->toKeyValue("ProductSku","Id");
            $cArray = array_change_key_case($cArray,CASE_LOWER);


            $file = fopen($filepath,"r");                       
            $firstRow = true;

            while (($line = fgetcsv($file, 1000, ",")) !== FALSE) 
                 {
                    if($firstRow) {$firstRow = false; continue;}                    
                    $recs = $recs + 1;    
                    
                    $sku = $line[0];
                    $mrp = $line[1];
                    $ptr = $line[2];
                    $pricebook_id = $line[3];
                    $company_id = $line[4];
                    
                    if(!isset($cArray[$sku]))
                    {
                        echo $recs.") >>>>>SKU>>>>> ".$sku." : not found".PHP_EOL;
                        continue;   
                    }
                    $product_id = $cArray[$sku];
                    
                    $pricbookLines = \entities\PricebooklinesQuery::create()
                            ->filterByCompanyId($company_id)
                            ->filterByProductId($product_id)
                            ->filterByPricebookId($pricebook_id)
                            ->findOne();
                    $status = "Updated";
                    if($pricbookLines == null)
                    {
                        $pricbookLines = new \entities\Pricebooklines();
                        $status = "Imported";
                    }
                    
                    
                    
                    
                    $pricbookLines->setPricebookId($pricebook_id);
                    $pricbookLines->setProductId($product_id);
                    $pricbookLines->setCompanyId($company_id);
                    $pricbookLines->setMaxRetailPrice($mrp);
                    $pricbookLines->setSellingPrice($ptr);
                    $pricbookLines->save();
                    
                    echo $recs.") ".$sku." : ".$ptr." : ".$status.PHP_EOL;
                 }
        }
         catch (\Exception $e )
        {
            echo "Line  no".$recs.PHP_EOL;
            var_dump($e);
        }
    }    
    
    public function importEmployee($filepath)
    {
        $recs = 0;

        try{


            $file = fopen($filepath,"r");                       
            $firstRow = true;

            while (($line = fgetcsv($file, 1000, ",")) !== FALSE) 
                 {
                    if($firstRow) {$firstRow = false; continue;}                    
                    $recs = $recs + 1;    
                    
                    $name = $line[0];
                    $email = trim($line[1]);
                    $phone = trim($line[2]);
                    $code = trim($line[3]);
                    $branchName = trim($line[4]);

                    $Position = trim($line[5]);
                    $rptPosition = trim($line[6]);
                    $territory = trim($line[7]);
                    $designation = trim($line[8]);

                    $rptPosition_id = 0;
                    $Position_id = 0;
                    $designation_id = 0;
                    $territory_id = 0;

                    if($rptPosition == "" || $rptPosition == "-")
                    {
                        echo $recs.") >>>>>Reporting Position Required >>>>> ".$name." >>> ".$phone."".PHP_EOL;
                        continue;
                    }
                    $rptPositionRec = PositionsQuery::create()
                        ->filterByPositionName($rptPosition)
                        ->filterByCompanyId($this->company_id)
                        ->findOne();
                    if($rptPositionRec == null)
                    {
                        echo $recs.") >>>>>Reporting Position not found >>>>> ".$name." >>> ".$rptPosition."".PHP_EOL;
                        continue;
                    }
                    else 
                    {
                        $rptPosition_id = $rptPositionRec->getPrimaryKey();   
                    }
                    

                    if($Position != "")
                    {
                        $PositionRec = PositionsQuery::create()
                        ->filterByPositionName($Position)
                        ->filterByCompanyId($this->company_id)
                        ->findOne();

                        if($PositionRec == null)
                        {
                            $PositionRec = new Positions();
                            $PositionRec->setPositionName($Position);
                            $PositionRec->setCompanyId($this->company_id);
                            $PositionRec->setReportingTo($rptPosition_id);                            
                            $PositionRec->save();                            
                        }

                        $Position_id = $PositionRec->getPrimaryKey();
                    }
                    		
                    $designationRec = DesignationsQuery::create()
                                        ->filterByDesignation($designation)
                                        ->filterByCompanyId($this->company_id)
                                        ->findOne();
                    if($designationRec == null)
                    {
                        $designationRec = new Designations();
                        $designationRec->setDesignation($designation);
                        $designationRec->setCompanyId($this->company_id);
                        $designationRec->save();
                    }

                    $designation_id = $designationRec->getPrimaryKey();
                    
                    if($territory != "" || $territory != "-") {

                        $territoryRec = TerritoriesQuery::create()
                                        ->filterByTerritoryName($territory)
                                        ->filterByCompanyId($this->company_id)
                                        ->findOne();
                        $newTerritory = false;
                        if($territoryRec == null)
                        {
                            $territoryRec = new Territories();
                            $territoryRec->setTerritoryName($territory);
                            $territoryRec->setCompanyId($this->company_id);
                            $territoryRec->setZoneId(87);
                            $territoryRec->save();
                            $newTerritory = true;
                        }

                        $territory_id = $territoryRec->getPrimaryKey();                   
                    }

                    $branch_id = 0;
                    $branch = BranchQuery::create()
                    ->filterByBranchname($branchName)
                    ->filterByCompanyId($this->company_id)
                    ->findOne();

                    if($branch == null)
                    {
                        $branch = new Branch();
                        $branch->setBranchname($branchName);
                        $branch->setCompanyId($this->company_id);
                        $branch->setOrgUnitId(11);
                        $branch->setBranchcode($branchName);
                        $branch->save();
                        $branch_id = $branch->getPrimaryKey();
                    }
                    else 
                    {
                        $branch_id = $branch->getPrimaryKey();
                    }
                    
                    $emp = \entities\EmployeeQuery::create()
                    ->filterByPhone($phone)      
                    ->filterByCompanyId($this->company_id)                      
                    ->findOne();
            
                    if($emp != null)
                    {
                        echo $recs.") >>>>> Update >>>>> ".$name." >>> ".$phone.": Exits".PHP_EOL;
                        
                    }
                    else {
                        
                        echo $recs.") >>>>> New >>>>> ".$name." >>> ".$phone."".PHP_EOL;

                        $emp = new \entities\Employee();
                        
                    }
                    
                    $emp->setFirstName($name);
                    $emp->setEmail($email);
                    $emp->setPhone($phone);                    
                    $emp->setEmployeeCode($code);
                    $emp->setStatus(1);
                    $emp->setReportingTo($rptPosition_id);
                    $emp->setDesignationId($designation_id);
                    $emp->setCompanyId($this->company_id);
                    $emp->setBranchId($branch_id);
                    if($Position_id > 0)
                    {
                        $emp->setPositionId($Position_id);
                    }                    
                    $emp->setGradeId(13);
                    $emp->setOrgUnitId(11);
                    $emp->setZoneId(87);
                    $emp->setTerritoryId($territory_id);
                                        
                    $emp->save();

                    $territoryRec->setTerritoryHead($emp->getPrimaryKey());
                    $territoryRec->save();

                    $userExists = UsersQuery::create()
                                ->filterByCompanyId($this->company_id)
                                ->filterByPhone($phone)
                                ->find();
                    if($userExists->count() > 0)                                
                    {
                        $userExists->delete();
                    }
                    $user = new Users();
                    $user->setCompanyId($this->company_id);
                    $user->setName($name);
                    $user->setUsername($phone);
                    $user->setEmail($email);
                    $user->setPhone($phone);
                    $user->setOtp(9999);
                    $user->setPassword(md5("12345678"));
                    $user->setRoleId(6);
                    $user->setEmployeeId($emp->getPrimaryKey());
                    $user->setStatus(1);
                    $user->setDefaultUser(0);
                    $user->save();

                    
                    
                    echo $recs.") ".$name." : ".$phone." : Complete".PHP_EOL;
                 }
        }
         catch (\Exception $e )
        {
            echo "Line  no".$recs.PHP_EOL;
            var_dump($e);
        }
    }

    function outletBeatDistributorMap($filepath)
    {
        $recs = 0;
        $file = fopen($filepath,"r");                       
        $firstRow = true;

        try{

            $beatsLists = BeatsQuery::create()->filterByCompanyId($this->company_id)->find()->toKeyValue("BeatId","BeatName");
            $pricebooks = PricebooksQuery::create()->filterByCompanyId($this->company_id)->find()->toKeyValue("PricebookName","PricebookId");            
            $EmpList = EmployeeQuery::create()->filterByCompanyId($this->company_id)->find()->toKeyIndex("EmployeeCode");
            $distributors = OutletsQuery::create()->filterByOutlettypeId(13)->find()->toKeyValue("OutletCode","Id");
            

            while (($line = fgetcsv($file, 1000, ",")) !== FALSE) 
                 {
                    if($firstRow) {$firstRow = false; continue;}                    
                    $recs = $recs + 1;         

                    if($recs <= 109) {continue;}

                    $outletCode = $line[0];
                    $outletName = $line[1];
                    $DBName = $line[2];
                    $DBCode = $line[3];
                    $PriceBookName = $line[4];
                    $Division = $line[5];
                    $beatJunk = $line[6];
                    $BeatName = $line[7];
                    $TerritoryName = $line[8];
                    $State = $line[9];
                    $TsiName = $line[10];
                    $EmpCode = trim($line[11]);
                    $EmpPhone = $line[12];

                    $pricebook_id = 0;
                    $beat_id = 0;
                    $outlet_id = 0;
                    $db_id  = 0;
                    $empRec  = 0;
                    
                    if($outletCode == "")
                    {
                        echo $recs.") !!!!!! Code inValid !!!!".$outletCode.PHP_EOL.implode("|",$line).PHP_EOL;    
                        continue;
                    }
                    if(!isset($pricebooks[$PriceBookName]))
                    {
                        echo $recs.") <<<<<< Pricebook Dees not Exist >>>>>>".$outletCode." : ".$PriceBookName.PHP_EOL;    
                        continue;
                    }
                    else 
                    {
                        $pricebook_id = $pricebooks[$PriceBookName];
                    }

                    $outlet_id = $this->_getOutletRec($outletCode);
                    if($outlet_id == 0)
                    {
                        echo $recs.") <<<<<< Outlet Dees not Exist >>>>>>".$outletCode." : ".$outletName.PHP_EOL;    
                        continue;
                    }

                    
                    if(!isset($distributors[$DBCode]))
                    {
                        echo $recs.") <<<<<< Distributor Dees not Exist >>>>>>".$DBCode." : ".$DBName.PHP_EOL;    
                        continue;
                    }
                    else 
                    {
                        $db_id = $distributors[$DBCode];
                    }

                    if(!isset($EmpList[$EmpCode]))
                    {
                        echo $recs.") <<<<<< Employee Dees not Exist >>>>>> ".$EmpCode." : ".$TsiName.PHP_EOL;    
                        continue;
                    }
                    else {
                        $empRec = $EmpList[$EmpCode];
                    }
                    if(isset($beatsLists[$BeatName]))
                    {
                        $beat_id = $beatsLists[$BeatName];
                    }
                    else 
                    {
                        $beat = new Beats();
                        $beat->setBeatName($BeatName);
                        $beat->setBeatCode($BeatName);
                        $beat->setBeatRemark($BeatName);
                        $beat->setEmployeeId($empRec->getPrimaryKey());
                        $beat->setTerritoryId($empRec->getTerritoryId());
                        $beat->setCompanyId($this->company_id);
                        $beat->save(); 
                        $beat_id = $beat->getPrimaryKey();
                        $beatsLists = BeatsQuery::create()->filterByCompanyId($this->company_id)->find()->toKeyValue("BeatId","BeatName");  
                    }

                    $beatoutlet = new BeatOutlets();
                    $beatoutlet->setBeatId($beat_id);
                    $beatoutlet->setOutletId($outlet_id);
                    $beatoutlet->setCompanyId($this->company_id);
                    $beatoutlet->save();
                    echo $recs.")            Beat Mapped ".$outletCode." : ".$BeatName.PHP_EOL;    

                    
                    $outletmappingRec = OutletMappingQuery::create()
                                        ->filterByPrimaryOutletId($db_id)
                                        ->filterBySecondaryOutletId($outlet_id)
                                        ->findOne();

                        if($outletmappingRec != null)
                        {
                            echo $recs.") <<<<Mapping>>>>>".$outletCode." : ".$DBName. " : Exits".PHP_EOL;
                            continue;
                        }

                        $outletmapping = new OutletMapping();

                        $outletmapping->setPrimaryOutletId($db_id);
                        $outletmapping->setSecondaryOutletId($outlet_id);
                        $outletmapping->setPricebookId($pricebook_id);
                        $outletmapping->setCategoryType("Regular");
                        $outletmapping->setIsdefault(0);
                        $outletmapping->save();

                    echo $recs.") ".$outletCode." -> ".$DBName." -> ".$BeatName." : Mapped".PHP_EOL;
                    
                 }

        }
        catch (\Exception $e )
        {
            echo "Line  no".$recs.PHP_EOL;
            var_dump($e);
        }
    }

    function outletBeatMapping($filepath)
    {
        $recs = 0;

        try{

            $beatsList = BeatsQuery::create()
                        ->filterByCompanyId(11)
                        ->find();


            $file = fopen($filepath,"r");                       
            $firstRow = true;

            
            $beatCache = [];

            while (($line = fgetcsv($file, 1000, ",")) !== FALSE) 
                 {
                    if($firstRow) {$firstRow = false; continue;}                    
                    $recs = $recs + 1;         
                    
                    $outletcode = $line[0];
                    $territory_remark = strtolower(trim($line[1]));
                    $zone = trim($line[2]);
                    
                    $outlet = OutletsQuery::create()->filterByOutletCode($outletcode)->findOne();
                    if($outlet)
                    {
                        foreach($beatsList as  $beat)
                        {
                            if(strtolower($beat->getBeatRemark()) == $territory_remark)
                            {
                                
                                $beatoutlet = BeatOutletsQuery::create()
                                                ->filterByOutletId($outlet->getPrimaryKey())
                                                ->filterByBeatId($beat->getPrimaryKey())
                                                ->find();

                                if($beatoutlet->count() > 0)
                                {
                                    echo $recs.") <<<<<< OutletBeatMap >>>>>>".$outletcode." : ".$beat->getBeatName()." : Mapping Exists".PHP_EOL;    
                                    continue;
                                }

                                $beatoutlet = new BeatOutlets();
                                $beatoutlet->setBeatId($beat->getPrimaryKey());
                                $beatoutlet->setOutletId($outlet->getPrimaryKey());
                                $beatoutlet->setCompanyId(11);
                                $beatoutlet->save();

                                echo $recs.") ".$outletcode." : ".$beat->getBeatName()." : Mapped".PHP_EOL;    

                                if(!isset($beatCache[$beat->getPrimaryKey()]))
                                {
                                    $beatCache[$beat->getPrimaryKey()] = true;

                                    $beat->setTerritoryId($outlet->getTerritoryId());
                                    $beat->save();

                                    echo $recs.") >>>>>>>>>> ".$beat->getBeatName()." : Territory Correction".PHP_EOL;    

                                    $employee = $beat->getEmployee();
                                    $employee->setTerritoryId($outlet->getTerritoryId());
                                    $employee->save();

                                    echo $recs.") >>>>>>>>>> ".$employee->getFirstName()." : Territory Correction".PHP_EOL;    
                                }


                            }
                        }
                    }
                    else 
                    {
                        echo $recs.") <<<<<< OutletCode >>>>>>".$outletcode." : ".$territory_remark." : Not Found".PHP_EOL;    
                        continue;
                    }

                    echo $recs.") ".$outletcode." : ".$territory_remark." : Mapped".PHP_EOL;


                }
        }
        catch (\Exception $e )
        {
            echo "Line  no".$recs.PHP_EOL;
            var_dump($e);
        }
    }

public function distributormap($filepath)
{
    $recs = 0;

        try{

            $beatsList = BeatsQuery::create()
                        ->filterByCompanyId(11)
                        ->find();


            $file = fopen($filepath,"r");                       
            $firstRow = true;

            $distributors = OutletsQuery::create()->filterByOutlettypeId(13)->find()->toKeyValue("OutletCode","Id");
            
            $pricebook = PricebooksQuery::create()->filterByCompanyId(11)->find()->toKeyValue("PricebookName","PricebookId");

            while (($line = fgetcsv($file, 1000, ",")) !== FALSE) 
                 {
                    if($firstRow) {$firstRow = false; continue;}                    
                    $recs = $recs + 1;  

                    $beat_name = trim($line[0]);
                    $distributor_code = trim($line[1]);
                    $pricebookName = trim($line[2]);

                    if(!isset($distributors[$distributor_code]))
                    {
                        echo $recs.") <<< Distributor >>> ".$distributor_code." : Not Found".PHP_EOL;    
                        continue;
                    }

                    $distributor_id = $distributors[$distributor_code];

                    if(!isset($pricebook[$pricebookName]))
                    {
                        echo $recs.") <<< Pricebook >>> ".$pricebookName." : Not Found".PHP_EOL;    
                        continue;
                    }

                    $pricebook_id = $pricebook[$pricebookName];


                    $beat = BeatsQuery::create()->filterByCompanyId(11)->filterByBeatName($beat_name)->findOne();

                    if($beat == null)
                    {
                        echo $recs.") <<< Beat >>> ".$beat_name." : Not Found".PHP_EOL;    
                        continue;
                    }
                    $outlets = BeatOutletsQuery::create()->filterByBeatId($beat->getPrimaryKey());
                        

                    foreach($outlets as $outid)
                    {
                        $outletmappingRec = OutletMappingQuery::create()
                                        ->filterByPrimaryOutletId($distributor_id)
                                        ->filterBySecondaryOutletId($outid->getOutletId())
                                        ->find();

                        if($outletmappingRec->count() > 0)
                        {
                            echo $recs.") <<<<Mapping>>>>>".$beat_name." : ".$distributor_code. " Outlet : ".$outid->getOutletId()." : Exits".PHP_EOL;
                            continue;
                        }

                        $outletmapping = new OutletMapping();

                        $outletmapping->setPrimaryOutletId($distributor_id);
                        $outletmapping->setSecondaryOutletId($outid->getOutletId());
                        $outletmapping->setPricebookId($pricebook_id);
                        $outletmapping->setCategoryType("Regular");
                        $outletmapping->setIsdefault(0);
                        $outletmapping->save();

                        echo $recs.") ".$beat_name." : ".$distributor_code. " Outlet : ".$outid->getOutletId()." : Mapped".PHP_EOL;

                    }

                    


                }
        }
        catch (\Exception $e )
        {
            echo "Line  no".$recs.PHP_EOL;
            var_dump($e);
        }

}

public function adhocImports($filepath)
{

    try{

        $terrotries = TerritoriesQuery::create()->filterByCompanyId(11)->find()->toKeyValue("TerritoryName","TerritoryId");
        $terrotries = array_change_key_case($terrotries,CASE_LOWER);


        $file = fopen($filepath,"r");                       
        $firstRow = true;
        $recs = 0;

        while (($line = fgetcsv($file, 1000, ",")) !== FALSE) 
             {
                if($firstRow) {$firstRow = false; continue;}                    
                $recs = $recs + 1;  


                $gst = $line[0];
                $terr = trim(strtolower($line[1]));

                $outlet = OutletsQuery::create()->filterByOutletCode($gst)->findOne();
                if($outlet != null)
                {
                    if(isset($terrotries[$terr])) {
                        $outlet->setTerritoryId($terrotries[$terr]);
                        $outlet->save();
                        echo $recs.") ".$gst." : ".$terr. " Updated".PHP_EOL;
                    }
                    else 
                    {
                        echo $recs.") <<<<Outlet>>>>>".$terr.": Not Found".PHP_EOL;    
                    }
                }
                else 
                {
                    echo $recs.") <<<<Outlet>>>>>".$gst." : Not Found".PHP_EOL;
                }

            }
        }
    catch (\Exception $e )
    {
        echo "Line  no".$recs.PHP_EOL;
        var_dump($e);
    }
}

function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
 
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
 }

 function _getOutletRec($code)
 {
    $outlet_rec = OutletsQuery::create()->filterByOutletCode($code)->filterByCompanyId($this->company_id)->findOne();
    if($outlet_rec != null)
    {
        return $outlet_rec->getPrimaryKey();
    }
    else 
    {
        return 0;
    }
    
 }

}