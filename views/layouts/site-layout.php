<div class="row clearfix" role="tabpanel">
    <ul class="nav nav-tabs animals-tab" role="tablist">
        <li role="presentation" class="active"><a href="#tab-one" id="tab-to-one" aria-controls="tab-one" role="tab" data-toggle="tab" aria-expanded="true">Companies</a></li>
        <li role="presentation"><a href="#tab-two" id="tab-to-two" aria-controls="tab-two" role="tab" data-toggle="tab">Employers</a></li>
        <li role="presentation"><a href="#tab-three" id="tab-to-three" aria-controls="tab-three" role="tab" data-toggle="tab">Products</a></li>
        <li role="presentation"><a href="#tab-five" id="tab-to-five" aria-controls="tab-five" role="tab" data-toggle="tab">Company products discount</a></li>
        <li role="presentation"><a href="#tab-four" id="tab-to-four" aria-controls="tab-four" role="tab" data-toggle="tab">Orders</a></li>
    </ul>
    <div class="tab-content">
        <div id="tab-one" role="tabpanel" class="tab-pane fade in active" aria-labelledby="tab-to-one">
            <?php
            //----------- Get all saved companies --------------
            require_once ROOT_PATH . '/views/tabs/companies.php';
            ?>
        </div>
        <div id="tab-two" role="tabpanel" class="tab-pane fade" aria-labelledby="tab-to-two">
            <?php
            //----------- Get all saved employers --------------
            require_once ROOT_PATH . '/views/tabs/employers.php';
            ?>
        </div>
        <div id="tab-three" role="tabpanel" class="tab-pane fade" aria-labelledby="tab-to-three">
            <?php
            //---------- Get all saved orders ----------------
            require_once ROOT_PATH . '/views/tabs/products.php';
            ?>
        </div>
        <div id="tab-five" role="tabpanel" class="tab-pane fade" aria-labelledby="tab-to-five">
            <?php
            //---------- Get all saved orders ----------------
            require_once ROOT_PATH . '/views/tabs/company_products_discount.php';
            ?>
        </div>
        <div id="tab-four" role="tabpanel" class="tab-pane fade" aria-labelledby="tab-to-four">
            <?php
            //---------- Get all saved orders ----------------
            require_once ROOT_PATH . '/views/tabs/orders.php';
            ?>
        </div>
    </div>
</div>
