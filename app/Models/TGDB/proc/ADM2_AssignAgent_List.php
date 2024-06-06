<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM2_AssignAgent_List extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id='';
    public $Agent_Group_Id='';
    public $Agent_Id_PK='';
    public $CustSocial_Type='';
    public $CustSocial_Id='';
    public $ScreenType='';


    /**
     * @param Agent_Id
     * @param Agent_Group_Id
     * @param Agent_Id_PK
     * @param CustSocial_Type
     * @param CustSocial_Id
     * @param ScreenType
     */
    public function get()
    {
        $storedProc = "EXEC ADM2_AssignAgent_List  @Agent_Id=?,@Agent_Group_Id=?,@Agent_Id_PK=?,@CustSocial_Type=?,@CustSocial_Id=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                    $this->Agent_Group_Id,
                    $this->Agent_Id_PK,
                    $this->CustSocial_Type,
                    $this->CustSocial_Id,
                    $this->ScreenType];
        $query      = $this->db->query($storedProc, $params);

        if($this->ScreenType==='Excel'){
            $results['head'] = $query->getFieldNames();
            $results['body'] = $query->getResultArray(); 
        }else{
            $results    = $query->getResultArray();
        }

        return $results;
        
    }
}