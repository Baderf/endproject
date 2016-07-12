<section class="md-main">
    <div class="container">
        <h1>Chat</h1>

        <div class="list-chat clearfix">
            <?php
            foreach( $chatmessages as $key => $val):

                if( $val['author'] == sessions::get('userid') ){
                    echo "<div class=\"item own-msg\" data-msgid=\"{$val['id']}\">";
                }else{
                    echo "<div class=\"item\">";
                }

                echo '<p><strong>' . $val['uname'] . '</strong></p>';
                echo '<p class="message">' . $val['message'] . '</p>';
                echo '<p class="text-info">geschrieben am ' . date('d.m.Y - h:i', $val['created_at']) . '</p>';

                echo '</div>';

            endforeach;
            ?>
        </div>
        <hr>
        <div class="new-answer">
            <?php
                echo $form;
            ?>
        </div>
    </div>
</section>