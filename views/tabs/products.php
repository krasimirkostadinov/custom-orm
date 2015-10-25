<?php
$product = new \models\Product();
$products = $product->findAll();
?>

<div class="panel panel-default">
    <div class="panel-heading">All avaliable products</div>
    <div class="panel-body">
        <p>Table contain all products and description.</p>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Discount</th>
            <th>Description</th>
            <th>Currency</th>
            <th>Price</th>
        </tr>
        </thead>
        <?php

        $table_products = '';
        if($products){
            foreach ($products as $single_product) {
                $currency = $db->find(new \models\Currency(), ['id' => $single_product['currency_id']]);
                $pr_discount = ($single_product['product_discount'] > 0) ? $single_product['product_discount'].' %' : 'None';
                $table_products .= '<tr>';
                $table_products .='<td>'.$single_product['product_name'].'</td>';
                $table_products .='<td>'. $pr_discount . '</td>';
                $table_products .='<td>'.$single_product['product_description'].'</td>';
                $table_products .='<td>'.$currency['name'].'</td>';
                $table_products .='<td>'.$single_product['product_price'].'</td>';
                $table_products .='</tr>';
            }
        }else{
            $table_products .= '<tr><td>Sorry, there are no added products!</td></tr>';
        }
        echo $table_products;
        ?>
    </table>
</div>