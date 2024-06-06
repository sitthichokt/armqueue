<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ADM4_ContactProfile_List_Y2023 extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id         = '';
    public $Social_Cat_Id    = '';
    public $Social_SubCat_Id = '';
    public $Social_Type      = '';
    public $CustSocial_Id    = '';
    public $SocialName       = '';
    public $CustomerName     = '';
    public $ScreenType       = 'List';
    public $Block            = '';

    /**
     * @param Agent_Id
     * @param Social_Cat_Id
     * @param Social_SubCat_Id
     * @param Social_Type
     * @param CustSocial_Id
     * @param SocialName
     * @param CustomerName
     * @param ScreenType
     */
    public function list()
    {
        $storedProc = "EXEC ADM4_ContactProfile_List_Y2023 @Agent_Id=?,@Social_Cat_Id=?,@Social_SubCat_Id=?,@Social_Type=?,@CustSocial_Id=?,@ScreenType=?,@SocialName=?,@CustomerName=?,@Block=?";
        $params     = [$this->Agent_Id,
                        $this->Social_Cat_Id,
                        $this->Social_SubCat_Id,
                        $this->Social_Type,
                        $this->CustSocial_Id,
                        $this->ScreenType,
                        $this->SocialName,
                        $this->CustomerName,
                        $this->Block
                    ];
        $query      = $this->db->query($storedProc, $params);
   
        if($this->ScreenType==='Excel'){
            $results['head'] = $query->getFieldNames();
            $results['body'] = $query->getResultArray(); 
        }else{
            $results    = $query->getResultArray();
        }
        unset($query,$storedProc);
        return $results;
    }
}