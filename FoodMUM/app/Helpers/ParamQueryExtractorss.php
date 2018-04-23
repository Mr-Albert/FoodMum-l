<?php
namespace App\Helpers;
 
class ParamQueryExtractorss {
    /**
     * @param int $user_id User-id
     * 
     * @return string
     */
    public static function get_filters($request) {
        $filter_arr=[];
        if(isset($request['pq_datatype']))
            $filter_arr['data_type']=$request['pq_datatype'];
        else
            $filter_arr['data_type']="JSON"; 
            if(isset($request['pq_curpage']))
            $filter_arr['current_page']=$request['pq_curpage'];
        else
            $filter_arr['current_page']=1; 
            if(isset($request['pq_rpp']))
            $filter_arr['records_per_page']=$request['pq_rpp'];
        else
            $filter_arr['records_per_page']=5; 
        if(isset($request['pq_filter']))
        {
            $request_pq_filter= json_decode($request['pq_filter']);
            $filter_arr['mode']=$request_pq_filter->mode;
            foreach($request_pq_filter->data as $datum)
            {
                if(isset($datum->type))
                    $type=$datum->type;
                else
                    $type="string";
                if(isset($datum->value))
                    $value=$datum->value;
                else
                    $value="";
                if(isset($datum->value2))
                    $value2=$datum->value2;
                else
                    $value2="";
                if ($value2=="")
                    $values=$value;    
                else
                    $values=array($value,$value2);            
                $current_datum=array($datum->dataIndx=>array('values'=>$values,"data_type"=>$type));    
                $filter_arr['filter'][]=$current_datum;
            }
        }
        else
            $filter_arr['filter']=[]; 
    
    
    
            return ($filter_arr);
    }
}