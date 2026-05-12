/**
 * Viking Appliance Repair Service — Main JavaScript
 * Handles: sticky header, mobile menu, FAQ accordion, smooth scroll,
 *          form AJAX submission, sticky call button
 */
(function () {
  'use strict';

  /* ============================================================
     STICKY HEADER
     ============================================================ */
  const header = document.querySelector('.site-header');
  if (header) {
    const onScroll = () => {
      header.classList.toggle('scrolled', window.scrollY > 60);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ============================================================
     MOBILE MENU
     ============================================================ */
  const menuToggle   = document.querySelector('.mobile-menu-toggle');
  const mobileMenu   = document.querySelector('.mobile-menu');
  const menuOverlay  = document.querySelector('.mobile-menu__overlay');
  const menuClose    = document.querySelector('.mobile-menu__close');

  function openMenu() {
    mobileMenu  && mobileMenu.classList.add('open');
    menuOverlay && menuOverlay.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeMenu() {
    mobileMenu  && mobileMenu.classList.remove('open');
    menuOverlay && menuOverlay.classList.remove('open');
    document.body.style.overflow = '';
  }

  menuToggle  && menuToggle.addEventListener('click', openMenu);
  menuClose   && menuClose.addEventListener('click', closeMenu);
  menuOverlay && menuOverlay.addEventListener('click', closeMenu);

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeMenu();
  });

  /* ============================================================
     FAQ ACCORDION (schema-compatible)
     ============================================================ */
  const faqItems = document.querySelectorAll('.faq-item');

  faqItems.forEach((item) => {
    const question = item.querySelector('.faq-question');
    const answer   = item.querySelector('.faq-answer');

    if (!question || !answer) return;

    question.addEventListener('click', () => {
      const isOpen = item.classList.contains('open');

      // Close all others
      faqItems.forEach((other) => {
        if (other !== item) {
          other.classList.remove('open');
          const otherAnswer = other.querySelector('.faq-answer');
          if (otherAnswer) { otherAnswer.style.maxHeight = null; otherAnswer.hidden = true; }
          const otherQ = other.querySelector('.faq-question');
          if (otherQ) otherQ.setAttribute('aria-expanded', 'false');
        }
      });

      // Toggle current
      if (isOpen) {
        item.classList.remove('open');
        answer.style.maxHeight = null;
        answer.hidden = true;
        question.setAttribute('aria-expanded', 'false');
      } else {
        item.classList.add('open');
        answer.hidden = false;
        answer.style.maxHeight = answer.scrollHeight + 'px';
        question.setAttribute('aria-expanded', 'true');

        // Smooth scroll to question if needed
        const rect = question.getBoundingClientRect();
        if (rect.top < 80) {
          window.scrollTo({ top: window.scrollY + rect.top - 100, behavior: 'smooth' });
        }
      }
    });

    // Keyboard support
    question.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        question.click();
      }
    });

    question.setAttribute('aria-expanded', 'false');
    question.setAttribute('role', 'button');
    question.setAttribute('tabindex', '0');
    answer.hidden = true;
  });

  /* ============================================================
     APPOINTMENT FORM — AJAX SUBMISSION
     ============================================================ */
  const apptForms = document.querySelectorAll('.appt-form__form');

  apptForms.forEach((form) => {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const submitBtn = form.querySelector('[type="submit"]');
      const successEl = form.closest('.appt-form')?.querySelector('.form-success');
      const originalText = submitBtn ? submitBtn.innerHTML : '';

      if (submitBtn) {
        submitBtn.innerHTML = 'Sending…';
        submitBtn.disabled  = true;
      }

      const data = new FormData(form);
      data.append('action', 'ar_submit_appointment');
      data.append('nonce', window.AR_VARS?.nonce || '');

      try {
        const resp = await fetch(window.AR_VARS?.ajax_url || '/wp-admin/admin-ajax.php', {
          method: 'POST',
          body: data,
          credentials: 'same-origin',
        });

        const json = await resp.json();

        if (json.success) {
          form.style.display = 'none';
          if (successEl) successEl.style.display = 'block';

          // Push to dataLayer if GTM present
          if (window.dataLayer) {
            window.dataLayer.push({ event: 'appointment_submitted' });
          }
        } else {
          throw new Error(json.data || 'Submission error');
        }
      } catch (err) {
        console.error('Form error:', err);
        if (submitBtn) {
          submitBtn.innerHTML = '⚠ Error — please call us directly';
          submitBtn.disabled  = false;
          submitBtn.style.backgroundColor = 'var(--color-danger)';
        }
      }
    });
  });

  /* ============================================================
     SMOOTH SCROLL FOR ANCHOR LINKS
     ============================================================ */
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener('click', (e) => {
      const target = document.querySelector(anchor.getAttribute('href'));
      if (!target) return;
      e.preventDefault();
      const offset = 88; // header height
      const top = target.getBoundingClientRect().top + window.scrollY - offset;
      window.scrollTo({ top, behavior: 'smooth' });
    });
  });

  /* ============================================================
     LAZYLOAD images (native + fallback)
     ============================================================ */
  if ('loading' in HTMLImageElement.prototype) {
    document.querySelectorAll('img[data-src]').forEach((img) => {
      img.src = img.dataset.src;
    });
  } else {
    // Intersection Observer fallback
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.dataset.src;
          io.unobserve(img);
        }
      });
    });
    document.querySelectorAll('img[data-src]').forEach((img) => io.observe(img));
  }

  /* ============================================================
     PHONE NUMBER CLICK TRACKING
     ============================================================ */
  document.querySelectorAll('a[href^="tel:"]').forEach((link) => {
    link.addEventListener('click', () => {
      if (window.gtag) {
        gtag('event', 'phone_click', { event_category: 'Contact', event_label: link.href });
      }
      if (window.dataLayer) {
        window.dataLayer.push({ event: 'phone_click', phone: link.href });
      }
    });
  });

  /* ============================================================
     ANIMATE ON SCROLL — lightweight reveal
     ============================================================ */
  const revealEls = document.querySelectorAll('.reveal');

  if (revealEls.length) {
    const revealObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('revealed');
            revealObserver.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12 }
    );
    revealEls.forEach((el) => revealObserver.observe(el));
  }

})();

