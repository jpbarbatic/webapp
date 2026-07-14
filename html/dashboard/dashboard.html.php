<div class="bg-light p-3 rounded">
    <!-- Contenedor del widget -->
    <h1>El Tiempo</h1>
    <div id="weather-widget" class="mb-5"></div>
    <h1>Noticias</h1>
    <div id="noticias">
    <?php if(isset($noticias) && $noticias):?>
    <?php foreach($noticias->channel->item as $noticia): ?>
        <h3><?php echo $noticia->title?></h3>
        <p><?php echo  $noticia->children('content', true);?></p>
    <?php endforeach; ?>
    <?php endif; ?>
    </div>
</div>
