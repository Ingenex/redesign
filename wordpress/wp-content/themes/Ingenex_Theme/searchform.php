
<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url() ; ?>/">
    <label class="screen-reader-text" for="s">Search for:</label>
    <div class="append field">
    <input class="xwide text input" type="text" value="<?php global $s; echo esc_html($s, 1); ?>" name="s" id="s" placeholder="Search">
    <button type="submit" class="medium primary btn"><i class="icon-search"></i></button>
    </div>
</form>