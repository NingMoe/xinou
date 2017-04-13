<?php
 require_once(dirname(__FILE__) . '/../config.php');
$row = $dsql -> GetOne('SELECT value FROM `#@__sysconfig` where varname=\'cfg_df_style\'');
$style = $row['value'];
$row = $dsql -> GetOne('SELECT value FROM `#@__sysconfig` where varname=\'cfg_basehost\'');
$pcsy = $row['value'];
$row = $dsql -> GetOne('SELECT value FROM `#@__sysconfig` where varname=\'pc\'');
$pc = $row['value'];
$row = $dsql -> GetOne('SELECT value FROM `#@__sysconfig` where varname=\'m\'');
$m = $row['value'];
$row = $dsql -> GetOne('SELECT value FROM `#@__sysconfig` where varname=\'wapurl\'');
$wapurl = $row['value'];
$row = $dsql -> GetOne('SELECT value FROM `#@__sysconfig` where varname=\'sqm\'');
$sqm = $row['value'];
$row = $dsql -> GetOne('SELECT value FROM `#@__sysconfig` where varname=\'canshu\'');
$pcwap = $row['value'];
$row = $dsql -> GetOne('SELECT value FROM `#@__sysconfig` where varname=\'jiance\'');
$jiance = $row['value'];
$row = $dsql -> GetOne('SELECT value FROM `#@__sysconfig` where varname=\'cfg_updateperi\'');
$az = $row['value'];
$row = $dsql -> GetOne('SELECT * FROM  `#@__homepageset`,`#@__arctype`');
$templet = $row['templet'];
$position = $row['position'];
$typedir = $row['typedir'];
$wzsqm = $sqm;
$now = time();
$sqm = 'banchengwei' . pack('H*', substr($sqm, 9, -7));
$limit = substr($sqm, -10);
function getdomain($dephp_0){
    $dephp_1 = strtolower($dephp_0);
    if (strpos($dephp_1, '/') !== false){
        $dephp_2 = @parse_url($dephp_1);
        $dephp_1 = $dephp_2 ['host'];
    }
    $dephp_3 = array('com', 'edu', 'gov', 'int', 'mil', 'net', 'org', 'biz', 'info', 'pro', 'name', 'museum', 'coop', 'aero', 'xxx', 'idv', 'mobi', 'cc', 'me');
    $dephp_4 = '';
    foreach ($dephp_3 as $dephp_5){
        $dephp_4 .= ($dephp_4 ? '|' : '') . $dephp_5;
    }
    $dephp_6 = '[^\.]+\.(?:(' . $dephp_4 . ')|\w{2}|((' . $dephp_4 . ')\.\w{2}))$';
    if (preg_match('/' . $dephp_6 . '/ies', $dephp_1, $dephp_7)){
        $dephp_8 = $dephp_7 ['0'];
    }else{
        $dephp_8 = $dephp_1;
    }
    return $dephp_8;
}
$yuming = getdomain($pcsy);
if($limit - $now > 0 && strstr($sqm, $yuming) || strstr($yuming, '127') || strstr($yuming, 'localhost')){
    $empower = '1';
}else if($wzsqm == "" && $az !== '255' && $jiance == ""){
    $empower = '1';
    class RandChar{
        function getRandChar($dephp_9){
            $dephp_10 = null;
            $dephp_11 = '01235678efmn';
            $dephp_12 = strlen($dephp_11)-1;
            for($dephp_13 = 0;$dephp_13 < $dephp_9;$dephp_13++){
                $dephp_10 .= $dephp_11[rand(0, $dephp_12)];
            }
            return $dephp_10;
        }
    }
    $randCharObj = new RandChar();
    $sjq = $randCharObj -> getRandChar(9);
    $sjh = $randCharObj -> getRandChar(7);
    $qixian = strtotime('+7 day');
    $sqqixian = $yuming . $qixian;
    $sqqixian = $sjq . bin2hex($sqqixian) . $sjh;
    $dsql -> ExecuteNoneQuery("update #@__sysconfig set value = '$sqqixian' where varname='sqm';");
    $dsql -> ExecuteNoneQuery('update #@__sysconfig set value = \'255\' where varname=\'cfg_updateperi\';');
    $dsql -> ExecuteNoneQuery('update #@__sysconfig set value = \'10\' where varname=\'jiance\';');
}else{
    $empower = "1";
}
