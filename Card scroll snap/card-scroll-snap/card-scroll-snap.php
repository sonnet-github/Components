<?php
/**
 * WYSIWYG Block Template
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */  

    // Support custom "anchor" values.
    $anchor = '';
    if ( ! empty( $block['anchor'] ) ) {
        $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
    }

    // Get acf fields value and set default
    $live_mode = get_field('live_mode');
    $top_text = get_field('top_text');
    $top_paragraph = get_field('top_paragraph');
    $blocks = get_field('blocks');
    $image_right_bottom_gradient = get_field('image_right_bottom_gradient');
    $gradient_image_left = get_field('gradient_image_left');
    $background = get_field('background_color') ?: '#FFFFFF';

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--card-scroll-snap';
    if ( ! empty( $block['className'] ) ) {
        $class_name .= ' ' . $block['className'];
    }
    if ( ! empty( $block['align'] ) ) {
        $class_name .= ' align' . $block['align'];
    }

    // Show preview image in preview mode
    if(get_field('preview_image')) :
        echo '<img src="'.\SDEV\Utils::getThemeResourcePath('src/views/blocks/').get_field('preview_image').'" style="width: 100%;" />';
    else :
?>

<?php if ((int)$live_mode): ?>
    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?> style="background-color:<?= $background ?>;">
        <div class="container-block">
            <div class="top-wrapper">
                <div class="top-wrapper__inner">
                    <h4><?=$top_text?></h4>
                    <?=$top_paragraph?>
                    <?php if (isset($gradient_image_left['url'])): ?>
                        <img class="img-top-gradient" src="<?=$gradient_image_left['url']?>" alt="bg image2">
                    <?php endif ?>
                </div>
            </div>

            <div class="tabs-wrapper">
                
                <?php foreach ($blocks as $key => $block): ?>
                    <?php $border_color = $block['border_color'] ?: '#D59E34'; ?>
                    
                    <div class="tab-wrapper" id="tab_<?=$block['tab_anchor']?>" >
                        <div style="background-color: <?=$block['background_color']?>">
                            <div class="text-content">
                                <div>
                                    <?=$block['title']?>
                                    <?=$block['content']?>
                                </div>
                                <div class="bottom-tab-content">
                                    <div class="bottom-tab-content__people">
                                        <?php if (isset($block['people_image']['url'])): ?>
                                            <img src="<?=$block['people_image']['url']?>" alt="<?=$block['people_name']?>">
                                        <?php endif ?>
                                        <div>
                                            <?php if ($block['people_name']): ?>
                                                <h4><?=$block['people_name']?></h4>
                                            <?php endif ?>
                                            <?php if ($block['people_job_role']): ?>
                                                <p><?=$block['people_job_role']?></p>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div>
                                        <?php if (isset($block['button']['url'])): ?>
                                            <a class="btn" href="<?=$block['button']['url']?>"><?=$block['button']['title']?></a>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                            <div class="image-content">
                                <?php if ($block['image_right']): ?>
                                    <img src="<?=$block['image_right']['url']?>" alt="<?=$block['image_right']['alt']?>">
                                <?php endif ?>
                                <?php if ($block['image_right_bottom_gradient']): ?>
                                    <img class="img-bottom" src="<?=$block['image_right_bottom_gradient']['url']?>" alt="bg image2">
                                <?php endif ?>
                                <div class="bordered" style="border-color: <?=$border_color?>;"></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>

<?php endif ?>

<?php endif; ?>