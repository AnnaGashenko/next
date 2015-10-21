<?php

$lasterest_news = q("
	SELECT *
	FROM `news`
	WHERE `date` > NOW() - INTERVAL 1 MINUTE
");


