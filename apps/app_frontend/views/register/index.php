<section class="md-main">
    <div class="container">
        <h1>Register</h1>

        <?php

        if( isset($formErrors) ){
            echo '<div class="error">';
            foreach($formErrors as $error){
                echo "<p>$error</p>";
            }
            echo '</div>';
        }

        ?>

        <?php echo $form;
        ?>

        <img src="<?php echo APP_ROOT . 'useraction/viewed/e6a9fc04320a924f46c7c737432bb0389d9dd095/25/33/invitation' ?>" style="display: none;" alt="">

    </div>
</section>