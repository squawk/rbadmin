<?php
header("Content-type: application/octet-stream");
$title_for_layout = str_replace('_', '.', $title_for_layout);
if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE"))
{
   header('Content-Disposition: attachment; filename="'.$title_for_layout.'.csv"');
   header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
   header('Pragma: public');
}
else
{
   header('Content-Disposition: attachment; filename="'.$title_for_layout.'.csv"');
   header('Pragma: no-cache');
}
header('Expires: 0');
echo $content_for_layout;
