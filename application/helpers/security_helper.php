<?php

	function xssPrevent($arr){
	    return array_map('htmlentities', $arr);
	}

?>