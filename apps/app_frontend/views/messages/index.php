<section class="md-main">
    <div class="container">
        <a href="messages/newmessage" class="btn-new">Neue Nachricht verfassen</a>
        <h1>Posteingang</h1>
        <table  class="table">
            <tr>
                <th>Nachricht</th>
                <th>Geschrieben am</th>
                <th>Aktionen</th>
            </tr>
            <?php
            foreach( $chats as $key => $val ) {

                $link = APP_ROOT . 'messages/chat/' . $val['chat_group_id'];

                if (strpos($val['gelesen'], ":" . sessions::get("userid") . ":") === false){
                    echo '<tr class="read bg-info">';
                }else{
                    echo '<tr>';
                }



                echo '<td><strong>' . $val['uname'] . ': </strong>' . $val['message'] . '</td>';
                echo '<td>' . date('d.m.Y - h:i', $val['created_at']) . '</td>';
                echo '<td><a href="' . $link . '"><span class="glyphicon glyphicon-comment"></span></a> <a href="#"><span class="glyphicon glyphicon-remove"></span></a></td>';

                echo '</tr>';

            }
            ?>
        </table>

    </div>
</section>