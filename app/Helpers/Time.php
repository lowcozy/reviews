<?php 
use Carbon\Carbon;
class Time {
	public static function diff($date)
	{
		$now = Carbon::now('Asia/Ho_Chi_Minh');
		$interval = $date->diff($now);

		$second = $interval->format('%s');
		$min = $interval->format('%i');
		$hour = $interval->format('%h');
		$day = $interval->format('%d');
		$month = $interval->format('%m');
		$year = $interval->format('%y');

		if($year >= 1)
		{
			if($year == 1) $result = $year. ' year ago';
			else $result = $year. ' years ago';
		}
		else
		{
			if($month >= 1)
				{
					if($month == 1) $result = $month. ' month ago';
					else $result = $month. ' month ago';
				}
			else
			{
				if($day >=1)
				{
					if($day == 1) $result = $day. ' day ago';
					else $result = $day. ' days ago';
				}
				else
				{
					if($hour >= 1)
					{
						if($hour == 1) $result = $hour. ' hour ago';
						else $result = $hour. ' hours ago';
					}
					else
					{
						if($min >1)
						{
							if($min == 1) $result = $min. ' min ago';
							else $result = $min. ' mins ago';
						}
						else
							{

									if($second == 1) $result = $second. ' second ago';
									else $result = $second. ' seconds ago';
								
							}
					}
				}
			}
		}

		return $result;
	}

	public static function timer($time)
	{
		$result = '';
		$array_time = explode(':', $time);
		$result .= $array_time[0].':'.$array_time[1];
		return $result;
	}
}