<section class="md-main">
    <div class="container">
        <h1>Thank you for registration!</h1>

        <?php
        if(empty($data['feedback']['action_target']) || $data['feedback']['action_target'] == ""){
            ?>
            <p>You can now close the window or visit a different website!</p>
        <?php
        }else{
            echo "<p>" . $data['feedback']['action_target'] . "</p>";
        }
        ?>

    </div>
</section>