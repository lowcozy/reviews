<?php 

class StarRating {
	public static function rate ($rate){
		$result = '';
		if(is_double($rate) && 
			($rate== 0.0 || $rate == 1.0 || $rate == 2.0 || $rate == 3.0 || $rate == 4.0 || $rate == 5.0 ) 
		)
		{
			for($i = 1; $i <= $rate ; $i++)
			{
				$result .= '<i class="fa fa-star"></i>';
			}
			for($i = $rate+1; $i <= 5 ; $i++)
			{
				$result .= '<i class="fa fa-star-o"></i>';
			}
		}
		else
		{
			for($i = 1; $i < $rate; $i++)
			{
				$result .= '<i class="fa fa-star"></i>';
			}
				$result .= '<i class="fa fa-star-half-o"></i>';
			$next = (int)$rate+2;
			for($i = $next ; $i <=5; $i++)
			{
				$result .= ' <i class="fa fa-star-o"></i>';
			}
		}

		return $result;
	}
}


 