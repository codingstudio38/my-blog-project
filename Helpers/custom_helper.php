<?php 
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\BlogModel;
 
 if(!function_exists('GetRowById')){
    function GetRowById(int $id){
    try {
        DB::select("SET @p0='$id'"); 
        DB::select("SET @p1=''");
        DB::select("CALL `CountRowById`(@p0, @p1)");
        $total_record = DB::select("SELECT @p1 AS `total_row`");
        if(count($total_record) <= 0){
            return array('result'=>false,'data'=>'','total_rows'=>$total_record);
        }
        $total = $total_record[0]->total_row;
        if($total <= 0){
            return array('result'=>false,'data'=>'','total_rows'=>$total);
        }
        $user_data = DB::select("CALL GetRowById(?)",array($id));
        $user = $user_data[0];
        return array('result'=>true,'data'=>$user,'total_rows'=>$total);
    } catch (\Throwable $error) {
        $data = array(
            'message'=>$error->getMessage(),
            'errors'=>$error
         );
        return view('error_handler.ERROR_PAGE',$data);
    }
    }
 }

 
 if(!function_exists('GetRowByEmail')){
    function GetRowByEmail(string $emailid){
    try {
        DB::select("SET @p0='$emailid'");
        DB::select("SET @p1=''");
        DB::select("CALL `CountRowByEmail`(@p0, @p1)");
        $total_record = DB::select("SELECT @p1 AS `total_row`");
        if(count($total_record) <= 0){
            return array('result'=>false,'data'=>'','total_rows'=>$total_record);
        }
        $total = $total_record[0]->total_row;
        if($total <= 0){
            return array('result'=>false,'data'=>'','total_rows'=>$total);
        }
        $user_data = DB::select("CALL GetRowByEmail(?)",array($emailid));
        $user = $user_data[0];
        return array('result'=>true,'data'=>$user,'total_rows'=>$total);
    } catch (\Throwable $error) {
        $data = array(
            'message'=>$error->getMessage(),
            'errors'=>$error
         );
        return view('error_handler.ERROR_PAGE',$data);
    }
    }
 }

if(!function_exists('my_custom_time')){
    function custom_time($date){
        date_default_timezone_set('Asia/Kolkata');
        return date("M d, Y h:i A", strtotime($date));
    }
}

if(!function_exists('in_date_time')){
    function in_date_time(){
        date_default_timezone_set('Asia/Kolkata');
        return date("Y-m-d H:i:s");
    }
}

if(!function_exists('remove_html_tag')){
    function remove_html_tag($data){
        if($data==""){
            return "";
        } 
        $content = strip_tags($data);
        $tag = array('&nbsp;','&#39;');
        $text= str_replace('&nbsp;'," ",$content);
        $text= str_replace('&#39;',"'",$text);
        return $text;
    }
}
 
if (!function_exists('mysql_escape'))
{
    function mysql_escape($inp)
    { 
        if(is_array($inp)) return array_map(__METHOD__, $inp);

        if(!empty($inp) && is_string($inp)) { 
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
        } 

        return $inp; 
    }
}



if(!function_exists('GetRecentPost')){
    function GetRecentPost(){
    try {
        $list_query  = BlogModel::select('id','photo','title','created_at')->orderBy('id','desc');
        $total = $list_query->count();
        $list = $list_query->limit(4)->get();
        return array('result'=>true,'list'=>$list,'total_rows'=>$total);
    } catch (\Throwable $error) {
        $data = array(
            'message'=>$error->getMessage(),
            'errors'=>$error
         );
        return view('error_handler.ERROR_PAGE',$data);
    }
    }
 }




?>