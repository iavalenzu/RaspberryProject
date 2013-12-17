<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$url = "http://konalen.dev/api/loginform" . "?" .  http_build_query($get);

debug($url);

?>


<iframe src="<?php echo $url; ?>"></iframe>