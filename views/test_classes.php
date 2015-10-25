<div class="container-fluid demo">
    <h2>Test examples</h2>

    <?php

    //--- Create new city. ---
    //--- *Wrong country_id. Must be int, zip can not be empty
    /*$city = new \models\City();
    $city->setCountryId('4');
    $city->setCity('Stara Zagora');
    $city->setZip(null); // '9000'
    $result = $city->save();*/


    //--- Create new Company ---
    // *Wrong company name - can not be null, and not valid email address
    /*$company = new \models\Company();
    $company->setCountryId(4);
    $company->setCityId(1);
    $company->setEmail('test@gmail.');
    $company->setAddress('Bul. Bulgaria 148');
    $company->setCompanyName(''); //TestCompany
    $company->setPhone('+359 883606064');
    $result = $company->save();*/


    //--- Create new Company to product discount ---
    // *Wrong discount value. Must be int between 1-100%.
    /*$discount = new \models\CompanyDiscount();
    $discount->setCompanyId(2);
    $discount->setProductId(1);
    $discount->setDiscountAmount(101); //between 0 and 100
    $result = $discount->save();*/


    //--- EDIT existing currency ---
    // *Wrong label for Russian ruble. Must be (RUB) instead (GBP)
    /*$currency = new \models\Currency();
    $currency->setId(9);
    $currency->setName('Russian ruble (GBP)'); //Russian ruble (RUB)
    $result = $currency->save();*/

    //--- Create new Employer ---
    // *Wrong empty employer name. Must be string and not empty value.
    /*$employer = new \models\Employer();
    $employer->setCompanyId(3);
    $employer->setCountryId(5);
    $employer->setCityId(18);
    $employer->setEmployeeName(''); //Ivan Petrov
    $employer->setEmployeeEmail('employer@yahoo.com');
    $result = $employer->save();*/

    //--- Create new Product.
    /*$product = new \models\Product();
    $product->setProductName('Промишлени стоки');
    $product->setProductDescription('За използване при домашни условия');
    $product->setCurrencyId(2);
    $product->setProductDiscount(3);
    $product->setProductPrice('22');
    $result = $product->save();*/

    //--- Create new Order ---
    // *Wrong IP address. Must be valid IP address.
    /*$order = new \models\Order();
    $order->setCompanyId(3);
    $order->setShippingCountryId(3);
    $order->setShippingCityId(3);
    $order->setShippingAddress('London, LSE Houghton Street, London, WC2A 2AE');
    $order->setNote('Please check shipping price and write to me for total amount!');
    $order->setIp('123456789'); //158.58.202.50
    $result = $order->save();*/

    //--- Create new Order Product. One order can have multiple ordered products.
    // *Wrong currency id - it should be integer field
    /*$order_product = new \models\OrderProduct();
    $order_product->setOrderId(3);
    $order_product->setProductId(3);
    $order_product->setQty(1);
    $order_product->setProductDiscount(5);
    $order_product->setCompanyDiscount(5);
    $order_product->setCurrencyId(''); //2
    $result = $order_product->save();*/


    //------------------ Queries --------------------//

    $employers = new \models\Employer();

    // ------- Find all employers -------
    $result = $employers->findAll();

    // ------- Find employers by name -------
    /* $result = $employers->find(['employee_name' => 'Петър Митев']); */

    // ------- Find ALL employers and sort DESC by employee_name -------
    /* $result = $employers->findAll([], '*', 'employee_name DESC'); */

    // ------- Find ALL employers with limit 2
    /* $result = $employers->findAll([], '*', '', 2); */

    // ------- Find employer by dynamic parameters
    /* $result = $employers->findByEmployee_Email('info@krasimirkostadinov.com'); */

    // ------- Find employers by Country and City
    /* $result = $employers->findByCountry_IdAndCity_id(4, 2); */

    // ------- Validate date -----------
    /* var_dump(models\helpers\Helper::isValidDate('22/10/2015')); */

    // ------- Valite over limit data for field ---------------
    /* var_dump(models\helpers\Helper::validateMaxFieldText('Over limit text', 3)); */

    // ------- Delete Employer ----------
    /* $employers->setId(7);
    $employers->delete(); */

    echo '<pre>';
    print_r($result);
    echo '</pre>';
    ?>
</div>
