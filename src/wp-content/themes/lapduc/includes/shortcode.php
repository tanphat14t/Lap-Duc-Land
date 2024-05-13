<?php
function display_news($atts)
{
    // Attributes
    $atts = shortcode_atts(
        array(
            'posts_per_page' => 12,
        ),
        $atts,
        'news'
    );

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $atts['posts_per_page'],
        'orderby' => 'date',
        'order' => 'DESC',
    );
    $posts = new WP_Query($args);
    // Start output buffering
    ob_start();

    // The Loop
    if (!empty($posts)) : ?>
        <div class="page-container">
            <section class="news">
                <div class="post-wrapper">
                    <ul class="list-post">
                        <?php if ($posts->have_posts()) :
                            while ($posts->have_posts()) : $posts->the_post(); ?>
                                <li class="item-post">
                                    <div class="inner-post">
                                        <div class="item-post__image">
                                            <div class="box-img">
                                                <?php
                                                $image = get_post_thumbnail_id(get_the_id());
                                                $size = 'large';
                                                if ($image) {
                                                    echo wp_get_attachment_image($image, $size);
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="item-post__content">
                                            <div class="post-name">
                                                <a href="<?php echo permalink_link(get_the_id()) ?>" title="<?php echo get_the_title(get_the_id()) ?>"><?php echo get_the_title(get_the_id()) ?></a>
                                            </div>
                                            <div class="post-excerpt">
                                                <?php
                                                echo '<p>' . get_the_excerpt(get_the_id()) . '</p>';
                                                ?>
                                            </div>
                                            <div class="post-link">
                                                <a href="<?php echo permalink_link(get_the_id()) ?>" title="<?php echo get_the_title(get_the_id()) ?>">
                                                    <?php include get_stylesheet_directory() . '/assets/imgs/icons/arrow-right.svg'; ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                        <?php
                            endwhile;
                            // Restore original post data
                            wp_reset_postdata();
                        endif;
                        ?>
                    </ul>
                </div>
            </section>
        </div>
    <?php endif ?>
    <?php

    // Get the buffered content and clean the buffer
    $output = ob_get_clean();

    return $output;
}
// Register shortcode news
add_shortcode('news', 'display_news');

// section two jewelry
function display_store_image($atts)
{
    // Attributes
    $atts = shortcode_atts(
        array(
            'posts_per_page' => -1,
        ),
        $atts,
        'stores'
    );

    $args = array(
        'post_type' => 'stores',
        'posts_per_page' => $atts['posts_per_page'],
        'orderby' => 'date',
        'order' => 'DESC',
    );
    $stores = new WP_Query($args);
    // Start output buffering
    ob_start();

    // The Loop
    if (!empty($stores)) : ?>
        <div class="wrapper">
            <h2 class="heading"><?php echo __('Hình ảnh của hàng', 'lapduc') ?></h2>
            <div class="splide splide__store">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php $count = 0; ?>
                        <?php if ($stores->have_posts()) :
                            while ($stores->have_posts()) : $stores->the_post();
                                $count++ ?>
                                <li class="splide__slide gallery-image">
                                    <div class="splide splide-image__store">
                                        <div class="splide__track">
                                            <?php
                                            $gallery_image = get_field('image_galleries_store', get_the_id());
                                            $size = 'full';
                                            if ($gallery_image) : ?>
                                                <ul class="splide__list">
                                                    <?php foreach ($gallery_image as $image_id) : ?>
                                                        <li class="splide__slide">
                                                            <?php echo wp_get_attachment_image($image_id, $size); ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="splide splide-image__store--thumb">
                                        <div class="splide__track">
                                            <?php
                                            $gallery_image = get_field('image_galleries_store', get_the_id());
                                            $size = 'thumbnail';
                                            if ($gallery_image) : ?>
                                                <ul class="splide__list">
                                                    <?php foreach ($gallery_image as $image_id) : ?>
                                                        <li class="splide__slide">
                                                            <?php echo wp_get_attachment_image($image_id, $size); ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="bottom-slide">
                                        <p class="album"><?php echo __('Album', 'lapduc') ?></p>
                                        <h3 class="name__store"><?php echo get_the_title() ?></h3>
                                    </div>
                                </li>
                        <?php
                            endwhile;
                            // Restore original post data
                            wp_reset_postdata();
                        endif;
                        ?>
                    </ul>
                    <div class="page-container">
                        <div class="splide__arrows">
                            <button class="splide__arrow splide__arrow--prev" type="button" aria-label="Go to last slide">
                                <?php include get_stylesheet_directory() . '/assets/imgs/icons/arrow-left-2.svg'; ?>
                            </button>
                            <button class="splide__arrow splide__arrow--next" type="button" aria-label="Next slide">
                                <?php include get_stylesheet_directory() . '/assets/imgs/icons/arrow-left-2.svg'; ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
<?php

    // Get the buffered content and clean the buffer
    $output = ob_get_clean();

    return $output;
}
// Register shortcode stories
add_shortcode('stores', 'display_store_image');
