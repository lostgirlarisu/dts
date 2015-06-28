<?php

namespace boxes
{
	function init()
	{
		eval(import_module('itemmain'));
		$iteminfo['p'] = '礼物';
		$iteminfo['ygo'] = '卡包';
		$iteminfo['fy'] = '全图唯一的野生浮云礼盒';
	}

	function itemuse(&$theitem) 
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		
		eval(import_module('sys','player','itemmain','logger'));
		
		$itm=&$theitem['itm']; $itmk=&$theitem['itmk'];
		$itme=&$theitem['itme']; $itms=&$theitem['itms']; $itmsk=&$theitem['itmsk'];
		
		if(strpos ( $itmk, 'p' ) === 0)
		{
			$log.="你打开了<span class=\"yellow\">$itm</span>。<br>";
			$file = __DIR__.'/config/present.config.php';
			$plist = openfile($file);
			$rand = rand(0,count($plist)-1);
			list($in,$ik,$ie,$is,$isk) = explode(',',$plist[$rand]);
			$itm0 = $in;$itmk0=$ik;$itme0=$ie;$itms0=$is;$itmsk0=$isk;
			addnews($now,'present',$name,$itm,$in);
			\itemmain\itms_reduce($theitem);
			\itemmain\itemget();		
			return;
		} elseif(strpos ( $itmk, 'ygo' ) === 0){
			$log.="你打开了<span class=\"yellow\">$itm</span>。<br>";
			$file = __DIR__.'/config/ygobox.config.php';
			$plist1 = openfile($file);
			$rand1 = rand(0,count($plist1)-1);
			list($in,$ik,$ie,$is,$isk) = explode(',',$plist1[$rand1]);
			$itm0 = $in;$itmk0=$ik;$itme0=$ie;$itms0=$is;$itmsk0=$isk;
			addnews($now,'present',$name,$itm,$in);
			\itemmain\itms_reduce($theitem);
			\itemmain\itemget();	
			return;
		} elseif(strpos ( $itmk, 'fy' ) === 0){
			$log.="你打开了<span class=\"yellow\">$itm</span>。<br>";
			$file = __DIR__.'/config/fybox.config.php';
			$plist1 = openfile($file);
			$rand1 = rand(0,count($plist1)-1);
			list($in,$ik,$ie,$is,$isk) = explode(',',$plist1[$rand1]);
			$itm0 = $in;$itmk0=$ik;$itme0=$ie;$itms0=$is;$itmsk0=$isk;
			addnews($now,'present',$name,$itm,$in);
			\itemmain\itms_reduce($theitem);
			\itemmain\itemget();	
			return;
		}
		$chprocess($theitem);
	}
	
	function parse_news($news, $hour, $min, $sec, $a, $b, $c, $d, $e)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys','player'));
		
		if($news == 'present') 
			return "<li>{$hour}时{$min}分{$sec}秒，<span class=\"yellow\">{$a}打开了{$b}，获得了{$c}！</span><br>\n";
		
		return $chprocess($news, $hour, $min, $sec, $a, $b, $c, $d, $e);
	}
		
}

?>
