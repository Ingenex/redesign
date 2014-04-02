<?php get_header(); ?>

<section id="main" role="main">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article class="post tweleve colums" id="post-<?php the_ID(); ?>">

        <h1><?php the_title(); ?></h1>

        <div class="entry">

            <?php the_content(); ?>
            <h2>Buttons</h2>
            <div class="example-grid btnmarg">
                <div class="row">
                    <div class="six columns">
                        <h4 class="lead">Metro Style</h4>
                        <div class="medium primary btn"><a href="#">Priadsfasdfmary</a></div>
                        <div class="medium secondary btn"><a href="#">Secondary</a></div>
                        <div class="medium default btn"><a href="#">Default</a></div>
                        <div class="medium info btn"><a href="#">Info</a></div>
                        <div class="medium danger btn"><a href="#">Danger</a></div>
                        <div class="medium warning btn"><a href="#">Warning</a></div>
                        <div class="medium success btn"><a href="#">Success</a></div>
                        <div class="medium info btn icon-left entypo icon-mail"><a href="#">Icon Left</a></div>
                        <div class="medium default btn icon-right entypo icon-camera"><a href="#">Icon Right</a></div><div class="medium default btn"><input type="submit" value="Submit"></div>
                        <div class="medium info btn"><button>Button</button></div>
                    </div>
                    <div class="six columns pretty">
                        <h4 class="lead">Pretty Style</h4>
                        <div class="pretty medium primary btn"><a href="#">Primary</a></div>
                        <div class="pretty medium secondary btn"><a href="#">Secondary</a></div>
                        <div class="pretty medium default btn"><a href="#">Default</a></div>
                        <div class="pretty medium info btn"><a href="#">Info</a></div>
                        <div class="pretty medium danger btn"><a href="#">Danger</a></div>
                        <div class="pretty medium warning btn"><a href="#">Warning</a></div>
                        <div class="pretty medium success btn"><a href="#">Success</a></div>
                        <div class="medium info btn icon-left icon-user"><a href="#">Icon Left</a></div>
                        <div class="medium default btn icon-right icon-camera"><a href="#">Icon Right</a></div>
                        <div class="pretty medium default btn"><input type="submit" value="Submit"></div>
                        <div class="pretty medium info btn"><button>Button</button></div>
                    </div>
                </div>
            </div>
                <div class="fourteen colgrid">
                    <div class="row">
                        <div class="seven columns">
                            <h4 class="lead">Sizes</h4>
                            <div class="xlarge btn default"><a href="#">Extra Large</a></div>
                            <div class="large btn default"><a href="#">Large</a></div>
                            <div class="medium btn default"><a href="#">Medium</a></div>
                            <div class="small btn default"><a href="#">Small</a></div>
                        </div>
                        <div class="seven columns">
                            <h4 class="lead">Styles</h4>
                            <div class="medium oval btn default"><a href="#">Oval</a></div>
                            <div class="medium metro rounded btn default"><a href="#">Rounded</a></div>
                            <div class="medium squared btn default"><a href="#">Squared</a></div>
                            <div class="medium btn pill-left default"><a href="#">Pill Left</a></div>
                            <div class="medium btn pill-right default"><a href="#">Pill Right</a></div>
                        </div>
                    </div>
                </div>
                <div class="modal" id="modal1">
                    <div class="content">
                        <a class="close switch" gumby-trigger="|#modal1"><i class="icon-cancel" /></i></a>
                    <div class="row">
                        <div class="ten columns centered text-center">
                            <h2>This is a modal.</h2>
                            <p>Gumby modals are easy to make using Toggles &amp; Switches.</p>
                            <p class="btn primary medium">
                                <a href="#" class="switch" gumby-trigger="|#modal1">Close Modal</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php wp_link_pages( array( 'before' => 'Pages: ', 'next_or_number' => 'number' ) ); ?>


        </article>

        <?php endwhile; endif; ?>

</section> <!-- /#main -->
<?php get_footer(); ?>
