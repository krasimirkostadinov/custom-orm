<?php
$company = new \models\Company();
$companies = $company->findAll();
?>

<div class="panel panel-default">
    <div class="panel-heading">All saved companies</div>
    <div class="panel-body">
        <p>Table show all registered companies and mapped data to them.</p>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Zip</th>
            <th>Address</th>
            <th>Phone</th>
        </tr>
        </thead>
        <?php
        $table_companies = '';
        if($companies){
            foreach ($companies as $single_company) {
                $country = $db->find(new \models\Country(), ['id' => $single_company['country_id']]);
                $city = $db->find(new \models\City(), ['id' => $single_company['city_id']]);
                $table_companies .= '<tr>';
                $table_companies .='<td>'.$single_company['company_name'].'</td>';
                $table_companies .='<td><a href="mailto:'.$single_company['email'].'">'.$single_company['email'].'</a> </td>';
                $table_companies .='<td>'.$country['country'].'</td>';
                $table_companies .='<td>'.$country['state'].'</td>';
                $table_companies .='<td>'.$city['city'].'</td>';
                $table_companies .='<td>'.$city['zip'].'</td>';
                $table_companies .='<td>'.$single_company['address'].'</td>';
                $table_companies .='<td>'.$single_company['phone'].'</td>';
                $table_companies .='</tr>';
            }
        }else{
            $table_companies .= '<tr><td>Sorry, there are no added companies!</td></tr>';
        }
        echo $table_companies;
        ?>
    </table>
</div>