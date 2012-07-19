<?php
get_header();

query_posts('showposts=11');
get_template_part('loop', 'index');

get_footer();
?>