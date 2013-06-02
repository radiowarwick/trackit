<?php
$template = false;
$item = Item::getById($_REQUEST['id']);
$db = $item->getChildren();

foreach ($db as $item){
	$return['id'] = $item->getId();
	$return['friendlyName'] = $item->getFriendlyName();
	$items[] = $return;
}

echo json_encode($items);
?>