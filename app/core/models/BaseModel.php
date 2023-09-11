<?php
// base model
class BaseModel extends Database{
    // Database properties
    private static $con;
    private static $table;

    // table properties
    private static $id;

    /*  METHODS  */
    protected static function prep_execute ($query) {
        $statement = self::connect()->prepare($query);
        $statement->execute();
        return $statement;
    }

    // get all records
    protected static function getAllRecords ($table) {
        /** 
         *  @param
         *  @return
         */
        $query = "SELECT * FROM " . $table;
        return self::prep_execute($query);
    }

    // count rows
    protected static function rowcount ($table) {
        /** 
         *  @param
         *  @return
         */

        $rows = self::getAllRecords($table);
        $rows = $rows->rowCount();
        return $rows;
    }

    // new record number 
    public static function record_number ($id, $table) {
        return ((self::rowcount($table) + 1) - $id);
    }

    
    // select record by id
    protected static function recordSelector ($id, $table) {
        /**
         *  @param $record id 
         *  @return $true if record is selected
         */

        $query = "SELECT * FROM $table WHERE `id`=?";
        $statement = self::connect()->prepare($query);
        $statement->execute([$id]);
        
        if ($statement == true && self::rowcount($table))
        {
            return $statement;
        }

        return "Record does not exist!";
       
    }


    // select record by id
    protected static function get_record ($token, $table) {
        /**
         *  @param $record storage_filename
         *  @return $true if record is selected
         */
       
        $query = "SELECT * FROM $table WHERE `storage_filename`=?";
        $statement = self::connect()->prepare($query);
        $statement->execute([$token]);
        
        if ($statement == true && self::rowcount($table))
        {
            return $statement->fetch();
        } else {
            return 0;
        }
       
    }

    // db reset id count
    protected static function dbrest($table){
        /**
         * @param $id the user id in the database
         * @return true if updated and false on failer
         * 
         */
        $query = "SET @num :=0; UPDATE $table SET `id`=@num := @num+1; ALTER TABLE $table AUTO_INCREAMENT = 1; ";
        $statement = self::connect()->prepare($query);
        $result = $statement->execute();
        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }

    // select record by id
    protected static function deleteRecord ($id, $table) {
        /**
         *  @param $record id 
         *  @return $true if record is delete
         * 
         */

        $query = "DELETE FROM $table WHERE `id`=?";
        $statement = self::connect()->prepare($query);
        $statement->execute([$id]);
        
        if ($statement == true)
        {
            if (self::dbrest($table)) {
                return 1;
            }
        }
        return 0;        
    }
    
    // end of class
}



