<?php

namespace BI\requests;

use DateTime;


/**
 * Description of MTP Manager
 *
 * @author Chintan
 */
class TourPlanRequest
{

    var $mtp_id;
    var $mtp_day_id;
    var $outlet_org_data_id;
    var $agenda_id;
    var $itownid;
    var $beat_id;
    var $agendacontroltype;
    var $tp_date;
    var $campaign_visit_plan_id;





    /**
     * Get the value of mtp_id
     */
    public function getMtp_id()
    {
        return $this->mtp_id;
    }

    /**
     * Set the value of mtp_id
     *
     * @return  self
     */
    public function setMtp_id($mtp_id)
    {
        $this->mtp_id = $mtp_id;

        return $this;
    }

    /**
     * Get the value of mtp_day_id
     */
    public function getMtp_day_id()
    {
        return $this->mtp_day_id;
    }

    /**
     * Set the value of mtp_day_id
     *
     * @return  self
     */
    public function setMtp_day_id($mtp_day_id)
    {
        $this->mtp_day_id = $mtp_day_id;

        return $this;
    }

    /**
     * Get the value of outlet_org_data_id
     */
    public function getOutlet_org_data_id()
    {
        return $this->outlet_org_data_id;
    }

    /**
     * Set the value of outlet_org_data_id
     *
     * @return  self
     */
    public function setOutlet_org_data_id($outlet_org_data_id)
    {
        $this->outlet_org_data_id = $outlet_org_data_id;

        return $this;
    }

    /**
     * Get the value of agenda_id
     */
    public function getAgenda_id()
    {
        return $this->agenda_id;
    }

    /**
     * Set the value of agenda_id
     *
     * @return  self
     */
    public function setAgenda_id($agenda_id)
    {
        $this->agenda_id = $agenda_id;

        return $this;
    }

    /**
     * Get the value of itownid
     */
    public function getItownid()
    {
        return $this->itownid;
    }

    /**
     * Set the value of itownid
     *
     * @return  self
     */
    public function setItownid($itownid)
    {
        $this->itownid = $itownid;

        return $this;
    }

    /**
     * Get the value of beat_id
     */
    public function getBeat_id()
    {
        return $this->beat_id;
    }

    /**
     * Set the value of beat_id
     *
     * @return  self
     */
    public function setBeat_id($beat_id)
    {
        $this->beat_id = $beat_id;

        return $this;
    }

    /**
     * Get the value of agendacontroltype
     */
    public function getAgendacontroltype()
    {
        return $this->agendacontroltype;
    }

    /**
     * Set the value of agendacontroltype
     *
     * @return  self
     */
    public function setAgendacontroltype($agendacontroltype)
    {
        $this->agendacontroltype = $agendacontroltype;

        return $this;
    }

    /**
     * Get the value of tp_date
     */
    public function getTp_date()
    {
        return $this->tp_date;
    }

    /**
     * Set the value of tp_date
     *
     * @return  self
     */
    public function setTp_date($tp_date)
    {
        $this->tp_date = $tp_date;

        return $this;
    }

    /**
     * Get the value of campaign_visit_plan_id
     */ 
    public function getCampaignVisitPlanId()
    {
        return $this->campaign_visit_plan_id;
    }

    /**
     * Set the value of campaign_visit_plan_id
     *
     * @return  self
     */ 
    public function setCampaignVisitPlanId($campaign_visit_plan_id)
    {
        $this->campaign_visit_plan_id = $campaign_visit_plan_id;

        return $this;
    }
}