<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />
    <?php wp_head(); ?>
    <style type="text/css">
        * { 
            box-sizing: border-box; 
            width: 100%;
            margin: 0;
            padding: 0;
        }
        html, body { 
            background-color: #0077b5;
            height: 100%;
            padding: 1rem;
            position: relative;
            color: #fff;
            font-size: 20px;
            font-weight: 400;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            line-height: 1;
            text-align: center;
        }
        header, footer { 
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        h1 {
            font-size: 3rem;
            line-height: 1;
        }
        footer { 
            top: auto;
            bottom: 10px;
            transform: translate(-50%, 0);
        }
        a { 
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body <?php body_class( 'agtech' ); ?>>
    <header>
        <h1 class="site-title" style="margin: 0 0 20px;">
            <?php
                if( get_bloginfo( 'name' ) ) {
                    echo get_bloginfo( 'name' );
                }
            ?>
        </h1>
        <p class="tagline" style="font-style: italic;">
            <?php
                if( get_bloginfo( 'description' ) ) {
                    echo get_bloginfo( 'description' );
                }
            ?>
        </p>
    </header>
    <footer>
        <p class="powered-by">
            <a href="<?php echo apply_filters( 'agtech_powered_by_link', esc_url( 'https://wordpress.org' ) ); ?>">
                <?php echo apply_filters( 'agtech_powered_by_text', esc_html__( 'Proudly Powered by WordPress', 'agtech' ) ); ?>
            </a>
        </p>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>