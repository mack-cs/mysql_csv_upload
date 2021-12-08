<?php

  $z = array(['barcode','length', 'width', 'height']);

  array_push($z, ['90',"10",'1','19']);

foreach ($z as $items) {
	foreach ($items as $item) {
		echo $item;
	}
}
  

?>