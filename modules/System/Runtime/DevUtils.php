<?php declare(strict_types = 1);

namespace Modules\System\Runtime;


class DevUtils
{

    var $order_view = array(
        array(
            "ord_order_Id" => 771,
            "ord_order_number" => "PO-00183",
            "ord_order_type" => "PO",
            "ord_outlet_from" => 11580,
            "ord_outlet_to" => 16188,
            "ord_pricebook_id" => 14,
            "ord_order_date" => "2022-11-08",
            "ord_order_subtotal" => 660.00,
            "ord_order_discount" => 82.32,
            "ord_order_total" => 577.68,
            "ord_order_qty" => 3.00,
            "ord_employee_id" => 126,
            "ord_booking_date" => NULL,
            "ord_territory_id" => NULL,
            "ord_zone_id" => NULL,
            "ord_company_id" => 11,
            "ord_order_status" => "Created",
            "ord_order_rerference" => NULL,
            "ord_order_remark" => NULL,
            "ord_otp_req_id" => NULL,
            "ord_beat_id" => 328,
            "frm_id" => 11580,
            "frm_outlet_media_id" => NULL,
            "frm_outlet_name" => "Fine Medicos",
            "frm_outlet_code" => "17371",
            "frm_outlet_email" => "",
            "frm_outlet_salutation" => "Mr.",
            "frm_outlet_classification" => 16,
            "frm_outlet_opening_date" => NULL,
            "frm_outlet_contact_name" => "Rakesh",
            "frm_outlet_landlineno" => "-",
            "frm_outlet_alt_landlineno" => "-",
            "frm_outlet_contact_bday" => NULL,
            "frm_outlet_contact_anniversary" => NULL,
            "frm_outlet_isd_code" => "+91",
            "frm_outlet_contact_no" => "9971581679",
            "frm_outlet_alt_contact_no" => NULL,
            "frm_outlet_status" => "active",
            "frm_outlet_address" => "Shop No 831-A Prem Nagar Multani Dhanda",
            "frm_outlet_street_name" => "-",
            "frm_outlet_city" => "Delhi",
            "frm_outlet_state" => "Delhi",
            "frm_outlet_country" => "India",
            "frm_outlet_pincode" => "110055",
            "frm_outlet_gps" => "0,0",
            "frm_territory_id" => 66,
            "frm_outlettype_id" => 14,
            "frm_company_id" => 11,
            "frm_created_at" => "2022-11-04 16:31:27",
            "frm_updated_at" => "2022-11-05 14:46:37",
            "frm_outlet_otp" => NULL,
            "frm_outlet_verified" => NULL,
            "frm_outlet_created_by" => NULL,
            "frm_outlet_approved_by" => NULL,
            "frm_outlet_potential" => NULL,
            "to_id" => 16188,
            "to_outlet_media_id" => NULL,
            "to_outlet_name" => "Art Creations",
            "to_outlet_code" => "07AWJPS7034H1Z7",
            "to_outlet_email" => "",
            "to_outlet_salutation" => "Mr",
            "to_outlet_classification" => 17,
            "to_outlet_opening_date" => NULL,
            "to_outlet_contact_name" => "Art Creations",
            "to_outlet_landlineno" => "",
            "to_outlet_alt_landlineno" => "",
            "to_outlet_contact_bday" => NULL,
            "to_outlet_contact_anniversary" => NULL,
            "to_outlet_isd_code" => "",
            "to_outlet_contact_no" => "",
            "to_outlet_alt_contact_no" => NULL,
            "to_outlet_status" => "active",
            "to_outlet_address" => "Art Creations",
            "to_outlet_street_name" => "",
            "to_outlet_city" => "delhi",
            "to_outlet_state" => "delhi",
            "to_outlet_country" => "india",
            "to_outlet_pincode" => "",
            "to_outlet_gps" => "0,0",
            "to_territory_id" => 66,
            "to_outlettype_id" => 13,
            "to_company_id" => 11,
            "to_created_at" => "2022-11-04 16:58:48",
            "to_updated_at" => "2022-11-10 14:34:00",
            "to_outlet_otp" => NULL,
            "to_outlet_verified" => NULL,
            "to_outlet_created_by" => NULL,
            "to_outlet_approved_by" => NULL,
            "to_outlet_potential" => NULL,
            "emp_employee_id" => 126,
            "emp_company_id" => 11,
            "emp_position_id" => NULL,
            "emp_reporting_to" => 38,
            "emp_designation_id" => 48,
            "emp_branch_id" => 11,
            "emp_grade_id" => 13,
            "emp_org_unit_id" => 11,
            "emp_zone_id" => 87,
            "emp_territory_id" => 66,
            "emp_employee_code" => NULL,
            "emp_first_name" => "Ashok Kumar",
            "emp_last_name" => "",
            "emp_status" => 1,
            "emp_ip_address" => NULL,
            "emp_profile_picture" => NULL,
            "emp_email" => "ashokrawal1971@gmail.com",
            "emp_last_login" => NULL,
            "emp_phone" => "9958664742",
            "emp_address" => NULL,
            "emp_costNumber" => NULL,
            "emp_created_at" => "2022-11-01 16:50:26",
            "emp_updated_at" => NULL,
            "emp_base_mtarget" => NULL,
            "emp_integration_id" => NULL,
            "beat_beat_id" => 328,
            "beat_beat_name" => "Multani Dhanda-V1",
            "beat_beat_remark" => "Multani Dhanda",
            "beat_beat_code" => "Multani Dhanda-V1",
            "beat_territory_id" => 66,
            "beat_company_id" => 11,
            "beat_employee_id" => 126,
        ),
    );
    
    
    function createView()
    {
            foreach($this->order_view[0] as $col => $val)
            {
                $phpname = $this->dashesToCamelCase($col,true);

                if(is_string($val))
                {
                    echo '<column name="'.$col.'" phpName="'.$phpname.'" type="VARCHAR" size="200"/>'.PHP_EOL;
                }
                else if(is_bool($val))
                {
                    echo '<column name="'.$col.'" phpName="'.$phpname.'" type="INTEGER"/>'.PHP_EOL;
                }
                else if(is_integer($val))
                {
                    echo '<column name="'.$col.'" phpName="'.$phpname.'" type="INTEGER"/>'.PHP_EOL;
                }
                else if(is_float($val))
                {
                    echo '<column name="'.$col.'" phpName="'.$phpname.'" type="DECIMAL" size="20" scale="2"/>'.PHP_EOL;
                }
                else
                {
                    echo '<column name="'.$col.'" phpName="'.$phpname.'" type="VARCHAR" size="200"/>'.PHP_EOL;
                }
            }
    }

    function dashesToCamelCase($string, $capitalizeFirstCharacter = false) 
    {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }
        return $str;
    }
}
