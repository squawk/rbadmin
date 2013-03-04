<?php
header("Content-type: application/octet-stream");
if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE"))
{
   header('Content-Disposition: attachment; filename="'.$title_for_layout.'"');
   header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
   header('Pragma: public');
}
else
{
   header('Content-Disposition: attachment; filename="'.$title_for_layout.'"');
   header('Pragma: no-cache');
}
header('Expires: 0');
echo $content_for_layout;
