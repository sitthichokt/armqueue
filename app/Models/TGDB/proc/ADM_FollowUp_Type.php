<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## select list Follow Up Type reminder 
 * - list
*/
class ADM_FollowUp_Type extends Model
{
    protected $DBGroup = 'tgdb';

    public int $Agent_Id;
    public int $FType_Id;

    /**
     * @param int Agent_Id
     */
    public function list()
    {
        $storedProc = "EXEC ADM_FollowUp_Type  @Agent_Id= ?";
        $params     = [$this->Agent_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;
        
    }

        /** Project Name
     * @param int Agent_Id
     * @param int FType_Id
     */
    public function FollowType()
    {
        $storedProc = "EXEC ADM_FollowUp_Type  @Agent_Id= ?";
        $params     = [$this->Agent_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        $data['status'] = false; 
        foreach ($results as $value) {
            if($value["FType_Id"]===$this->FType_Id){
                $data['status']                 = true;  
                $data['FType_Id']               = $value["FType_Id"];
                $data['FType_Code']             = $value["FType_Code"];
                $data['FType_Name']             = $value["FType_Name"];   
                break;
            }   
        }
        return $data;  
        
    }
}