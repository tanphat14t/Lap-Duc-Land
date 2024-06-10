<?php
// ajax loadmore recruiment
add_action('wp_ajax_loadmore_recruiment', 'loadmore_recruiment');
add_action('wp_ajax_nopriv_loadmore_recruiment', 'loadmore_recruiment');
function loadmore_recruiment()
{

    $offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;
    $count = 0;

    $args = array(
        'post_type' => 'recruiment',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'DESC',
        'offset' => $offset,
    );
    $loop = new WP_Query($args);
    if (!$loop->have_posts()) {
        wp_die();
    }
    while ($loop->have_posts()) : $loop->the_post(); ?>
        <?php $count++ ?>
        <div class="col-12">
            <div class="box">
                <div class="box-image">
                    <?php
                    $image = get_post_thumbnail_id();
                    $size = 'large'; // (thumbnail, medium, large, full or custom size)
                    if ($image) {
                        echo wp_get_attachment_image($image, $size, "", array("class" => "img-fluid"));
                    }
                    ?>
                </div>
                <div class="box-content">
                    <h3><a href="<?php esc_url(the_permalink()) ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                    <div class="recruiment-infor">
                        <?php $workplace = get_field('recruiment_workplace', get_the_id()) ?>
                        <?php if ($workplace) : ?>
                            <div class="item workplace">
                                <div class="icon">
                                    <?php include get_stylesheet_directory() . '/assets/imgs/icons/location-green.svg'; ?>
                                </div>
                                <div class="content">
                                    <span><?php echo __('Nơi làm việc', 'lapduc') ?></span>
                                    <p><?php echo  esc_html($workplace); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="item date">
                            <div class="icon">
                                <?php include get_stylesheet_directory() . '/assets/imgs/icons/calendar.svg'; ?>
                            </div>
                            <div class="content">
                                <span><?php echo __('Ngày Đăng Tuyển', 'lapduc') ?></span>
                                <?php
                                if (wp_is_mobile()) : ?>
                                    <p><?php echo get_the_date('d/m/Y'); ?></p>
                                <?php else : ?>
                                    <p><?php echo 'Ngày ' . get_the_date('d') . ' Tháng ' . get_the_date('m') . ' Năm ' . get_the_date('Y'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-apply-btn">
                    <a href="<?php esc_url(the_permalink()) ?>" class="btn-apply"><?php echo __('Apply', 'lapduc') ?></a>
                </div>
            </div>
        </div>
    <?php endwhile;
    if ($count < 4) : ?>
        <style>
            .recruiment .button-view-more {
                display: none !important;
            }
        </style>
    <?php endif;
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_loadmore_postdetail', 'loadmore_postdetail');
add_action('wp_ajax_nopriv_loadmore_postdetail', 'loadmore_postdetail');
function loadmore_postdetail()
{

    $offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;
    $idPost = isset($_POST['idPost']) ? $_POST['idPost'] : 0;
    $count = 0;

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'DESC',
        'post__not_in' => array($idPost),
        'offset' => $offset,
    );
    $loop = new WP_Query($args);
    if (!$loop->have_posts()) {
        wp_die();
    }
    while ($loop->have_posts()) : $loop->the_post(); ?>
        <?php $count++ ?>
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
    if ($count < 4) : ?>
        <style>
            .recruiment .button-view-more {
                display: none !important;
            }
        </style>
    <?php endif;
    wp_reset_postdata();
    wp_die();
}


// ajax loadmore recruiment
add_action('wp_ajax_pagination', 'pagination');
add_action('wp_ajax_nopriv_pagination', 'pagination');
function pagination()
{

    $paged = isset($_POST['paged']) ? $_POST['paged'] : 0;

    $argsKnowledge = array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'orderby' => 'date',
        'order' => 'DESC',
        'category_name' => 'kien-thuc-nganh',
        'paged' => $paged
    );
    $postKnowledge = new WP_Query($argsKnowledge);
    if (!$postKnowledge->have_posts()) {
        wp_die();
    } ?>
    <ul class="list-news">
        <?php if ($postKnowledge->have_posts()) :
            while ($postKnowledge->have_posts()) : $postKnowledge->the_post(); ?>
                <li class="item-news">
                    <div class="inner-news">
                        <div class="box-img">
                            <?php
                            $image = get_post_thumbnail_id(get_the_ID());
                            $size = 'large';
                            if ($image) {
                                echo wp_get_attachment_image($image, $size);
                            }
                            ?>
                        </div>
                        <div class="news-name">
                            <a href="<?php echo esc_url(get_permalink(get_the_ID())); ?>" title="<?php echo esc_attr(get_the_title(get_the_ID())); ?>"><?php echo esc_html(get_the_title(get_the_ID())); ?></a>
                        </div>
                        <div class="news-excerpt">
                            <?php echo '<p>' . esc_html(get_the_excerpt(get_the_ID())) . '</p>'; ?>
                        </div>
                        <div class="news-link">
                            <a href="<?php echo esc_url(get_permalink(get_the_ID())); ?>" title="<?php echo esc_attr(get_the_title(get_the_ID())); ?>">
                                <?php include get_stylesheet_directory() . '/assets/imgs/icons/arrow-right.svg'; ?>
                            </a>
                        </div>
                    </div>
                </li>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </ul>
    <?php if ($postKnowledge->max_num_pages > 1) : ?>
        <div class="pagination-wrapper">
            <?php
            // Pagination
            $big = 999999999;
            $icPlay = '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.6663 5.3335L20.6259 15.2931C21.0164 15.6836 21.0164 16.3167 20.6259 16.7073L10.6663 26.6668" stroke="#6F5B3A" stroke-width="1.5" stroke-linecap="round"/>
                       </svg>';
            echo '<div class="custom-pagination">';
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, $paged),
                'total' => $postKnowledge->max_num_pages,
                'prev_next' => true,
                'prev_text' => $icPlay,
                'next_text' => $icPlay,
            ));

            echo '</div>';
            ?>
        </div>
    <?php endif; ?>
<?php
    wp_reset_postdata();
    wp_die();
}
