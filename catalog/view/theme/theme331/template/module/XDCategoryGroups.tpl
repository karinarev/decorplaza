<div class=" categories">
    <?php foreach($categories as $category) { ?>
    <div class="item">
        <div class="image">
            <img src="<?php echo $category['image']; ?>" alt="<?php echo $category['name']; ?>" title="<?php echo $category['name']; ?>" />
            <div class="image-background"></div>
        </div>
        <div class="caption">
            <div class="catalog-name"><?php echo $category['name']; ?></div>
            <div class="description"><?php echo $category['description']; ?></div>
        </div>
        <div class="button-area">
            <a class="btn btn-more" href="<?php echo $category['parent_url']; ?>"><span>Подробнее</span></a>
        </div>
    </div>
    <?php } ?>
</div>

