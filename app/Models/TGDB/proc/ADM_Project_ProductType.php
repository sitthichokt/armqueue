<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## select list Product Type reminder 
 * - list
*/
class ADM_Project_ProductType extends Model
{
    protected $DBGroup = 'tgdb';

    public $Agent_Id;
    public $LookupValue;

    /**
     * @param int Agent_Id
     */
    public function list()
    {
        $storedProc = "EXEC ADM_Project_ProductType  @Agent_Id= ?";
        $params     = [$this->Agent_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;
        
    }

      /**
     * @param int Agent_Id
     * @param string LookupValue
     */
    public function ProductType()
    {
        $storedProc = "EXEC ADM_Project_ProductType  @Agent_Id= ?";
        $params     = [$this->Agent_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        $data['status'] = false; 
        foreach ($results as $value) {
            if($value["LookupValue"]===$this->LookupValue){
                $data['status'] = true; 
                $data['LookupValue']     = $value["LookupValue"];
                $data['LookupText']      = $value["LookupText"];
                break;
            }   
        }
        return $data;  
        
    }


}