<?php 

class OpenOrClose {
	public static function open($open, $close)
	{
		$current = \Carbon\Carbon::now()->format('H:i:s');
		if($current <= $close && $current >= $open)
		{
			$result = '<div class="time bg-green">Now Open</div>';
                                            
		}
		else
		{
			$result = '<div class="time">Now Close</div>';
		}                            
		return $result;
	}
}