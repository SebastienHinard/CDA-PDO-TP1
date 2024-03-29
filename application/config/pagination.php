<?php

$config['pagination_config'] = array(
    'base_url' => site_url(),
    'total_rows' => 200,
    'per_page' => 5,
    'uri_segment' => 5,
    'use_page_numbers' => TRUE,
    'page_query_string' => TRUE,
    'reuse_query_strong' => TRUE,
    'full_tag_open' => '<ul class="pagination">',
    'full_tag_close' => '</ul>',
    'num_tag_open' => '<li class="page-item"><span class="page-link">',
    'num_tag_close' => '</span></li>',
    'cur_tag_open' => '<li class="page-item active"><a class="page-link" href="#">',
    'cur_tag_close' => '</a></li>',
    'prev_tag_open' => '<li class="page-item"><span class="page-link">',
    'prev_tag_close' => '</span></li>',
    'next_tag_open' => '<li class="page-item"><span class="page-link">',
    'next_tag_close' => '</span></li>',
    'prev_link' => '<i class="fas fa-arrow-left"></i>',
    'next_link' => '<i class="fas fa-arrow-right"></i>',
    'last_tag_open' => '<li class="page-item"><span class="page-link">',
    'last_tag_close' => '</span></li>',
    'first_tag_open' => '<li class="page-item"><span class="page-link">',
    'first_tag_close' => '</span></li>');
