<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>My Author Website</title>
    <link rel="stylesheet" href="CSS/stylespage.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      var $j = jQuery.noConflict();
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
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
          <a href="#" class="language-option" data-language="ka">
            <span class="language-name">ქართული</span>
          </a>
          <a href="#" class="language-option" data-language="ja">
            <span class="language-name">日本語</span>
          </a>
        </div>
        <script>
            jQuery(function() {
              var words = ["свобода", "freedom", "თავისუფლება", "wolność", "ազատություն", "freiheit", "자유", "libertad", "自由", "स्वतंत्रता","حرية", "libert", "自由", "liberdade", "özgürlük", "libertà", "воля", "will", "ნება", "wola", "կամավորում", "Wille", "의지", "voluntad", "意志", "इच्छा", "إرادة", "volonté", "意志", "vontade", "irade", "volontà", "irade","правда" ,"truth", "ჭეშმარიტება", "істина", "prawda", "ճշմարիտություն", "Wahrheit", "진실", "verdad", "真相", "सच्चाई", "الحقيقة", "vérité", "真実", "verdade", "verità", "gerçek", "verità"]
              var typed = new Typed(".logo-text__text", {
                strings: words,
                typeSpeed: 50,
                backSpeed: 50,
                loop: true,
                showCursor: false
              });
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
            <p>Аннотация к контенту. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi.</p>
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
    <button id="pdf-button-open">Открыть PDF</button>
    <div id="pdf-container" style="display: none;">
      <canvas id="pdf-viewer"></canvas>
      <div class="pdf-overlay">
      <div>
  <label for="scale">Масштаб:</label>
  <select id="scale"  style="display: none;">
    <option value="auto">Автоматически</option>
    <option value="page-actual">Фактический размер</option>
    <option value="page-fit">По размеру страницы</option>
    <option value="page-width">По ширине страницы</option>
    <option value="0.5">50%</option>
    <option value="0.75">75%</option>
    <option value="1">100%</option>
    <option value="1.25">125%</option>
    <option value="1.5">150%</option>
    <option value="2">200%</option>
  </select>
</div>
        <button id="close">Закрыть PDF</button>
        <button id="prev">Предыдущая страница</button>
        <button id="next">Следующая страница</button>
        <button id="fullscreen">Полноэкранный режим</button>
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

pdfCanvas.addEventListener("click", () => {
  if (pdfDoc && pageNum < pdfDoc.numPages) {
    pageNum++;
    showPage(pageNum);
  } else {
    hidePdf();
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

  fullscreenButton.addEventListener('click', function() {
    pdfContainer.style.display = 'block';

    if (pdfContainer.requestFullscreen) {
      pdfContainer.requestFullscreen();
    } else if (pdfContainer.mozRequestFullScreen) { // Firefox
      pdfContainer.mozRequestFullScreen();
    } else if (pdfContainer.webkitRequestFullscreen) { // Chrome, Safari and Opera
      pdfContainer.webkitRequestFullscreen();
    } else if (pdfContainer.msRequestFullscreen) { // IE/Edge
      pdfContainer.msRequestFullscreen();
    }
  });


  closeButton.addEventListener('click', function() {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.mozCancelFullScreen) { // Firefox
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) { // Chrome, Safari and Opera
      document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) { // IE/Edge
      document.msExitFullscreen();
    }

    pdfContainer.style.display = 'none';
  });

  // Выпадающий список
  var scaleSelect = document.getElementById('scale');
var pdfViewer = document.getElementById('pdf-viewer');

scaleSelect.addEventListener('change', function() {
  var scale = scaleSelect.value;

  if (scale === 'auto') {
    pdfViewer.removeAttribute('style');
  } else {
    pdfViewer.style.width = scale === 'page-width' ? '100%' : 'auto';
    pdfViewer.style.height = 'auto';
    pdfViewer.style.transform = 'scale(' + scale + ')';
  }
});

fullscreenButton.addEventListener('click', function() {
  if (scaleSelect.style.display === 'none') {
    scaleSelect.style.display = 'block';
  } else {
    scaleSelect.style.display = 'none';
  }
});

document.addEventListener('fullscreenchange', function() {
  if (document.fullscreenElement) {
    scaleSelect.style.display = 'block';
    fullscreenButton.style.display = 'none';
  } else {
    scaleSelect.style.display = 'none';
    fullscreenButton.style.display = 'inline';
  }
});
</script>

</div>    
</body>