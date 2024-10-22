<?php declare(strict_types = 1);

namespace Modules\System\Processes;

class UserProcess extends \App\Core\Process
{
    
    function setLocations()
    {        
        
        
        $users = \entities\UsersQuery::create()
                ->filterByIPaddress(NULL, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)                
                ->filterByIpLocation("", \Propel\Runtime\ActiveQuery\Criteria::EQUAL)                
                ->find();
        foreach($users as $u)  
        {            
            
            $json = file_get_contents('http://ip-api.com/json/'.$u->getIPaddress());
            $obj = json_decode($json);            
            $city_name = $obj->city;
            $region = $obj->country;
            $u->setIpLocation($city_name."/".$region);
            $u->save();
        }
                
    }
    
    function senReminders(){
        $company = \entities\CompanyQuery::create()->select('CompanyId')
                ->filterbyexpenseReminder(0,\Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->find()->toArray();
        
        $last_month_start_date = date('Y-m-d', strtotime('first day of last month'));
        $last_month_end_date =  date('Y-m-d', strtotime('last day of last month'));

        
        if(count($company) > 0){
            
                $all_user = \entities\ExpensesQuery::create()
                        ->select('EmployeeId')
                        ->filterByExpenseDate($last_month_start_date,\Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                        ->filterByExpenseDate($last_month_end_date,\Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                        ->filterByCompanyId($company)
                        ->groupByEmployeeId()
                        ->find()
                        ->toArray();    
                if(count($company) > 0){
                    foreach($all_user as $user_id){
                        $user = \entities\EmployeeQuery::create()                                
                                ->findPk($user_id);
                             
                        $body = $this->getExpenseData($user_id,$last_month_start_date,$last_month_end_date);   
                        
                        \App\Utils\Emails::sendEmail($user->getEmail(), 'Reminder for pending expense', $body,$user->getCompanyId());
                    }
                }
        }
        
    }
    
    function getExpenseData($user_id,$start_date,$end_date){
          $all_exp = \entities\ExpensesQuery::create()                      
                    ->filterByExpenseDate($start_date,\Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByExpenseDate($end_date,\Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                        
                    ->filterByEmployeeId($user_id)
                    ->find();  

          $all_dates = array();
          $all_status = \entities\WfStatusQuery::create()
                ->findByWfId(2)
                ->toKeyValue("WfStatusId","WfStatusName");
          
          $all_status[0] = 'No expensys';
          
          while($start_date <= $end_date){
            $all_dates[$start_date] = $all_status[0];  
            $start_date =  date('Y-m-d', strtotime($start_date.'+1 day'));
          }
          
          foreach($all_exp as $row){
              
              $all_dates[$row->getExpenseDate()->format('Y-m-d')] = $all_status[$row->getExpenseStatus()];
              
          }
          
            $html = '<b>Your last month expenses summary </b> <br>'
                    . '<table>
                        <tr>
                          <th>Date</th>
                          <th>Day</th>
                          <th>Status</th>                          
                        </tr>';
            
            foreach($all_dates as $key => $val){
                $day = date("l", strtotime($key));
                $html .= "<tr>
                            <td>$key</td>
                            <td>$day</td>
                            <td>$val</td>
                          </tr>";
            }
            
            $html .= '</table>';
          
          return $html;
    }
        
        
    
}