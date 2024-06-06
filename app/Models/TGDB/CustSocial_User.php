<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class CustSocial_User extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'CustSocial_User';
    protected $primaryKey = 'CustUser_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
         'CustUser_Id'
        ,'CustSocial_Id'
        ,'User_Id'
        ,'User_Name'
        ,'User_Picture'
        ,'User_ScreenName'
        ,'User_ScreenName_1stTime'
        ,'User_Picture_1stTime'
        ,'PDPA_Popup'
    ];

    public  $CustUser_Id;
    public  $CustSocial_Id;

   public function profile(){
    if(!empty($this->CustUser_Id)&&!empty($this->CustSocial_Id)){
    
        $query = $this->db->query("SELECT User_ScreenName,User_Name,User_Picture,User_Id  FROM  CustSocial_User  where CustUser_Id={$this->CustUser_Id} and CustSocial_Id={$this->CustSocial_Id} ");
        $row   = $query->getRow(0);
        if($row){
                    $name           =   $row->User_ScreenName==''?$row->User_Name:$row->User_ScreenName;
                    $names          =   $name==''||$name==null?'N/A':$name;
                    $arr['name']    =   $names;
                    $arr['img']     =   $row->User_Picture;
                    $arr['User_Id'] =   $row->User_Id; 
            return $arr;   
        } 
    }  
}
  
}