<div id="slider">
    <button id="slider-left-button"><i class="fas fa-chevron-circle-left"></i></button>
    <img src="templates/images/slider/1.png" alt="Картинка слайдера" draggable="false">
    <button id="slider-right-button"><i class="fas fa-chevron-circle-right"></i></button>
    <div>
        <span data-img-name="1.png"><i class="fas fa-dot-circle"></i></span>
        <span data-img-name="2.png"><i class="far fa-dot-circle"></i></span>
        <span data-img-name="3.png"><i class="far fa-dot-circle"></i></span>
    </div>
</div>
<div id="articles-wrapper">
    <?php
        require 'pagination/index.php';
    ?>
</div>
<div class="pagination">
    <?= $Pagination->getHTML() ?>
</div>