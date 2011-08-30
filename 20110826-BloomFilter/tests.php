<?php

$a = hash('sha256', 'test');
echo base_convert(substr($a, 1, 1), 16, 10);
