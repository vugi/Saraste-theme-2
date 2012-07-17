<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>"  class="form-search">
	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="Etsi sivustolta..." class="input-medium search-query">
	<input type="submit" id="searchsubmit" value="Etsi" class="btn" />
</form>