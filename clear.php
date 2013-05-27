<?php
session_start();
session_destroy();
echo sha1('12345');
?>