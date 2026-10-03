/* COVID-19 Information & Awareness Portal - client-side behaviour (vanilla JS).
   The regexes below mirror includes/validation.php. Keep both in sync. */
(function (root) {
  'use strict';

  const RX = {
    name:     /^[A-Za-z ]{2,50}$/,
    email:    /^[A-Za-z0-9._%+\-]+@[A-Za-z0-9\-]+(\.[A-Za-z0-9\-]+)*\.[A-Za-z]{2,}$/,
    phone:    /^[6-9][0-9]{9}$/,
    password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9\s]).{8,64}$/
  };

  // Each validator returns an error message or '' when valid.
  const V = {
    name: v => !v ? 'Name is required.' : RX.name.test(v) ? '' : 'Name must be 2-50 letters and spaces only.',
    email: v => !v ? 'Email is required.' : (v.length <= 100 && RX.email.test(v)) ? '' : 'Enter a valid email address, for example name@example.com.',
    phone: v => !v ? 'Phone number is required.' : RX.phone.test(v) ? '' : 'Enter a 10-digit Indian mobile number starting with 6, 7, 8 or 9.',
    password: v => !v ? 'Password is required.' : RX.password.test(v) ? '' : 'Password needs 8-64 characters with an uppercase letter, a lowercase letter, a digit and a special character.',
    required: v => v ? '' : 'This field is required.',
    text: (v, min, max) => !v ? 'This field is required.' : v.length < min ? 'Enter at least ' + min + ' characters.' : v.length > max ? 'Enter at most ' + max + ' characters.' : ''
  };

  function strengthScore(pw) {
    let s = 0;
    if (pw.length >= 8) s++;
    if (/[a-z]/.test(pw) && /[A-Z]/.test(pw)) s++;
    if (/[0-9]/.test(pw)) s++;
    if (/[^A-Za-z0-9\s]/.test(pw)) s++;
    if (pw.length >= 12) s++;
    return s; // 0-5
  }

  // Expose for the browser regex test page (tests/regex-tester.html).
  root.PortalValidators = { RX: RX, V: V, strengthScore: strengthScore };
  if (typeof document === 'undefined') return;

  function checkField(input, form) {
    const rule = input.dataset.rule || '';
    const val = input.type === 'password' ? input.value : input.value.trim();
    let msg = '';
    if (rule === 'confirm:password') {
      const pw = form.querySelector('#password').value;
      msg = !val ? 'Please confirm your password.' : val !== pw ? 'Passwords do not match.' : '';
    } else if (rule.indexOf('text:') === 0) {
      const p = rule.split(':'); msg = V.text(val, +p[1], +p[2]);
    } else if (V[rule]) {
      msg = V[rule](val);
    }
    const box = input.closest('.field');
    const out = document.getElementById(input.id + '-error');
    if (out) out.textContent = msg;
    if (box) { box.classList.toggle('has-error', !!msg); box.classList.toggle('is-valid', !msg && !!val); }
    input.setAttribute('aria-invalid', msg ? 'true' : 'false');
    return msg === '';
  }

  document.addEventListener('DOMContentLoaded', function () {
    // Mobile menu
    const toggle = document.querySelector('.nav-toggle'), nav = document.getElementById('site-nav');
    if (toggle && nav) toggle.addEventListener('click', function () {
      const open = nav.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });

    // Dismissible alerts
    document.querySelectorAll('.alert-close').forEach(function (b) {
      b.addEventListener('click', function () { b.closest('.alert').remove(); });
    });

    // Form validation (client side; the server validates again)
    document.querySelectorAll('form[data-validate]').forEach(function (form) {
      const inputs = form.querySelectorAll('[data-rule]');
      inputs.forEach(function (inp) {
        inp.addEventListener('blur', function () { if (inp.value) checkField(inp, form); });
        inp.addEventListener('input', function () {
          if (inp.closest('.field').classList.contains('has-error') || inp.closest('.field').classList.contains('is-valid')) checkField(inp, form);
          if (inp.id === 'password') { const c = form.querySelector('#confirm_password'); if (c && c.value) checkField(c, form); }
        });
      });
      form.addEventListener('submit', function (ev) {
        let firstBad = null;
        inputs.forEach(function (inp) { if (!checkField(inp, form) && !firstBad) firstBad = inp; });
        if (firstBad) { ev.preventDefault(); firstBad.focus(); }
      });
    });

    // Password strength meter
    const pw = document.querySelector('[data-strength]');
    if (pw) {
      const meter = document.getElementById(pw.dataset.strength);
      const bar = meter.querySelector('.strength-bar'), txt = meter.querySelector('.strength-text');
      const labels = ['Very weak', 'Weak', 'Fair', 'Good', 'Strong', 'Very strong'];
      const colors = ['#c0332b', '#c0332b', '#b7791f', '#2f855a', '#1b7f4b', '#14633a'];
      pw.addEventListener('input', function () {
        const s = pw.value ? strengthScore(pw.value) : 0;
        bar.style.setProperty('--w', (pw.value ? Math.max(s, 1) * 20 : 0) + '%');
        bar.style.setProperty('--c', colors[s]);
        txt.textContent = pw.value ? 'Strength: ' + labels[s] : 'Password strength';
      });
    }

    // Character counters
    document.querySelectorAll('[data-counter-for]').forEach(function (c) {
      const t = document.getElementById(c.dataset.counterFor);
      if (!t) return;
      const upd = function () { c.textContent = t.value.length + ' / ' + c.dataset.max; };
      t.addEventListener('input', upd); upd();
    });
  });
})(typeof window !== 'undefined' ? window : globalThis);
