<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## ข้อความที่บันทึกไว้ */
class AssetWise_WrapUp_CaseType extends Model
{
    protected $DBGroup = 'tgdb';

    public $OutputType = '';
    public $Agent_Id = '';
    public $ASWCaseType_L1_Id = '';
    public $ASWCaseType_L2_Id = '';
    public $ASWCaseType_L3_Id = '';

    public $Case_Type = '';
    public $Case_SubType_1 = '';
    public $Case_SubType_2 = '';
   
    /**
     * @param string OutputType
     * @param int Agent_Id
     * @param int ASWCaseType_L1_Id
     * @param int ASWCaseType_L2_Id
     * @param int ASWCaseType_L3_Id
     */
    public function list()
    {
        $storedProc = "EXEC AssetWise_WrapUp_CaseType  @OutputType= ?,@Agent_Id= ?,@ASWCaseType_L1_Id= ?,@ASWCaseType_L2_Id= ?,@ASWCaseType_L3_Id= ?";
        $params     = [
            $this->OutputType,
            $this->Agent_Id,
            $this->ASWCaseType_L1_Id,
            $this->ASWCaseType_L2_Id,
            $this->ASWCaseType_L3_Id
        ];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;
        
    }

    /** CaseType
     * @param int Agent_Id
     * @param int ASWCaseType_L1_Id
     * @param int Case_Type ที่ต้องการตรวจ
     */
    public function CaseType()
    {
       
        $storedProc = "EXEC AssetWise_WrapUp_CaseType  @OutputType= ?,@Agent_Id= ?,@ASWCaseType_L1_Id= ?,@ASWCaseType_L2_Id= ?,@ASWCaseType_L3_Id= ?";
        $params     = [
            'CaseType',
            $this->Agent_Id,
            $this->ASWCaseType_L1_Id,
            $this->ASWCaseType_L2_Id,
            $this->ASWCaseType_L3_Id
        ];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        $data['status'] = false; 
        foreach ($results as $value) {
            if($value["Case Type"]===$this->Case_Type){
                $data['status'] = true; 
                $data['Case_Type'] = $value["Case Type"];
                $data['ASWCaseType_L1_Id'] = $value["ASWCaseType_L1_Id"];             
                break;
            }   
        }
        return $data;    
    }

       /** subtype1
     * @param int Agent_Id
     * @param int ASWCaseType_L1_Id
     * @param int ASWCaseType_L2_Id
     * @param int Case_SubType_1 ที่ต้องการตรวจ
     */
    public function subtype1()
    {
       
        $storedProc = "EXEC AssetWise_WrapUp_CaseType  @OutputType= ?,@Agent_Id= ?,@ASWCaseType_L1_Id= ?,@ASWCaseType_L2_Id= ?,@ASWCaseType_L3_Id= ?";
        $params     = [
            'subtype1',
            $this->Agent_Id,
            !empty($this->ASWCaseType_L1_Id?$this->ASWCaseType_L1_Id:''),
            !empty($this->ASWCaseType_L2_Id?$this->ASWCaseType_L2_Id:''),
            !empty($this->ASWCaseType_L3_Id?$this->ASWCaseType_L3_Id:'')
        ];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
		
        $data['status'] = false; 
		if(!empty($results)){
        foreach ($results as $value) {
            if($value["Case SubType 1"]===$this->Case_SubType_1){
                $data['status'] = true; 
                $data['Case_SubType_1']     = $value["Case SubType 1"];
                $data['ASWCaseType_L2_Id']  = $value["ASWCaseType_L2_Id"];
                break;
            }   
        }
		}
        return $data;    
    }

        /** subtype1
     * @param int Agent_Id
     * @param int ASWCaseType_L1_Id
     * @param int ASWCaseType_L2_Id
     * @param int ASWCaseType_L3_Id
     * @param int Case_SubType_2 ที่ต้องการตรวจ
     */
    public function subtype2()
    {
       
        $storedProc = "EXEC AssetWise_WrapUp_CaseType  @OutputType= ?,@Agent_Id= ?,@ASWCaseType_L1_Id= ?,@ASWCaseType_L2_Id= ?,@ASWCaseType_L3_Id= ?";
        $params     = [
            'subtype2',
            $this->Agent_Id,
            !empty($this->ASWCaseType_L1_Id?$this->ASWCaseType_L1_Id:''),
            !empty($this->ASWCaseType_L2_Id?$this->ASWCaseType_L2_Id:''),
            !empty($this->ASWCaseType_L3_Id?$this->ASWCaseType_L3_Id:'')
        ];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        $data['status'] = false; 
			if(!empty($results)){
        foreach ($results as $value) {
            if($value["Case SubType 2"]===$this->Case_SubType_2){
                $data['status'] = true; 
                $data['Case_SubType_2']     = $value["Case SubType 2"];
                $data['ASWCaseType_L3_Id']  = $value["ASWCaseType_L3_Id"];
                break;
            }   
        }
			}
        return $data;    
    }

}