<?php
require_once './config.php';

//Autoload all classes by PSR-4 specification
require_once __DIR__ . '/vendor/autoload.php';

require_once ROOT_PATH . '/views/layouts/header.php';
$db = new \models\database\DBContext();
?>
    <div class="container-fluid main-container">
        <div class="row clearfix">
            <div class="container">
                <h1>Companies overview</h1>
                <?php
                //----------- Include site layout ----------
                require_once ROOT_PATH . '/views/layouts/site-layout.php';
                ?>

                <?php
                    //Ready test examples for CRUD operations and validations. Uncomment next line!
                    /* require_once ROOT_PATH . '/views/test_classes.php'; */
                ?>
            </div>
        </div>
    </div>
<?php
require_once ROOT_PATH . '/views/layouts/footer.php';
?>