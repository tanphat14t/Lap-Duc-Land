<?php get_header(); ?>

<?php the_post(); ?>
<main class="single-detail">
    <div class="section-banner-detail ">
        <div class="box-image">
            <?php
            $image = get_field('background_banner_post', 'option');
            $size = 'large'; // (thumbnail, medium, large, full or custom size)
            if ($image) {
                echo wp_get_attachment_image($image, $size, "", array("class" => "img-fluid"));
            }
            ?>
        </div>

    </div>
    <div class="section-body">
        <div class="page-container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <h1 class="title"><?php echo esc_html(the_title()) ?></h1>
                    <div class="date">
                        <span class="icon">
                            <?php include get_stylesheet_directory() . '/assets/imgs/icons/calendar.svg'; ?>
                        </span>
                        <p><?php echo get_the_date('d / m / Y'); ?></p>
                    </div>
                    <div class="content">
                        <?php the_content() ?>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="side-bar">
                        <?php
                        $args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 4,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'post__not_in' => array(get_the_ID()),
                        );
                        $loop = new WP_Query($args);
                        ?>
                        <?php if ($loop->have_posts()) : ?>
                            <div class="news">
                                <h3><?php echo __('Tin tức', 'lapduc') ?></h3>
                                <ul class="list">
                                    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                                        <li class="item">
                                            <h1 class="item-title"><?php echo esc_html(the_title()) ?></h1>
                                            <div class="item-date">
                                                <span class="icon">
                                                    <?php include get_stylesheet_directory() . '/assets/imgs/icons/calendar.svg'; ?>
                                                </span>
                                                <p><?php echo get_the_date('d/m/Y'); ?></p>
                                            </div>
                                            <div class="item-content">
                                                <?php the_excerpt(); ?>
                                            </div>
                                        </li>
                                    <?php endwhile;
                                    wp_reset_postdata(); ?>
                                </ul>
                                <div class="button-view-more">
                                    <a data-id="<?php echo get_the_id(); ?>"><?php echo __('Xem thêm', 'lapduc'); ?></a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="banner">
                            <div class="box-img">
                                <?php
                                $imageMobile = get_field('poster', 'option');
                                $size = 'large'; // (thumbnail, medium, large, full or custom size)
                                if ($imageMobile) {
                                    echo wp_get_attachment_image($imageMobile, $size, "", array("class" => "img-fluid"));
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>