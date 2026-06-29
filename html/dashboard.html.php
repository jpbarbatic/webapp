<div class="bg-light p-5 rounded">
    <h1>Noticias</h1>
    <div id="noticias">
    <?php foreach($noticias->channel->item as $noticia): ?>
        <h3><?php echo $noticia->title?></h3>
        <p><?php echo  $noticia->children('content', true);?></p>
    <?php endforeach; ?>
    </div>
</div>