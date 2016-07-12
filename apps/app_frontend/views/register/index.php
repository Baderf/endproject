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

        <?php echo $form; ?>
    </div>
</section>