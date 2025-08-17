<script>
 document.addEventListener('DOMContentLoaded', function() {
    // Находим все элементы с классом password-checkbox
    const checkboxes = document.querySelectorAll('.password-checkbox');

    // Для каждого checkbox навешиваем обработчик события click
    checkboxes.forEach(function(checkbox) {
      checkbox.addEventListener('click', function() {
        // Получаем id поля пароля из атрибута data-password-field
        const passwordFieldId = this.getAttribute('data-password-field');
        const passwordField = document.getElementById(passwordFieldId);

        // Меняем тип поля в зависимости от состояния checkbox
        if (this.checked) {
          passwordField.type = 'text';
        } else {
          passwordField.type = 'password';
        }
      });
    });
  });
</script>

