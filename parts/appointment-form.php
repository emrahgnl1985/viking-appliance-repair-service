<?php
/**
 * Appointment Form Partial
 * @var array $args ['context' => string, 'heading' => string]
 */
$context = $args['context'] ?? '';
$heading = $args['heading'] ?: 'Book Your Samsung Repair Today';
$sub     = 'Samsung specialist available same-day. We\'ll call within 60 minutes to confirm.';
?>

<section class="section section--alt" id="book-appointment" aria-labelledby="form-heading" style="padding: 0 !important;">
    <div class="container">
        <div class="appt-form">

            <div class="appt-form__header">
                <h2 id="form-heading"><?php echo esc_html( $heading ); ?></h2>
                <p class="appt-form__sub"><?php echo esc_html( $sub ); ?></p>

                <ul class="appt-form__trust" aria-label="Service guarantees">
                    <li>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        Free Diagnosis Estimate
                    </li>
                    <li>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        30-Day Warranty
                    </li>
                    <li>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        No Hidden Fees
                    </li>
                    <li>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        Same-Day Service Available
                    </li>
                </ul>
            </div>

            <div class="appt-form__body">

                <div class="appt-form__iframe-wrap">
                    <iframe
                        id="appointmentIframe"
                        src="https://webform.proleadservice.com/?ref_id=478"
                        width="100%"
                        height="600"
                        frameborder="0"
                        scrolling="no"
                        title="Book your Samsung appliance repair appointment"
                        loading="lazy"
                        allow="autoplay"
                    ></iframe>
                </div>

                <p class="appt-form__privacy">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                    Your information is secure. We never share or sell your data.
                </p>

            </div><!-- /.appt-form__body -->

        </div><!-- /.appt-form -->
    </div><!-- /.container -->
</section>

<style>
/* ── Appointment Form Section ───────────────────────────── */
.appt-form {
    max-width: 780px;
    margin-inline: auto;
}

/* Header */
.appt-form__header {
    text-align: center;
    margin-bottom: 2rem;
}

.appt-form__header h2 {
    margin: 0 0 .5rem;
    color: #000;
}

.appt-form__sub {
    color: #000 !important;
    font-size: .9375rem;
    margin: 0 0 1.25rem;
}

/* Trust badges */
.appt-form__trust {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    gap: .5rem 1.5rem;
}

.appt-form__trust li {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: .8125rem;
    color: var(--color-success, #1a7f4b);
}

.appt-form__trust li svg {
    flex-shrink: 0;
    color: var(--color-success, #1a7f4b);
}

/* Body card */
.appt-form__body {
    background: #fff;
    border: 2px solid #d1d5db; /* thicker + darker */
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0,0,0,.08); /* more depth */
}

/* iframe wrapper */
.appt-form__iframe-wrap {
    width: 100%;
    line-height: 0;
    height: 500px;
}

.appt-form__iframe-wrap iframe {
    display: block;
    width: 100%;
    border: none;
    min-height: 600px;
}

/* Privacy note */
.appt-form__privacy {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    margin: 0;
    padding: .875rem 1rem;
    font-size: .8125rem;
    color: var(--color-text-tertiary, #9ca3af);
    border-top: 1px solid var(--color-border, #e5e7eb);
}

.appt-form__privacy svg {
    flex-shrink: 0;
}

/* Mobile */
@media (max-width: 600px) {
    .appt-form__trust {
        gap: .5rem 1rem;
    }
    .appt-form__iframe-wrap iframe {
        min-height: 520px;
    }
}
</style>

<script>
(function () {
    var iframe = document.getElementById('appointmentIframe');
    if (!iframe) return;

    /* 1. postMessage from the form host (preferred — cross-origin safe) */
    window.addEventListener('message', function (e) {
        try {
            var origin = new URL(iframe.src).origin;
            if (e.origin !== origin) return;
        } catch (_) { return; }
        if (e.data && e.data.height) {
            iframe.style.height = parseInt(e.data.height, 10) + 'px';
        }
    });

    /* 2. Fallback: read scrollHeight when same-origin */
    iframe.addEventListener('load', function () {
        try {
            var doc = iframe.contentDocument || iframe.contentWindow.document;
            var h   = doc.documentElement.scrollHeight || doc.body.scrollHeight;
            if (h > 100) iframe.style.height = h + 'px';
        } catch (_) {
            /* Cross-origin — handled by postMessage above */
        }
    });
})();
</script>