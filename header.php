<!DOCTYPE HTML>
<html>
<head>
    
    <title><?php bloginfo( 'name' ); wp_title( '|' ); ?></title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="Pilots N Paws is a 501c3 non-profit organization. This site is intended to be a meeting place for those who rescue, shelter or foster animals, and volunteer pilots and plane owners willing to assist with the transportation of animals.">
    <meta name="keywords" content="pilots n paws, pet rescue, pet flights, rescue flights, pet pilots, save a pet, donate, donate to animals, animal donations">
    <meta name="viewport" content="initial-scale=1.0"/>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php bloginfo( 'template_directory' ); ?>/favicon.ico">
	<!-- Standard iPhone --> 
    <link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo( 'template_directory' ); ?>/touch-icon-iphone-114.png" />
    <!-- Retina iPhone --> 
    <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo( 'template_directory' ); ?>/touch-icon-iphone-114.png" />
    <!-- Standard iPad --> 
    <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo( 'template_directory' ); ?>/touch-icon-ipad-144.png" />
    <!-- Retina iPad --> 
    <link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo( 'template_directory' ); ?>/touch-icon-ipad-144.png" />
    
    <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css">

    <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        
        <style type="text/css">

            .search .search-item.even,
            .home-stories article.even {
                background: #f8f8f8;
            }
            
            .preview-stories article {
                width: 270px;
            }

        </style>
    <![endif]-->
	
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<!-- Google analytics tracking added by Mike Green 2015-05-06 -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-62646402-2', 'auto');
  ga('send', 'pageview');
</script>
<!-- end Google analytics --> 
    
    <header class="top">
        
        <a class="mobile-search" href="#">Icon</a>
        
        <?php get_search_form(); ?>
        
        <a class="mobile-nav" href="#">Icon</a>
        
        <nav>
           
           <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
           
        </nav>

    </header>
   
<?php 

$preview1 = wp_get_attachment_image_src( get_field( 'feature_image_1', 'options'), 'medium' );
$preview2 = wp_get_attachment_image_src( get_field( 'feature_image_2', 'options'), 'medium' );

$image1 = $preview1[0]; 
$image2 = $preview2[0]; ?>
            
<section class="feature">
    
    <section class="container">
        
        <a class="logo-pic" href="<?php bloginfo( 'url' ); ?>"><img src="<?php the_field( 'logo', 'options' ); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" /></a>
    
        <a class="logo" href="<?php bloginfo( 'url' ); ?>">
            
            <?php bloginfo( 'name' ); ?>
            
            <br/>
            
            <span> <?php bloginfo( 'description' ); ?> </span>
            
        </a>
        
        <?php get_template_part( 'includes/ad-bar' ); ?>
    
    </section>
    
</section>