$(document).ready(function() {
    $('.language-selector__item').click(function() {
      var lang = $(this).data('lang');
      // Здесь можно выполнить нужные действия, связанные с изменением языка и загрузкой контента, например:
      // 1. Изменение языка интерфейса
      // 2. Загрузка соответствующего контента
      // 3. Обновление текста и других элементов на странице
      console.log('Выбран язык: ' + lang);
    });
  });

  
  $(document).ready(function() {
    $('.cell-container').hover(
      function() {
        $(this).find('.cell').css({
          'transform': 'scale(1.1)',
          'box-shadow': '0 0 10px rgba(255, 255, 255, 0.5)'
        });
      },
      function() {
        $(this).find('.cell').css({
          'transform': 'scale(1)',
          'box-shadow': 'none'
        });
      }
    );
  });


  
  