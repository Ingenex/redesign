<?php get_header(); ?>

<section id="intro" role="quote">
        <blockquote>
            "Customers come to us because they aren’t growing fast enough. They want more qualified leads."
            <cite>
                Derek Mehraban, Ingenex CEO
            </cite>
        </blockquote>
</section>

  
<section id="services" role="complementary ">
    <div id="hero" class=" parallax" gumby-parallax=".5">
        <div id="hero-bg" style="background-image: url(http://napkin-famble.codio.io:3000/wordpress/wp-content/themes/Ingenex_Theme/assets/images/hero/hero4.png);"></div>
        <div class="valign full-width">
            <div class="hero-content centered">
                
                    <div class="box third">
                        <div>
                            <h2>Inbound Marketing</h2>
                            <p>
                           		Experience shows that Inbound Marketing is the best way to engage prospects and convert them into loyal customers. Ingenex creates sales funnels for our clients that move prospects from awareness, to purchase decision. Inbound marketing and laser focused content lead the way.
                            </p>
                        </div>
                    </div>
                    <div class="box third">
                        <div>
                            <h2>Web Design</h2>
                            <p>
                            	We tell your brand story through stunning web design, compelling content and focused landing pages that convert prospects into leads. Our user-friendly websites employ responsive design so your customers have a consistent experience, regardless of what device they access your content from.
                            </p>
                        </div>
                    </div>
                    <div class="box third">
                        <div>
                            <h2>Paid Media</h2>
                            <p>
                            	Once your brand message and website are ready, we drive traffic to your site through paid media. We create the strategy, build your campaigns, and manage Google, Bing, Yahoo, Linkedin, Twitter, Facebook, and remarketing ads for our clients. We also recommend new forms of digital advertising that can impact your bottom line.
                            </p>
                        </div>
                    </div>
              </div>
        </div>
         <img class="hero-overlay" src="http://napkin-famble.codio.io:3000/wordpress/wp-content/themes/Ingenex_Theme/assets/images/hero/hero_overlay2.png" alt="Ingenex Services section seperator">
    </div>
</section>

 
<section id="cta" role="persuation" class="cta-section clearfix">
    <h3>90% of potential customers will find you when they are ready to buy. Our job is to make you findable, and get you more prospects.</h3>
    <a class="cta right" href="#" >Learn how we do it</a>
</section>
<img class="hero-overlay" src="http://napkin-famble.codio.io:3000/wordpress/wp-content/themes/Ingenex_Theme/assets/images/hero/hero_overlay3.png" alt="Ingenex Services section seperator">


<section id="clients" role="client list">
    <h2 class="section-title">Our Clients</h2>
        <div class="row">
            <div class="two columns">
                <img src="http://ingenexdigital.com/wp-content/themes/Ingenex_theme/images/clients/aiag.png" alt="aiag">
            </div>

            <div class="two columns">
                <img src="http://ingenexdigital.com/wp-content/themes/Ingenex_theme/images/clients/aaum.png" alt="University of Michigan Alumni Association">
            </div>

            <div class="two columns">
                <img src="http://ingenexdigital.com/wp-content/themes/Ingenex_theme/images/clients/cranbrook-is.png" alt="cranbrook-is">
            </div>

            <div class="two columns">
                <img src="http://ingenexdigital.com/wp-content/themes/Ingenex_theme/images/clients/guardian.png" alt="guardian">
            </div>

            <div class="two columns">
                <img src="http://ingenexdigital.com/wp-content/themes/Ingenex_theme/images/clients/piedmont.png" alt="piedmont">
            </div>

            <div class="two columns">
                <img src="http://ingenexdigital.com/wp-content/themes/Ingenex_theme/images/clients/campuscommandos.png" alt="Campus Commandos">
            </div>
    </div>
    <div class="row">
            <div class="two columns">
                <img src="http://ingenexdigital.com/wp-content/themes/Ingenex_theme/images/clients/inforum.png" alt="inforum">
            </div>
            <div class="two columns">
                <img src="http://ingenexdigital.com/wp-content/themes/Ingenex_theme/images/clients/webers.png" alt="webers">
            </div>

            <div class="two columns">
                <img src="http://ingenexdigital.com/wp-content/themes/Ingenex_theme/images/clients/thinkstretch.png" alt="thinkstretch">
            </div>

            <div class="two columns">
                <img src="http://ingenexdigital.com/wp-content/themes/Ingenex_theme/images/clients/plante-moran.png" alt="plante-moran">
            </div>

            <div class="two columns">
                <img src="http://ingenexdigital.com/wp-content/themes/Ingenex_theme/images/clients/osram.png" alt="osram">
            </div>

            <div class="two columns">
                <img src="http://ingenexdigital.com/wp-content/themes/Ingenex_theme/images/clients/cranbrook.png" alt="cranbrook">
            </div>
    </div>
</section>

<section id="cta-2" class="cta-section" role="complementary ">
   
    <div id="hero" class=" parallax" gumby-parallax=".5">
        <div id="hero-bg" style="background-image: url(http://napkin-famble.codio.io:3000/wordpress/wp-content/uploads/2014/09/test_slider3.jpg);"></div>
          <img class="hero-overlay" src="http://napkin-famble.codio.io:3000/wordpress/wp-content/themes/Ingenex_Theme/assets/images/hero/hero_overlay1.png" alt="Ingenex Services section seperator">
        <div class="valign full-width">
            <div class="hero-content centered">
                <div class="clearfix">
                    
                    <h3>ACCURATE MEASUREMENT AND TRACKING ALLOWS YOU TO PERFECT YOUR SALES FUNNEL AND INCREASE CONVERSIONS</h3>
                    <a class="cta left" href="#" >￼LEARN THE 5 METRICS THAT WILL TRANSFORM YOUR SALE SUCCESS</a>
                </div>
            </div>
        </div>
        <img class="hero-overlay" src="http://napkin-famble.codio.io:3000/wordpress/wp-content/themes/Ingenex_Theme/assets/images/hero/hero_overlay.png" alt="Ingenex Services section seperator">
    </div>
</section>



<section id="blog" role="blog preview">
    <h2 class="section-title">Our Blog</h2>
    <?php get_template_part('templates/partials/content','offset');?> 
</section>

 
<section id="main" role="main">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="entry">

        <?php the_content(); ?>

        <?php echo do_shortcode('[hero parallax=true background="http://napkin-famble.codio.io:3000/wordpress/wp-content/themes/Ingenex_Theme/assets/images/hero/hero2.png"][/hero]'); ?>
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

    <div class="slide">
    </div>

    <?php endwhile; endif; ?>

</section> <!-- /#main -->
 
</div> <!-- /row -->
<?php get_footer(); ?>
