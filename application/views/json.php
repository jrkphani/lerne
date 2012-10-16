<?php
header('Content-Type:application/json');
$data['data'] = $resultset;
echo json_encode($data);
?>
