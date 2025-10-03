(function ($, Drupal) {
  Drupal.behaviors.phoneMaskIntl = {
    attach: function (context) {
      const $input = $('input[name="phone"]', context).once('phoneMaskIntl');
      if (!$input.length) return;

      $input.on('input', function () {
        let val = $(this).val();

        // Keep one leading + if it was typed at the beginning.
        const hasPlus = val.trim().startsWith('+');
        // Remove all non-digits; we'll re-add a leading + if needed.
        let digits = val.replace(/\D/g, '');

        // Limit to 15 digits (E.164 max)
        if (digits.length > 15) {
          digits = digits.substring(0, 15);
        }

        // Rebuild value with optional + and light grouping for readability.
        // Group into blocks of 3 except the last block may be shorter.
        // Example: +251 911 234 567 or +44 7911 123 456
        let grouped = '';
        for (let i = 0; i < digits.length; i += 3) {
          if (grouped.length) grouped += ' ';
          grouped += digits.substring(i, i + 3);
        }

        $(this).val((hasPlus ? '+' : '') + grouped);
      });

      // On blur, collapse spaces to a normalized +digits format for submission.
      $input.on('blur', function () {
        let val = $(this).val().trim();
        const hasPlus = val.startsWith('+');
        let digits = val.replace(/\D/g, '');
        if (digits.length > 15) digits = digits.substring(0, 15);
        $(this).val((hasPlus ? '+' : '') + digits);
      });
    }
  };
})(jQuery, Drupal);
