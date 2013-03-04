<?php
header("Content-type: application/pdf");
header('Content-Disposition: attachment; filename="'.$title_for_layout.'"');
echo $content_for_layout;
?>