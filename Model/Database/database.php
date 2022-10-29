<?php
class Database
{

    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $databaseName = 'clinic_management_system';

    private $con = false;
    private $myConn = '';
    private $result = [];
    private $myQuery = "";
    private $numResults = "";

    // constructor
    function __construct()
    {
        $this->myConn = new mysqli($this->host, $this->user, $this->password, $this->databaseName);

        if ($this->myConn->connect_errno) {
            die("Database connection Failed" . $this->myConn->connect_errno);
            $this->con = false;
        } else {
            $this->con = true;
        }
    }

    public function sql($sql)
    {
        //var_dump($sql); exit;
        $query = $this->myConn->query($sql);

        $this->myQuery = $sql; // Pass back the SQL
        if ($query) {
            // If the query returns >= 1 assign the number of rows to numResults
            $this->numResults = @$query->num_rows;
            // Loop through the query results by the number of rows returned
            for ($i = 0; $i < $this->numResults; $i++) {
                $r = $query->fetch_array();
                $key = array_keys($r);
                for ($x = 0; $x < count($key); $x++) {
                  
                    // Sanitizes keys so only alpha-values are allowed
                    if (!is_int($key[$x])) {
                        if ($query->num_rows >= 1) {
                            $this->result[$i][$key[$x]] = $r[$key[$x]];
                        } else {
                            $this->result = "";
                        }
                    }
                }
            }
            return true; // Query was successful
        } else {
            array_push($this->result, $this->myConn->error);
            return false; // No rows were returned
        }
    }


    public function escape($string)
    {
        return strtolower(trim(addslashes(mysqli_real_escape_string($this->myConn, $string))));
    }

    public function getSql()
    {
        $val = $this->myQuery;
        $this->myQuery = array();
        echo $val;
    }

    public function getResult()
    {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    public function getNumberOfRows()
    {
        $val = $this->numResults;
        $this->numResults = array();
        return $val;
    }

    // public function escape($data) {
    //     return strtolower(trim(addslashes($this->myConn->real_escape_string($data))));
    // }



    public function countRows($table, $field = "*", $condition)
    {
        $this->sql("SELECT $field FROM $table WHERE $condition");
        return $this->getNumberOfRows();
    }

    // these are the CRUD methods
    public function save($table, $sql)
    {
        return $this->sql("INSERT INTO $table SET $sql");
    }

    public function saveChanges($table, $sql, $condition)
    {
        return $this->sql("UPDATE $table SET $sql WHERE $condition");
    }

    public function erase($table, $condition)
    {
        return $this->sql("DELETE FROM $table WHERE $condition");
    }

    public function lookUp($table, $field = "*", $condition = "", $column = "")
    {
      
        $con = !empty($condition) ? " WHERE $condition" : "";
        
        $this->sql("SELECT $field FROM $table $con");
        // $this->getSql();exit;
        $rlt = $this->getResult();
       
        if (!empty($rlt)) {
            if (is_object($rlt) || is_array($rlt)) {
                if (!empty($column)) {
                    if (!empty($rlt[0][$column])) {
                        return $rlt[0][$column];
                    }
                } else {
                    return $rlt;
                }
            }
        }
    }
}
