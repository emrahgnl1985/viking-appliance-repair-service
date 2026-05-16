<?php
/**
 * Trust Bar Partial — OBSIDIAN Design System
 * Clean horizontal strip with minimal icons
 */
$items = [
    ['label' => 'Genuine Viking OEM Parts',       'note' => 'No aftermarket substitutes'],
    ['label' => 'Same-Day Service Available',     'note' => 'Mon – Sat in most areas'],
    ['label' => '30-Day Parts & Labor Warranty', 'note' => 'Written documentation same day'],
    ['label' => 'Viking-Certified Technicians',  'note' => 'Background-checked & insured'],
];
?>
<div class="trust-bar" role="region" aria-label="Why choose us">
  <div class="container">
    <div class="trust-bar__inner" role="list">
      <?php foreach ($items as $i => $item):
        if ($i > 0): ?><div class="trust-bar__divider" aria-hidden="true"></div><?php endif; ?>
      <div class="trust-bar__item" role="listitem">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color:#C01C28;flex-shrink:0;"><polyline points="20 6 9 17 4 12"/></svg>
        <span>
          <strong style="font-weight:600;color:#1A1A1A;"><?php echo esc_html($item['label']); ?></strong>
          <span style="display:block;font-size:12px;color:#A8A8A5;"><?php echo esc_html($item['note']); ?></span>
        </span>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
