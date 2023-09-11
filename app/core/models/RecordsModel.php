<?php
// id 	visitors downloads	
// records
class RecordsModel extends BaseModel {
    // db properties
    private static $table = 'records';

    // table iterms
    private static $id = 1;
    private static $received_power;
    private static $transmitted_power;
    private static $coil_active;

    /**    methods     */

    // get current number of downloads
    public static function get_records () { 
        // query db
        return self::recordSelector(self::$id, self::$table)->fetchAll();
    }

    public static function received_power () {
        $records = self::recordSelector(self::$id, self::$table)->fetch();
        return $records["received_power"];
    }

    public static function transmitted_power () {
        $records = self::recordSelector(self::$id, self::$table)->fetch();
        return $records["transmitted_power"];
    }

    public static function coil_active () {
        $records = self::recordSelector(self::$id, self::$table)->fetch();
        return $records["coil_active"];
    }

    public static function previous_coil_active () {
        $records = self::recordSelector(self::$id, self::$table)->fetch();
        return $records["previous_active_coil"];
    }

    public static function last_update_time () {
        $records = self::recordSelector(self::$id, self::$table)->fetch();
        return $records["time"];
    }

    // registration function
    public static function resetDB (){

        /**
         *  Logs a user in
         *  @param  $received_power
         *  @param  $transmitted_power :
         *  @param  $coil_active 
         *  @return $status msg
         */

        // sanitize the data
        self::$transmitted_power = 0;
        self::$received_power = 0;
        self::$coil_active = "n";

        $query = "UPDATE " . self::$table . " SET `transmitted_power`=?, `received_power`=?, `coil_active`=?, `previous_active_coil`=?";
        $statement = self::connect()->prepare($query);
        $statement->execute([self::$transmitted_power, self::$received_power, self::$coil_active, self::coil_active()]);
        // query
        if ($statement){
            return 'record inserted successfully';
        } else {
            // return with error message developer issue
            return 'recording failed';
        }
    }
    

    // registration function
    public static function recorder ($received_power, $transmitted_power, $coil_active){

        /**
         *  Logs a user in
         *  @param  $received_power
         *  @param  $transmitted_power :
         *  @param  $coil_active 
         *  @return $status msg
         */

        // sanitize the data
        self::$transmitted_power = htmlentities(html_entity_decode($transmitted_power));
        self::$received_power = htmlentities(html_entity_decode($received_power));
        self::$coil_active = htmlentities(html_entity_decode($coil_active));

        if (self::rowcount(self::$table) == 0) {
            $query = "INSERT INTO " . self::$table . "(transmitted_power, received_power, coil_active, previous_active_coil) VALUES(?,?,?,?) ";
            $statement = self::connect()->prepare($query);
            $statement->execute([self::$transmitted_power, self::$received_power, self::$coil_active, self::coil_active()]);
        } elseif (self::rowcount(self::$table) == 1) {
            if (self::coil_active() == self::$coil_active) {
                $query = "UPDATE " . self::$table . " SET `transmitted_power`=?, `received_power`=?";
                $statement = self::connect()->prepare($query);
                $statement->execute([self::$transmitted_power, self::$received_power]);
            } else {
                $query = "UPDATE " . self::$table . " SET `transmitted_power`=?, `received_power`=?, `coil_active`=?, `previous_active_coil`=?";
                $statement = self::connect()->prepare($query);
                $statement->execute([self::$transmitted_power, self::$received_power, self::$coil_active, self::coil_active()]);
            }
            
        }
        // query
        if ($statement){
            return 'record inserted successfully';
        } else {
            // return with error message developer issue
            return 'recording failed';
        }
    }

    // transmitted power function
    public static function transmitted_Power_Recorder ($transmitted_power, $coil_active){

        /**
         *  Logs a user in
         *  @param  $transmitted_power :
         *  @param  $coil_active 
         *  @return $status msg
         */

        // sanitize the data
        self::$transmitted_power = htmlentities(html_entity_decode($transmitted_power));
        self::$coil_active = htmlentities(html_entity_decode($coil_active));


        if (self::rowcount(self::$table) == 1) {
            if (self::coil_active() == self::$coil_active) {
                $query = "UPDATE " . self::$table . " SET `transmitted_power`=?";
                $statement = self::connect()->prepare($query);
                $statement->execute([self::$transmitted_power]);
            } else {
                $query = "UPDATE " . self::$table . " SET `transmitted_power`=? `coil_active`=?, `previous_active_coil`=?";
                $statement = self::connect()->prepare($query);
                $statement->execute([self::$transmitted_power, self::$coil_active, self::coil_active()]);
            }            
        }

        // query
        if ($statement){
            return 'record inserted successfully';
        } else {
            // return with error message developer issue
            return 'recording failed';
        }
    }

    // registration function
    public static function received_Power_Recorder ($received_power){

        /**
         *  Logs a user in
         *  @param  $received_power
         *  @return $status msg
         */

        // sanitize the data
        self::$received_power = htmlentities(html_entity_decode($received_power));

        
        $query = "UPDATE " . self::$table . " SET `received_power`=?";
        $statement = self::connect()->prepare($query);
        $statement->execute([self::$received_power]);
        // query
        if ($statement){
            return 'record inserted successfully';
        } else {
            // return with error message developer issue
            return 'recording failed';
        }
    }

}