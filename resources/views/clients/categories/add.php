<h1>Add chuyên mục</h1>
<form action="<?php echo route('categories.add') ?>" method='POST'>
    <div>
        <input type="text" name="category_name" value="<?php echo $cateName; ?>" placeholder="Tên chuyên mục">
    </div>
    <?php echo csrf_field(); ?>
    <button type="submit">Thêm chuyên mục</button>
</form>