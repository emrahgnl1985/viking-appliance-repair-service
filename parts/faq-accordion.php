<?php
/**
 * FAQ Accordion Partial — OBSIDIAN Design System
 * @var array $args ['faqs' => [['question' => string, 'answer' => string], ...], 'heading' => string]
 */
$faqs    = $args['faqs']    ?? [];
$heading = $args['heading'] ?? 'Frequently Asked Questions';
if ( empty($faqs) ) return;
?>

<section class="faq-section" aria-labelledby="faq-heading">
  <div class="container">

    <div class="faq-section__head">
      <span class="faq-section__eyebrow">FAQ</span>
      <h2 class="faq-section__title" id="faq-heading"><?php echo esc_html($heading); ?></h2>
      <p class="faq-section__sub">Common questions about Viking appliance repair answered by our certified technicians.</p>
    </div>

    <ul class="faq-list" role="list">
      <?php foreach ($faqs as $i => $faq): ?>
      <li class="faq-item" role="listitem">
        <button
          class="faq-question"
          aria-expanded="false"
          aria-controls="faq-answer-<?php echo esc_attr($i); ?>"
          id="faq-q-<?php echo esc_attr($i); ?>"
        >
          <span class="faq-question__text"><?php echo esc_html($faq['question']); ?></span>
          <span class="faq-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="6 9 12 15 18 9"/>
            </svg>
          </span>
        </button>
        <div
          class="faq-answer"
          id="faq-answer-<?php echo esc_attr($i); ?>"
          role="region"
          aria-labelledby="faq-q-<?php echo esc_attr($i); ?>"
        >
          <div class="faq-answer__inner">
            <?php echo wp_kses_post( wpautop($faq['answer']) ); ?>
          </div>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>

  </div>
</section>
