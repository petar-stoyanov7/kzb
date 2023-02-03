<?php

function register_map_block()
{
	register_block_type(__DIR__);
}
add_action('init', 'register_map_block');
