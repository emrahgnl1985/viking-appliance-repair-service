<?php
/**
 * FAQ Accordion Partial
 * @var array $args ['faqs' => [['question' => string, 'answer' => string], ...]]
 */
$faqs    = $args['faqs'] ?? [];
$heading = $args['heading'] ?? 'Frequently Asked Questions';
if (empty($faqs)) return;
?>

<section class="faq-section" id="faq" aria-labelledby="faq-heading" itemscope itemtype="https://schema.org/FAQPage">
    <div class="container">

        <div class="faq-section__head">
            <span class="faq-section__eyebrow">FAQ</span>
            <h2 class="faq-section__title" id="faq-heading"><?php echo esc_html($heading); ?></h2>
            <p class="faq-section__sub">Everything you need to know before booking your repair.</p>
        </div>

        <div class="faq-list" role="list">
            <?php foreach ($faqs as $i => $faq):
                $faq_id = 'faq-' . $i;
                $ans_id = 'faq-ans-' . $i;
                $num    = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
            ?>
            <div class="faq-item" role="listitem" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <button
                    class="faq-question"
                    id="<?php echo esc_attr($faq_id); ?>"
                    aria-expanded="false"
                    aria-controls="<?php echo esc_attr($ans_id); ?>"
                    itemprop="name"
                >
                    <span class="faq-question__num" aria-hidden="true"><?php echo $num; ?></span>
                    <span class="faq-question__text"><?php echo esc_html($faq['question'] ?? $faq['q'] ?? ''); ?></span>
                    <span class="faq-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
                    </span>
                </button>
                <div
                    class="faq-answer"
                    id="<?php echo esc_attr($ans_id); ?>"
                    role="region"
                    aria-labelledby="<?php echo esc_attr($faq_id); ?>"
                    itemscope
                    itemprop="acceptedAnswer"
                    itemtype="https://schema.org/Answer"
                >
                    <div class="faq-answer__inner" itemprop="text">
                        <?php echo wp_kses_post($faq['answer'] ?? $faq['a'] ?? ''); ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
