<?php
namespace App\Models\TGDB\functions;
use CodeIgniter\Model;


class Fn_encrypt extends Model
{
	protected $DBGroup = 'tgdb';
    
    /** เข้ารหัสสำหรับ email Post_Comment_Id */
    public function encrypt($post_idz) {

        // $post_idz = "a@gmail.comRE: Hi2323222023/04/19 16:45:52";
        $query = 'select dbo.Fn_encrypt(?) as code';
        $result = $this->db->query($query, array($post_idz));
        $results         = $result->getRowArray();
        return $results['code'];		
	}
}