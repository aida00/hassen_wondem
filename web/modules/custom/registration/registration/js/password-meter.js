(function (Drupal) {
  Drupal.behaviors.passwordMeter = {
    attach: function (context) {
      const pw = context.querySelector('input[name="password"]');
      const bar = context.querySelector('#pw-meter-bar');
      const label = context.querySelector('#pw-meter-label');
      if (!pw || !bar || !label) return;

      function score(s) {
        let pts = 0;
        if (!s) return 0;
        if (s.length >= 8) pts++;
        if (/[a-z]/.test(s)) pts++;
        if (/[A-Z]/.test(s)) pts++;
        if (/\d/.test(s)) pts++;
        if (/[^A-Za-z0-9]/.test(s)) pts++;
        return Math.min(pts, 5);
      }

      function update() {
        const val = pw.value || '';
        const sc = score(val);
        const pct = (sc / 5) * 100;
        bar.style.width = pct + '%';
        bar.dataset.level = sc;
        const labels = ['Very weak','Weak','Okay','Good','Strong','Very strong'];
        label.textContent = labels[sc] || labels[0];
      }

      pw.addEventListener('input', update);
      update();
    }
  };
})(Drupal);
