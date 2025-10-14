<?php

/**
 * This file contains single post content
 *
 * @package ercodingtheme
 * @license GPL-3.0-or-later
 */

get_header();
global $post;

$post = get_post();
$page_id = $post->ID;

$prev_post = get_previous_post();
$next_post = get_next_post();

$therapy = get_field("therapy", $page_id);
$location = get_field("location", $page_id);
$phone_number = get_field("phone_number", $page_id);
$email = get_field("email", $page_id);
$plan4u_code = get_field("plan4u_code", $page_id);
$short_text = get_field("short_text", $page_id);

$form_id = get_field("form_id", $page_id);
?>

<main id="main" class="main main--subpage">
    <div class="subpage-hero">
        <div class="subpage-hero__background subpage-hero__background--plain"></div>
        <div class="container">
            <div class="subpage-hero__wrapper">
                <h1 class="subpage-hero__title">Specjaliści</h1>
            </div>
        </div>
    </div>
    <?php if (have_posts()): ?> <?php while (have_posts()): the_post(); ?> <?php if (get_post_type() == 'specjalisci'): ?>
    <div class="specialist specialist--single">
        <div class="container">
            <div class="specialist__container">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="specialist__image specialist__image--single"><?php echo wp_get_attachment_image(get_post_thumbnail_id($post->ID), 'full', '', ['class' => 'object-fit-cover',]); ?></div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="specialist__column">
                            <div>
                                <h1 class="specialist__name"><?php the_title(); ?></h1>
                                <div class="specialist__details">
                                    <div class="specialist__skills">
                                        <?php $specialist_terms = get_the_terms($post->ID, 'tytul'); ?> <?php if ($specialist_terms && !is_wp_error($specialist_terms)): ?> <?php foreach ($specialist_terms as $specialist_term): ?>
                                        <div class="specialist__skill specialist__skill--specialist"><?php echo esc_html($specialist_term->name); ?></div>
                                        <?php endforeach; ?> <?php endif; ?> <?php $therapy_terms = get_the_terms($post->ID, 'terapia'); ?> <?php if ($therapy_terms && !is_wp_error($therapy_terms)): ?> <?php foreach ($therapy_terms as $therapy_term): ?>
                                        <div class="specialist__skill specialist__skill--therapy"><?php echo esc_html($therapy_term->name); ?></div>
                                        <?php endforeach; ?> <?php endif; ?> <?php $location_terms = get_the_terms($post->ID, 'lokalizacja'); ?> <?php if ($location_terms && !is_wp_error($location_terms)): ?> <?php foreach ($location_terms as $location_term): ?>
                                        <div class="specialist__skill specialist__skill--location"><?php echo esc_html($location_term->name); ?></div>
                                        <?php endforeach; ?> <?php endif; ?> <?php if (!empty($phone_number)): ?>
                                        <div class="specialist__skill specialist__skill--phone">
                                            <a href="tel:<?php echo preg_replace('/\s+/', '', esc_html($phone_number)); ?>" class="specialist__phone">
                                                <span class="ercodingtheme-phone-number"><?php echo esc_html($phone_number); ?></span>
                                            </a>
                                        </div>
                                        <?php endif; ?> <?php if (!empty($email)): ?>
                                        <div class="specialist__skill specialist__skill--email">
                                            <a href="mailto:<?php echo antispambot($email); ?>" class="specialist__email"><?php echo antispambot($email); ?></a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="specialist__description"><?php echo apply_filters('the_content', $short_text);?></div>
                            </div>
                            <a href="#umow-wizyte" class="button mt-4">Umów wizytę</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-10 offset-xl-1">
                    <div class="specialist__wrapper">
                        <div class="specialist__description"><?php the_content(); ?></div>
                        <?php if(!empty($plan4u_code)):?>
                        <div class="specialist__plan4u">
                            <div class="section-id" id="umow-wizyte"></div>
                            <?php echo $plan4u_code;?>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?> <?php endwhile; ?> <?php endif; ?>
</main>
<?php get_footer(); ?>
