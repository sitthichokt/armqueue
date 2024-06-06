<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARCustomer_SurveyMessage extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARCustomer_SurveyMessage';
    protected $primaryKey = 'SurveyMsg_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'SurveyMsg_Id'
        ,'ARCust_Id'
        ,'SurveyMsg_Question'
        ,'SurveyMsg_Score1'
        ,'SurveyMsg_Score2'
        ,'SurveyMsg_Score3'
        ,'SurveyMsg_Score4'
        ,'SurveyMsg_Score5'
        ,'SurveyMsg_LogoFile'
        ,'SurveyMsg_PictureFile'
        ,'SurveyMsg_Status'
        ,'SurveyMsg_UpdateBy'
        ,'SurveyMsg_UpdateDate'
        ,'SurveyMsg_Thanks'
        ,'SurveyMsg_Recommend'
        ,'SurveyMsg_Note_Status'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'Agent_CreateBy';
    // protected $updatedField  = 'Agent_UpdateBy';
  
}