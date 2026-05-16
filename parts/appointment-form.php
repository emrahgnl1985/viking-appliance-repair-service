<?php
/**
 * Appointment Form Partial — OBSIDIAN Design System
 * Split layout: editorial intro left + clean form right
 * @var array $args ['context' => string, 'heading' => string]
 */
$heading    = $args['heading'] ?? 'Book Your Viking Appliance Repair Today';
$phone      = ar_get_phone();
$phone_link = ar_phone_link();
?>

<section class="appt-section" id="appointment" aria-labelledby="appt-h2">
  <div class="container">
    <div class="appt-layout">

      <!-- Left: editorial intro -->
      <div class="appt-intro">
        <span class="appt-intro__label">Book a Repair</span>
        <h2 class="appt-intro__title" id="appt-h2">
          <?php echo esc_html($heading); ?>
        </h2>
        <p class="appt-intro__body">
          Schedule online or call us directly. We offer same-day and next-day Viking appliance repair appointments across all six service areas, Monday through Saturday.
        </p>
        <ul class="appt-trust" aria-label="Booking guarantees">
          <li>Genuine Viking OEM parts on every repair</li>
          <li>Same-day and next-day availability</li>
          <li>Upfront pricing — no hidden fees</li>
          <li>30-day parts &amp; labor warranty</li>
          <li>Certified, background-checked technicians</li>
        </ul>

        <div style="margin-top:32px;">
          <a href="<?php echo esc_url($phone_link); ?>"
             style="font-family:'Manrope',sans-serif;font-size:1.5rem;font-weight:700;color:#C01C28;text-decoration:none;letter-spacing:-0.01em;display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:rgba(192,28,40,0.06);border:1.5px solid rgba(192,28,40,0.25);border-radius:2px;transition:background 0.12s ease;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 12a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 9a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
            <?php echo esc_html($phone); ?>
          </a>
          <div style="font-family:'Manrope',sans-serif;font-size:11px;color:#717170;letter-spacing:0.1em;text-transform:uppercase;font-weight:700;margin-top:8px;padding-left:4px;">
            Mon – Sat &nbsp;·&nbsp; 08:00 – 18:00
          </div>
        </div>
      </div>

      <!-- Right: iframe form -->
      <div class="appt-form" style="padding:0;overflow:hidden;">
        <iframe
          id="appointmentIframe"
          src="https://webform.proleadservice.com/?ref_id=478"
          width="100%"
          height="600"
          frameborder="0"
          scrolling="no"
          title="Book your Viking appliance repair appointment"
          loading="lazy"
          style="display:block;width:100%;min-height:600px;border:none;"
        ></iframe>
        <p class="form-privacy" style="padding:12px 16px;border-top:1px solid var(--color-rule);margin:0;">
          <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
          Your information is secure. We never share or sell your data.
        </p>
      </div><!-- .appt-form -->
    </div><!-- .appt-layout -->
  </div><!-- .container -->
</section>

<script>
(function () {
  var iframe = document.getElementById('appointmentIframe');
  if (!iframe) return;
  window.addEventListener('message', function (e) {
    try {
      var origin = new URL(iframe.src).origin;
      if (e.origin !== origin) return;
    } catch (_) { return; }
    if (e.data && e.data.height) {
      iframe.style.height = parseInt(e.data.height, 10) + 'px';
    }
  });
  iframe.addEventListener('load', function () {
    try {
      var doc = iframe.contentDocument || iframe.contentWindow.document;
      var h = doc.documentElement.scrollHeight || doc.body.scrollHeight;
      if (h > 100) iframe.style.height = h + 'px';
    } catch (_) {}
  });
}());
</script>
