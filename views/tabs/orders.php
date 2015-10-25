<?php
$order_product = new \models\OrderProduct();
$orders_products = $order_product->findAll();
?>
<div class="panel panel-default">
    <div class="panel-heading">All orders</div>
    <div class="panel-body">
        <p>Table contain all orders and additional data for the delivery.</p>
    </div>
    <?php
    $table_orders = '';
    $order_counter = 0;
    if ($orders_products) {
        foreach ($orders_products as $single_order) {
            $order_counter++;
            //---- TODO - these should be as attached as relate entities to current entity ---
            $order = $db->find(new \models\Order(), ['id' => $single_order['order_id']]);
            $order_company = $db->find(new \models\Company(), ['id' => $order['company_id']]);
            $product = $db->find(new \models\Product(), ['id' => $single_order['product_id']]);
            $currency = $db->find(new \models\Currency(), ['id' => $single_order['currency_id']]);
            $shipping_country = $db->find(new \models\Country(), ['id' => $order['shipping_country_id']]);
            $shipping_city = $db->find(new \models\City(), ['id' => $order['shipping_city_id']]);

            //Show IP with human readable format
            $order_ip = \models\helpers\Helper::convertIpAddress($order['ip']);

            //Total amount is calculated dynamically. Aggregate values should not be saved in database.
            $total_price = \models\helpers\Helper::calculateTotalPrice(
                $single_order['price'],
                $single_order['product_discount'],
                $single_order['company_discount'],
                $single_order['qty']
            );

            $table_orders .= '<div class="order-container">';
            $table_orders .= '<h3>Order: ' . $order_counter . '</h3>';
            $table_orders .= '<div class="order-row"><span>Company:</span><span>' . $order_company['company_name'] . '</span></div>';
            $table_orders .= '<div class="order-row"><span>Product:</span><span>' . $product['product_name'] . '</span></div>';
            $table_orders .= '<div class="order-row"><span>Quantity:</span><span>' . $single_order['qty'] . '</span></div>';
            $table_orders .= '<div class="order-row"><span>Product discount:</span><span>' . $single_order['product_discount'] . ' %</span></div>';
            $table_orders .= '<div class="order-row"><span>Company discount:</span><span>' . $single_order['company_discount'] . ' %</span></div>';
            $table_orders .= '<div class="order-row"><span>Shipping Country:</span><span>' . $shipping_country['country'] . '</span></div>';
            $table_orders .= '<div class="order-row"><span>Shipping City:</span><span>' . $shipping_city['city'] . '</span></div>';
            $table_orders .= '<div class="order-row"><span>Zip:</span><span>' . $shipping_city['zip'] . '</span></div>';
            $table_orders .= '<div class="order-row"><span>Shipping address:</span><span>' . $order['shipping_address'] . '</span></div>';
            $table_orders .= '<div class="order-row"><span>Currency:</span><span>' . $currency['name'] . '</span></div>';
            $table_orders .= '<div class="order-row"><span>Price:</span><span>' . $single_order['price'] . '</span></div>';
            $table_orders .= '<div class="order-row"><span>Note:</span><span>' . $order['note'] . '</span></div>';
            $table_orders .= '<div class="order-row"><span>Ip:</span><span>' . $order_ip . '</span></div>';
            $table_orders .= '<div class="order-row"><span>Date of purchase:</span><span>' . $order['created_at'] . '</span></div>';
            $table_orders .= '<div class="order-row"><span>Total sum:</span><span>' . $total_price . '</span></div>';
            $table_orders .= '</div>';
        }
    }else{
        $table_orders .= '<p>There are no placed orders!</p>';
    }
    echo $table_orders;
    ?>
</div>