<section class="md-main">
    <div class="container">
        <h1>Social</h1>
        <?php

        foreach($facebookFeed -> data as $feedEntry):

            echo '<h2>' . $feedEntry -> message . '</h2>';
        var_dump($feedEntry);

        endforeach;

        ?>

    </div>
</section>