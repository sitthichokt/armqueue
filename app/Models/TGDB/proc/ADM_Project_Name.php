<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## select list Project Name reminder 
 * - list
*/
class ADM_Project_Name extends Model
{
    protected $DBGroup = 'tgdb';

    public int $Agent_Id;
    public string $ProductType;
    public string $ASWProj_NameThai;

    /**
     * @param int Agent_Id
     * @param string ProductType
     */
    public function list()
    {
        $storedProc = "EXEC ADM_Project_Name  @Agent_Id= ?, @ProductType= ?";
        $params     = [$this->Agent_Id,$this->ProductType];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;
        
    }


    /** Project Name
     * @param int Agent_Id
     * @param string ASWProj_NameThai
     */
    public function ProjectName()
    {
        $storedProc = "EXEC ADM_Project_Name  @Agent_Id= ?, @ProductType= ?";
        $params     = [$this->Agent_Id,$this->ProductType];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        $data['status'] = false; 
        foreach ($results as $value) {
            if($value["ASWProj_NameThai"]===$this->ASWProj_NameThai){
                $data['status']                 = true; 
                $data['ASWProj_Id']             = $value["ASWProj_Id"];
                $data['ASWProj_Code']           = $value["ASWProj_Code"];
                $data['ASWProj_NameThai']       = $value["ASWProj_NameThai"];
                $data['ASWProj_NameEng']        = $value["ASWProj_NameEng"];
                $data['AssetWise_ProductType']  = $value["AssetWise_ProductType"];
                $data['ASWProj_OrderBy']        = $value["ASWProj_OrderBy"];
                break;
            }   
        }
        return $data;  
        
    }
}