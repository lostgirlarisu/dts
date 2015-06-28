<?php

namespace skill32
{
	//防御获得比例
	$defgain = Array(0,6,13,20,30,40,50);
	//升级所需技能点数值
	$upgradecost = Array(2,2,2,3,3,3,-1);
	
	function init() 
	{
		define('MOD_SKILL32_INFO','club;upgrade;');
	}
	
	function acquire32(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		\skillbase\skill_setvalue(32,'lvl','0',$pa);
	}
	
	function lost32(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
	}
	
	function skill_onload_event(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$chprocess($pa);
	}
	
	function skill_onsave_event(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$chprocess($pa);
	}
	
	function check_unlocked32(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		return 1;
	}
	
	function upgrade32()
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('skill32','player','logger'));
		if (!\skillbase\skill_query(32))
		{
			$log.='你没有这个技能！<br>';
			return;
		}
		$clv = \skillbase\skill_getvalue(32,'lvl');
		$ucost = $upgradecost[$clv];
		if ($clv == -1)
		{
			$log.='你已经升级完成了，不能继续升级！<br>';
			return;
		}
		if ($skillpoint<$ucost) 
		{
			$log.='技能点不足。<br>';
			return;
		}
		$skillpoint-=$ucost; \skillbase\skill_setvalue(32,'lvl',$clv+1);
		$log.='升级成功。<br>';
	}
	
	function get_skill32_extra_def_gain(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('skill32','player','logger'));
		if (!\skillbase\skill_query(32, $pd) || !check_unlocked32($pd)) return 0;
		if ($pd['wepk']!='WP') return 0;
		$defgainrate = $defgain[\skillbase\skill_getvalue(32,'lvl',$pd)];
		return min(2000, $defgainrate * $pd['wepe'] / 100);
	}
	
	function get_external_def(&$pa,&$pd,$active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		return $chprocess($pa, $pd, $active) + get_skill32_extra_def_gain($pa, $pd, $active);
	}
}

?>
