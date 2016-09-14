<?php

class dashboard_model extends model{


    public function setIntroNull($user_id){
        $sql = $this -> db -> query("UPDATE users SET intro_on = 0 WHERE id = $user_id");

        if($sql){
            return true;
        }else{
            return false;
        }
    }

    public function getEvents($user_id){

        $actual_time = time();

        $sql = $this -> db -> query("SELECT * FROM events WHERE user_id = $user_id AND date_to_time > $actual_time");

        if($sql -> num_rows >0){
            $events = $sql->fetch_all(MYSQLI_ASSOC);

            foreach ($events as &$event){
                $tablename = "users_mails_".$event['id'];

                $sql = $this -> db -> query("
                SELECT 
                    SUM(CASE WHEN invitation_sent = 1 THEN 1 ELSE 0 END) AS invitation_sent,
                    SUM(CASE WHEN invitation_viewed = 1 THEN 1 ELSE 0 END) AS invitation_viewed,
                    SUM(CASE WHEN std_viewed = 1 THEN 1 ELSE 0 END) AS std_viewed,
                    SUM(CASE WHEN std_sent = 1 THEN 1 ELSE 0 END) AS std_sent,
                    SUM(CASE WHEN reminder_sent = 1 THEN 1 ELSE 0 END) AS reminder_sent,
                    SUM(CASE WHEN reminder_viewed = 1 THEN 1 ELSE 0 END) AS reminder_viewed,
                    SUM(CASE WHEN info_sent = 1 THEN 1 ELSE 0 END) AS info_sent,
                    SUM(CASE WHEN info_viewed = 1 THEN 1 ELSE 0 END) AS info_viewed,
                    SUM(CASE WHEN ty_sent = 1 THEN 1 ELSE 0 END) AS ty_sent,
                    SUM(CASE WHEN ty_viewed = 1 THEN 1 ELSE 0 END) AS ty_viewed,
                    COUNT(*) AS TOTAL
                    
                FROM $tablename
                
                ");

                $event['counts'] = $sql ->fetch_assoc();

                $tablename2 = "users_event_".$event['id'];

                $sql = $this -> db -> query("
                SELECT 
                    SUM(CASE WHEN accepted = 1 THEN 1 ELSE 0 END) AS accepted,
                    SUM(CASE WHEN canceled = 1 THEN 1 ELSE 0 END) AS canceled,
                    SUM(CASE WHEN accepted = 0 AND canceled = 0 THEN 1 ELSE 0 END) AS noaction
                FROM $tablename2
                ");

                $event['actions'] = $sql -> fetch_assoc();

                if($event['std_sent'] != 0 || $event['invitation_sent'] != 0 || $event['reminder_sent'] != 0 || $event['info_sent'] != 0 || $event['ty_sent'] != 0){
                    $event['dashboard'] = "running";
                }else{
                    $event['dashboard'] = "upcomming";
                }
            }

            return $events;

        }else{
            return false;
        }
    }
}