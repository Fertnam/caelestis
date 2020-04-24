<?php
    if (!is_null($data['articles'])) {
        foreach($data['articles'] as $article) {
?>
            <article>
                <div class="article-header">
                    <p><?= $article['title'] ?></p>
                    <p><i class="fas fa-calendar-alt"></i> 11 Июля, 2017</p>
                </div>
                <div class="article-body">
                    <img src="templates/images/slider/1.png" alt=""> 
                    <p><?= $article['content'] ?></p>
                </div>
                <div class="article-footer clearfix">
                    <a href="">Подробнее</a>
                </div>
            </article>
<?php
        }
    } else {
?>
        <p class="error">Статей нет</p>
<?php
    }
?>