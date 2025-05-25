<?php

$nu=rand(10000000,99999999);
echo $nu;

$plainPassword = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);

echo "\n",$plainPassword;