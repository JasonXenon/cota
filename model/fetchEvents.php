<?php
include "read.php";


$result = readRdvAndJeuInfos();

foreach ($result as $row){
  $start_time = new DateTime($row['rdv_date_start'], new DateTimeZone('Europe/Paris'));
  $end_time = new DateTime($row['rdv_date_end'], new DateTimeZone('Europe/Paris'));
  if($start_time->format('H') == 02){
    $start_time->setTime(14,0);
    $end_time->setTime(18,0);
  }
  $data[] =array(
    'id' =>$row['rdv_id'],
    'title' =>$row['rdv_pseudo'].' - '.$row['confirmation_status'],
    'start' => $start_time->format('Y-m-d H:i:s'),
    'end' => $end_time->format('Y-m-d H:i:s'),
    'jeu' =>$row['rdv_jeu_id'],
    'color' =>$row['jeu_color'],
    'confirmation_status'=>$row['confirmation_status']
    );
    }

echo json_encode($data);

?>


