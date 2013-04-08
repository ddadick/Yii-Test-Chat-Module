<?php
/**
 * 
 * @author Denis Gubenko
 *
 */
foreach($list as $item){
	echo $item->date.', '.$item->time.', '.$item->user.': '.$item->message.PHP_EOL;
}