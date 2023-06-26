<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>My Author Website</title>
  <link rel="stylesheet" href="CSS/stylespage.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    var $j = jQuery.noConflict();
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
  <script> //Оценка языка пользователя и сохранение его в кукис//
  jQuery(document).ready(function() {
    var availableLanguages = ['ru', 'en', 'es'];
    var defaultLanguage = 'en';
    var languageCookieName = 'preferredLanguage';

    function getPreferredLanguage() {
      var userLanguage = navigator.language || navigator.userLanguage;
      var preferredLanguage = userLanguage.substr(0, 2);
      if (availableLanguages.indexOf(preferredLanguage) !== -1) {
        return preferredLanguage;
      }
      return defaultLanguage;
    }

    function setLanguage(language) {
      jQuery('html').attr('lang', language);
      // Здесь можно добавить код для обновления переводов на странице,
      // чтобы соответствовать выбранному языку.
    }

    function savePreferredLanguage(language) {
      document.cookie = languageCookieName + '=' + language + '; path=/';
    }

    function getCookie(name) {
      var matches = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + '=([^;]*)'));
      return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    var preferredLanguage = getPreferredLanguage();
    setLanguage(preferredLanguage);
    savePreferredLanguage(preferredLanguage);

    // Если язык не выбран ранее, используем значение по умолчанию.
    var storedLanguage = getCookie(languageCookieName);
    if (storedLanguage && availableLanguages.indexOf(storedLanguage) !== -1) {
      setLanguage(storedLanguage);
    }
  });
</script>

</head>

