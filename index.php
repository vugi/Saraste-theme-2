<?php
get_header();

query_posts('showposts=11&cat=-5,-7,-9');
get_template_part('loop', 'index');

get_footer();
?>