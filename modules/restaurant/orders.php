<?php

    $orders = q("
		SELECT *
		FROM `orders`
		ORDER BY `id` DESC
	");