<body>
  <header>
    <div class="logo-text">
      <span class="logo-text__text"></span>
    </div>
    <div class="language-menu">
      <a href="#" class="language-option" data-language="en">
        <span class="language-name language-name--large">English</span>
      </a>
      <a href="#" class="language-option" data-language="ru">
        <span class="language-name language-name--large">Русский</span>
      </a>
      <a href="#" class="language-option" data-language="es">
        <span class="language-name language-name--large">Español</span>
      </a>
    </div>
    <script>
      jQuery(function () {
        var words = ["свобода", "freedom", "თავისუფლება", "wolność", "ազատություն", "freiheit", "자유", "libertad", "自由", "स्वतंत्रता", "حرية", "libert", "自由", "liberdade", "özgürlük", "libertà", "воля", "will", "ნება", "wola", "կամավորում", "Wille", "의지", "voluntad", "意志", "इच्छा", "إرادة", "volonté", "意志", "vontade", "irade", "volontà", "irade", "правда", "truth", "ჭეშმარიტება", "істина", "prawda", "ճշմարիտություն", "Wahrheit", "진실", "verdad", "真相", "सच्चाई", "الحقيقة", "vérité", "真実", "verdade", "verità", "gerçek", "verità"]
        var typed = new Typed(".logo-text__text", {
          strings: words,
          typeSpeed: 50,
          backSpeed: 50,
          loop: true,
          showCursor: false
        });
      });
    </script>
    <script> //Смена языков//
      // Загружаем и применяем переводы на страницу
      function loadTranslations(lang) {
        var xhr = new XMLHttpRequest();
        var url = 'assets/' + lang + '.json';

        xhr.open('GET', url, true);
        xhr.send();

        xhr.onreadystatechange = function () {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              var translations = JSON.parse(xhr.responseText);
              applyTranslations(translations);
            } else {
              console.error('Failed to load translations: ' + xhr.status);
            }
          }
        };
      }

      // Применяем переводы к текстовым элементам на странице
      function applyTranslations(translations) {
        var elements = document.querySelectorAll('[data-translate]');
        elements.forEach(function (element) {
          var translationKey = element.getAttribute('data-translate');
          if (translations.hasOwnProperty(translationKey)) {
            element.textContent = translations[translationKey];
          }
        });
      }

      // Обработчик клика на языковую опцию
      function languageOptionClick(event) {
        event.preventDefault();

        var languageOption = event.currentTarget;
        var selectedLanguage = languageOption.getAttribute('data-language');

        // Загрузка и применение переводов
        loadTranslations(selectedLanguage);
      }

      // Находим все языковые опции и назначаем обработчик клика
      var languageOptions = document.querySelectorAll('.language-option');
      languageOptions.forEach(function (option) {
        option.addEventListener('click', languageOptionClick);
      });

    </script>
  </header>
  <div class="content-block">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="content-image">
            <img src="images/image.jpg" alt="Content Image">
          </div>
        </div>
        <div class="col">
          <div class="content-info">
            <h1 class="content-title">Заголовок контента</h1>
            <div class="content-description">
              <p>Аннотация к контенту. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio.
                Praesent libero. Sed cursus ante dapibus diam. Sed nisi.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="viewer">
    <!-- плеер -->
    <div class="audio-player">
      <audio controls>
        <source src="music/track1.mp3" type="audio/mpeg">
        <source src="audio/track1.ogg" type="audio/ogg">
      </audio>
      <div>

        <!-- pdf viewer -->
        <div>
          <button id="pdf-button-open" data-translate="open_pdf">Открыть PDF</button>
          <div id="pdf-container" style="display: none;">
            <div class="canvas-container">
              <canvas id="pdf-viewer"></canvas>
            </div>
            <div class="pdf-overlay">
              <button id="close" data-translate="close_pdf">Закрыть PDF</button>
              <button id="prev" data-translate="previous_page">Предыдущая страница</button>
              <button id="next" data-translate="next_page">Следующая страница</button>
              <button id="fullscreen" data-translate="fullscreen_mode">Полноэкранный режим</button>
            </div>
          </div>
        </div>

        <!-- JavaScript -->
        <script src="pdfjs/build/pdf.js"></script>
        <script>
          const pdfButton = document.getElementById("pdf-button-open");
          const pdfCanvas = document.getElementById("pdf-viewer");
          const pdfContainer = document.getElementById("pdf-container");
          const fullscreenButton = document.getElementById("fullscreen");
          const pdfUrl = "books/document.pdf";
          let pdfDoc = null;
          let currentPage = null;
          let pageNum = 1;

          const workerUrl = 'pdfjs/build/pdf.worker.js';
          pdfjsLib.GlobalWorkerOptions.workerSrc = workerUrl;


          const showPdf = async () => {
            try {
              const loadingTask = pdfjsLib.getDocument(pdfUrl);
              pdfDoc = await loadingTask.promise;

              currentPage = await pdfDoc.getPage(pageNum);

              const viewport = currentPage.getViewport({ scale: 1.0 });
              pdfCanvas.width = viewport.width;
              pdfCanvas.height = viewport.height;
              const ctx = pdfCanvas.getContext("2d");
              const renderContext = {
                canvasContext: ctx,
                viewport: viewport,
              };
              await currentPage.render(renderContext);

              // Show the canvas and hide the button
              pdfContainer.style.display = "block";
              pdfButton.style.display = "none";
            } catch (err) {
              console.error(err);
            }
          };

          const hidePdf = () => {
            pdfContainer.style.display = "none";
            pdfButton.style.display = "inline";
          };

          const showPage = async (pageNum) => {
            if (!currentPage) return;
            currentPage = await pdfDoc.getPage(pageNum);

            const viewport = currentPage.getViewport({ scale: 1.0 });
            pdfCanvas.width = viewport.width;
            pdfCanvas.height = viewport.height;
            const ctx = pdfCanvas.getContext("2d");
            const renderContext = {
              canvasContext: ctx,
              viewport: viewport,
            };
            await currentPage.render(renderContext);
          };

          const closeButton = document.getElementById('close');
          closeButton.addEventListener('click', hidePdf);

          // Определение мобильного устройства
          function isMobileDevice() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
          }
          var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

          // Применение стилей для мобильных устройств
          if (isMobile) {
            var pdfViewer = document.getElementById('pdf-viewer');
            var pdfOverlay = document.querySelector('.pdf-overlay');

            pdfViewer.style.marginTop = '7vh';
            pdfViewer.style.transform = 'scale(1)';
            pdfOverlay.style.marginTop = '4vh';
          }
          // Проверяем, является ли устройство мобильным, и скрываем кнопку fullscreenButton при необходимости
          if (isMobileDevice()) {
            fullscreenButton.style.display = 'none';
          }

          pdfCanvas.addEventListener("click", () => {
            if (isMobileDevice()) {
              // Открываем PDF-файл в полноэкранном режиме на мобильных устройствах
              pdfContainer.style.display = "block";

              if (pdfContainer.requestFullscreen) {
                pdfContainer.requestFullscreen().catch(handleFullscreenError);
              } else if (pdfContainer.mozRequestFullScreen) { // Firefox
                pdfContainer.mozRequestFullScreen().catch(handleFullscreenError);
              } else if (pdfContainer.webkitRequestFullscreen) { // Chrome, Safari and Opera
                pdfContainer.webkitRequestFullscreen().catch(handleFullscreenError);
              } else if (pdfContainer.msRequestFullscreen) { // IE/Edge
                pdfContainer.msRequestFullscreen().catch(handleFullscreenError);
              }

              // Добавляем отступ сверху канвасу
              var canvas = document.getElementById('pdf-viewer');
              if (canvas) {
                canvas.style.marginTop = '7vh';
                canvas.style.transform = 'scale(1)';
              }

              // Изменяем отступ верхнего оверлея
              var overlay = document.querySelector('.pdf-overlay');
              if (overlay) {
                overlay.style.marginTop = '4vh';
              }

              // Скрыть кнопку "Полноэкранный режим"
              fullscreenButton.style.display = 'none';
            } else {
              // Открываем следующую страницу PDF-файла на других устройствах
              if (pdfDoc && pageNum < pdfDoc.numPages) {
                pageNum++;
                showPage(pageNum);
              } else {
                hidePdf();
              }
            }
          });


          const prevButton = document.getElementById("prev");
          const nextButton = document.getElementById("next");

          prevButton.addEventListener("click", () => {
            if (pdfDoc && pageNum > 1) {
              pageNum--;
              showPage(pageNum);
            }
          });

          nextButton.addEventListener("click", () => {
            if (pdfDoc && pageNum < pdfDoc.numPages) {
              pageNum++;
              showPage(pageNum);
            }
          });

          pdfButton.addEventListener("click", showPdf);

          // Полноэкранный режим
          // Функция для обработки ошибок при запросе на полноэкранный режим
          function handleFullscreenError(error) {
            console.log('Ошибка при запросе на полноэкранный режим:', error);
          }

          // Обработчик кнопки "Полноэкранный режим"
          fullscreenButton.addEventListener('click', function () {
            pdfContainer.style.display = 'block';

            if (pdfContainer.requestFullscreen) {
              pdfContainer.requestFullscreen().catch(handleFullscreenError);
            } else if (pdfContainer.mozRequestFullScreen) { // Firefox
              pdfContainer.mozRequestFullScreen().catch(handleFullscreenError);
            } else if (pdfContainer.webkitRequestFullscreen) { // Chrome, Safari and Opera
              pdfContainer.webkitRequestFullscreen().catch(handleFullscreenError);
            } else if (pdfContainer.msRequestFullscreen) { // IE/Edge
              pdfContainer.msRequestFullscreen().catch(handleFullscreenError);
            }

            // Добавляем отступ сверху канвасу
            var canvas = document.getElementById('pdf-viewer');
            if (canvas) {
              canvas.style.marginTop = '7vh';
              canvas.style.transform = 'scale(1.1)';
            }

            // Изменяем отступ верхнего оверлея
            var overlay = document.querySelector('.pdf-overlay');
            if (overlay) {
              overlay.style.marginTop = '4vh';
            }

            // Скрыть кнопку "Полноэкранный режим"
            fullscreenButton.style.display = 'none';
          });

          // Обработчик кнопки "Закрыть PDF"
          function resetPdfSize() {
            var pdfViewer = document.getElementById('pdf-viewer');
            var pdfContainer = document.getElementById('pdf-container');

            pdfViewer.style.transform = 'scale(1)'; // Установить масштаб на 1 (без масштабирования)
            pdfViewer.style.marginTop = '0'; // Вернуть исходный отступ

            // Вернуть исходный отступ верхнего оверлея
            var overlay = document.querySelector('.pdf-overlay');
            if (overlay) {
              overlay.style.marginTop = '0';
            }
          }

          closeButton.addEventListener('click', function () {
            if (document.exitFullscreen) {
              document.exitFullscreen().catch(handleFullscreenError);
            } else if (document.mozCancelFullScreen) { // Firefox
              document.mozCancelFullScreen().catch(handleFullscreenError);
            } else if (document.webkitExitFullscreen) { // Chrome, Safari and Opera
              document.webkitExitFullscreen().catch(handleFullscreenError);
            } else if (document.msExitFullscreen) { // IE/Edge
              document.msExitFullscreen().catch(handleFullscreenError);
            }

            pdfContainer.style.display = 'none';

            // Сбрасываем отступ сверху канвасу
            var canvas = document.getElementById('pdf-viewer');
            if (canvas) {
              canvas.style.marginTop = '0';
              canvas.style.transform = 'scale(1)';
            }

            resetPdfSize(); // Возврат PDF документа в исходный размер

            // Показать кнопку "Полноэкранный режим"
            fullscreenButton.style.display = 'block';
          });

          // Обработчик события прокрутки на мобильных устройствах
          function handleMobileScroll(event) {
            var container = document.getElementById('pdf-container');
            var touch = event.touches[0] || event.changedTouches[0];
            var startY = touch.clientY;

            function handleTouchMove(event) {
              event.preventDefault();

              var touch = event.touches[0] || event.changedTouches[0];
              var deltaY = touch.clientY - startY;

              container.scrollTop -= deltaY;
              startY = touch.clientY;
            }

            function handleTouchEnd() {
              container.removeEventListener('touchmove', handleTouchMove);
              container.removeEventListener('touchend', handleTouchEnd);
            }

            container.addEventListener('touchmove', handleTouchMove);
            container.addEventListener('touchend', handleTouchEnd);

            // Блокировка прокрутки родительского контейнера
            container.style.overflow = 'hidden';
          }

          // Добавляем обработчик события прокрутки на мобильных устройствах
          if (isMobileDevice()) {
            var container = document.getElementById('pdf-container');
            container.addEventListener('touchstart', function (event) {
              // Проверяем, работает ли прокрутка на мобильном устройстве
              if (container.scrollHeight > container.offsetHeight) {
                handleMobileScroll(event);
              }
            });
          }

          // Обработчик события прокрутки колеса мыши
          function handleWheelScroll(event) {
            var container = document.getElementById('pdf-container');
            container.scrollTop += event.deltaY;
          }

          // Добавляем обработчик события прокрутки колеса мыши
          var container = document.getElementById('pdf-container');
          container.addEventListener('wheel', handleWheelScroll);
        </script>

      </div>
</body>