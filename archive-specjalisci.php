<?php

get_header();
global $post;

$post = get_post();

if (!empty($post)) {
    $page_id = $post->ID;
}

$url = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

$blog_page = filter_input(INPUT_GET, "blog-page", FILTER_SANITIZE_NUMBER_INT);
$current_blog_page = $blog_page ? $blog_page : 1;

$blog_posts_number = get_field("blog_posts_number", "options");
$blog_hero_title = get_field("blog_hero_title", "options");
$blog_hero = get_field("blog_hero", "options");

$archive_title = get_the_archive_title();
$title_parts = explode(":", $archive_title);
$page_title = trim(end($title_parts));

$is_specialist_query =
    is_post_type_archive("specjalisci") || get_query_var("post_type") === "specjalisci";

// Determine the title based on post type
if ($is_specialist_query || strpos($url, "_sf") !== false) {
    $archive_title = "Wybierz specjalistę i umów wizytę";
}
?>

<main id="main" class="main <?php if (!is_front_page()) { echo 'main--subpage';} ?>">
    <div class="subpage-hero">
        <div class="subpage-hero__background subpage-hero__background--plain"></div>
        <div class="container">
            <div class="subpage-hero__wrapper">
                <h1 class="subpage-hero__title">Specjaliści</h1>
            </div>
        </div>
    </div>
    <div class="decorated-text">
        <div class="container">
            <div class="decorated-text__wrapper">
                <h2 class="decorated-text__title">
                    Dzięki różnorodnym kompetencjom i empatycznemu podejściu, Gabinety Heureka to przestrzeń, w której bez problemu znajdziesz wsparcie dla swojego dziecka Wyszukaj odpowiednią terapię i umów się na wizytę, a my zajmiemy się
                    resztą.
                </h2>
            </div>
        </div>
    </div>
    <div class="specialists">
        <div class="container">
            <div class="specialists__wrapper">
                <?php if ($is_specialist_query): ?>
                <div class="specialists__filtration"><?php echo do_shortcode('[searchandfilter id="4814"]'); ?></div>
                <?php endif; ?>
                <div class="row" id="specialists">
                    <?php if (have_posts()): ?> <?php while (have_posts()): ?> <?php the_post(); ?>
                    <div class="col-12 col-md-6 <?php if ($is_specialist_query) { echo 'col-lg-4'; } ?>">
                        <div class="specialist">
                            <a href="<?php the_permalink(); ?>" class="cover"></a>
                            <?php if (!empty(get_post_thumbnail_id())): ?>
                            <div class="specialist__image"><?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'specialist-image', '', [ 'class' => 'object-fit-cover', ]); ?></div>
                            <?php endif; ?>
                            <div class="specialist__content">
                                <h3 class="specialist__title"><?php the_title(); ?></h3>
                                <div class="specialist__skills">
                                    <?php $terms = get_the_terms($post->ID, 'terapia'); if ($terms && !is_wp_error($terms)) { foreach ($terms as $term) { echo ' <div class="specialist__skill">' . esc_html($term->name) . '</div> '; } } ?>
                                </div>

                                <?php $shortTextField = get_field('short_text', get_the_ID()); $excerpt = get_the_excerpt(); $content = get_the_content(); if (!empty($shortTextField)) { $text = wp_strip_all_tags($shortTextField); echo ' <p>' . mb_substr($text, 0, 120) . (mb_strlen($text) > 120 ? '...' : '') . '</p> '; } elseif (!empty($excerpt)) { echo ' <p>' . mb_substr($excerpt, 0, 120) . (mb_strlen($excerpt) > 120 ? '...' : '') . '</p> '; } elseif (!empty($content)) { $contentText = strip_tags($content); echo ' <p>' . mb_substr($contentText, 0, 120) . (mb_strlen($contentText) > 120 ? '...' : '') . '</p> '; } ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="arrow-link mt-3">Zobacz profil</a>
                        </div>
                    </div>
                    <?php endwhile; ?> <?php else: ?>
                    <div class="col-12">
                        <div class="specialists__no-results">
                            <h2>Brak specjalistów o zaznaczonych wymaganiach</h2>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="pagination mt-5">
                <?php echo paginate_links([ 'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))), 'current' => max(1, get_query_var('paged')), 'format' => '?paged=%#%', 'show_all' => false, 'type' => 'list', 'end_size' => 2, 'mid_size' => 1, 'prev_next' => true, 'prev_text' => '', 'next_text' => '', 'add_args' => false, 'add_fragment' => '', ]); ?>
            </div>
            <?php wp_reset_postdata(); ?> <?php wp_reset_query(); ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>
