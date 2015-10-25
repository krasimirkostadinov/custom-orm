<?php
$employer = new \models\Employer();
$employers = $employer->findAll();
?>

<div class="panel panel-default">
    <div class="panel-heading">All saved employers</div>
    <div class="panel-body">
        <p>Table show all employers</p>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Zip</th>
                <th>Company</th>
            </tr>
        </thead>
        <?php
        $table_employers = '';
        if($employers){
            foreach ($employers as $single_employer) {
                $country = $db->find(new \models\Country(), ['id' => $single_employer['country_id']]);
                $city = $db->find(new \models\City(), ['id' => $single_employer['city_id']]);
                $company = $db->find(new \models\Company(), ['id' => $single_employer['company_id']]);
                $table_employers .= '<tr>';
                $table_employers .='<td>'.$single_employer['employee_name'].'</td>';
                $table_employers .='<td><a href="mailto:'.$single_employer['employee_email'].'">'.$single_employer['employee_email'].'</a> </td>';
                $table_employers .='<td>'.$single_employer['employee_address'].'</td>';
                $table_employers .='<td>'.$single_employer['employee_phone'].'</td>';
                $table_employers .='<td>'.$country['country'].'</td>';
                $table_employers .='<td>'.$country['state'].'</td>';
                $table_employers .='<td>'.$city['city'].'</td>';
                $table_employers .='<td>'.$city['zip'].'</td>';
                $table_employers .='<td>'.$company['company_name'].'</td>';
                $table_employers .='</tr>';
            }
        }else{
            $table_employers .= '<tr><td>Sorry, there are no added employers!</td></tr>';
        }
        echo $table_employers;
        ?>
    </table>
</div>