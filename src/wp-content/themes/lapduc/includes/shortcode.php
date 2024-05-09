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
