<?php
$discount = new \models\CompanyDiscount();
//get all discounts grouped by company_id
$discounts = $discount->findAll( [], '*', 'company_id');
?>

<div class="panel panel-default">
    <div class="panel-heading">Show all products discounts</div>
    <div class="panel-body">
        <p>Show all products discounts grouped by company</p>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Company</th>
            <th>Product</th>
            <th>Discount</th>
        </tr>
        </thead>
        <?php
        $table_discounts = '';
        if($discounts){
            foreach ($discounts as $single_discount) {
                $company = $db->find(new \models\Company(), ['id' => $single_discount['company_id']]);
                $product = $db->find(new \models\Product(), ['id' => $single_discount['product_id']]);

                $table_discounts .= '<tr>';
                $table_discounts .='<td>'.$company['company_name'].'</td>';
                $table_discounts .='<td>'.$product['product_name'].'</td>';
                $table_discounts .='<td>'.$single_discount['discount_amount'].' %</td>';
                $table_discounts .='</tr>';
            }
        }else{
            $table_discounts .= '<tr><td>Sorry, there are no discounts!</td></tr>';
        }
        echo $table_discounts;
        ?>
    </table>
</div>