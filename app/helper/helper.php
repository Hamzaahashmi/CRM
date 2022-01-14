<?php 
use App\Models\User;

function timecal($start, $end)
{
if(empty($end)){
     date_default_timezone_set("Asia/Karachi");
    $end = date("Y-m-d h:i:s");
}
 $start_date = new DateTime($start);
$since_start = $start_date->diff(new DateTime($end));
echo $since_start->days.' days total<br>';
// echo $since_start->y.' years<br>';
// echo $since_start->m.' months<br>';
// echo $since_start->d.'days';
echo $since_start->h.':';
echo $since_start->i.':';
echo $since_start->s;
}

function username($userids)
{
$useridarrys = (explode(",",$userids));
foreach($useridarrys as $useridarry){
$userdata =  User::Find($useridarry);
  echo $userdata["name"].'<br>';
}
}

function usernameLetter($id)
{
$userdata =  User::Find($id);
echo ucwords(substr($userdata['name'], 0, 1));
}