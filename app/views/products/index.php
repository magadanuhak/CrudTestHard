<div class="page-title">Products</div>
<div class="products-list ">
    <?php foreach ($data as $product) { ?>
    <div class="card">
        <div class="card-body">
            <h5 class="product-title"><?=$product['name']?></h5>
            <div class="price-slot">
                <span class="price"> <?=$product['price'] ?> $</span>
            </div>

            <a href="/cart/add/<?=$product['id'] ?>" title="Add to cart" class="btn add-to-cart btn-success" >+</a>
        </div>
    </div>
    <?php } ?>
</div>
