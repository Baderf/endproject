<?php

class messages_model extends model{

    public function __construct(){

        parent::__construct();
    }

    public function createChat($users, $message){

        $users .= ":" . sessions::get('userid') . ':';

        // Gruppen-Chat erstellen
        $res = $this -> db -> query("INSERT INTO chat_groups (user_ids) VALUES ('$users')");

        // Erste Nachricht in den Gruppen-Chat einfügen
        $groupid = $this -> db -> insert_id;
        $created_at = time();
        $gelesen = ":" . sessions::get('userid') . ':';
        $author = sessions::get('userid');

        $stmt = $this -> db -> prepare("INSERT INTO chat_messages (group_id, author, message, created_at, gelesen) VALUES (?,?,?,?,?)");

        $stmt -> bind_param("issss", $groupid, $author, $message, $created_at, $gelesen);
        $stmt -> execute();
        $stmt -> close();

        return $groupid;
    }

    public function createMessage($groupID, $message, $returnUsername = false){
        $created_at = time();
        $gelesen = ":" . sessions::get('userid') . ':';
        $author = sessions::get('userid');

        $stmt = $this -> db -> prepare("INSERT INTO chat_messages (group_id, author, message, created_at, gelesen) VALUES (?,?,?,?,?)");

        $stmt -> bind_param("issss", $groupID, $author, $message, $created_at, $gelesen);
        $stmt -> execute();
        $stmt -> close();

        if ( $returnUsername === true){
            $data = array(
                'uname' => sessions::get('uname'),
                'time' => date('d.m.Y - h:i')
            );

            return json_encode($data);
        }

    }

    public function getChatMessages( $groupID ){

        $res = $this -> db -> query("SELECT chat_messages.*, users.uname FROM chat_messages LEFT JOIN users ON chat_messages.author = users.id WHERE group_id = '$groupID' ORDER BY id");

        if( $res -> num_rows > 0 ){

            return $res -> fetch_all(MYSQLI_ASSOC);
        }

        return false;
    }

    public function updateMessage($msgid, $message){
        $res = $this -> db -> query("UPDATE chat_messages SET message = '$message' WHERE id = '$msgid'");
    }

    public function getAllMessages(){
        $userid = ":" . sessions::get("userid") . ":";

        $res = $this -> db -> query("SELECT chat_messages.*, chat_groups.id AS chat_group_id, chat_groups.user_ids, users.uname FROM chat_messages LEFT JOIN chat_groups ON chat_messages.group_id = chat_groups.id LEFT JOIN users ON chat_messages.author = users.id WHERE chat_groups.user_ids LIKE '%$userid%' GROUP BY group_id ORDER BY chat_messages.created_at DESC");

        if($res -> num_rows > 0){
            return $res -> fetch_all(MYSQLI_ASSOC);
        }
    }

    public function checkAlreadyRead($groupID){
        $userid = ":" . sessions::get("userid") . ":";


        $res = $this -> db -> query("SELECT id, gelesen FROM chat_messages WHERE group_id = '$groupID' ORDER BY created_at DESC LIMIT 1");
        if( $res -> num_rows > 0){
            $lastMessage = $res -> fetch_assoc();
            if(strpos($lastMessage['gelesen'], $userid) === false){
                $gelesen = $lastMessage['gelesen'] . $userid;
                $res = $this -> db -> query("UPDATE chat_messages SET gelesen = '$gelesen' WHERE id = '{$lastMessage['id']}'");
            }
        }



    }
}