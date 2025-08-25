
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

  up_btn.addEventListener('click', (e)=>{
    change_rate_fetch(e)   
})
down_btn.addEventListener('click', (e)=>{
    change_rate_fetch(e)
 })
   
function change_rate_fetch(e) {
    e.preventDefault();

    let post_id = +e.target.dataset.postId; 
    let action = false;
    if (e.target.id === 'up_btn') action = 1
    else if (e.target.id === 'down_btn') action = -1

    if (post_id && action) {
        fetch('posts', {
            method: 'PATCH',
            body: JSON.stringify({
                "action": action,
                "post_id": post_id
            })
        })
            .then((response) => response.text())
            .then((rate) => {
                rate_p.innerHTML = rate;
            });
    }
}


