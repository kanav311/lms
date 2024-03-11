<?php
namespace App\V2\Model;

use App\Lib\BaseTable;
use App\Survey;
use Laminas\Db\Sql\Select;
use Laminas\Paginator\Adapter\DbSelect;
use Laminas\Paginator\Paginator;

class SurveyResponseTable extends BaseTable
{
    protected $tableName = 'survey_responses';
    //protected $primary = 'survey_response_id';

    public function getPaginatedRecords($paginated=false,$id=null)
    {
        $select = new Select($this->tableName);
        $select->order($this->primary.' desc');

        if($this->accountId && !GLOBAL_ACCESS){
            $select->where(['admin_id'=>ADMIN_ID]);
        }

        if (isset($id) && !empty($id)){
            $select->where(['survey_id'=>$id]);
        }

        if($paginated)
        {
            $paginatorAdapter = new DbSelect($select,$this->tableGateway->getAdapter());
            $paginator = new Paginator($paginatorAdapter);
            return $paginator;
        }

        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }


    public function getTotalForTest($id,$startDate=null,$endDate=null)
    {
         $select = new Select($this->tableName);
        $select->where(['survey_id'=>$id]);
        if($startDate){
            $select->where($this->tableName.'.created_on >= '.$startDate);
        }

        if($endDate){
            $select->where($this->tableName.'.created_on <= '.$endDate);
        }

        $rowset = $this->tableGateway->selectWith($select);
        $total = $rowset->count();
        return $total;
    }

}
