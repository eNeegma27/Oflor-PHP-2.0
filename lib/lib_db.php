<?php
if (!class_exists('db_mssql')) {
/*******************************************************************************
* Author: Rafał Likowski                                                       *
*******************************************************************************/
 
 
 //###################################################################################################################
class db_mssql
{
     var $ClassName;
    
    protected $svr;
    protected $port;
    protected $user;
    protected $pass;

    protected $DB;
        
    protected $con;

    protected $rs;
    
    function __construct($srv,$usr,$pass,$db,$port=1433)
    {
        $this->ClassName='db';
    
        $this->svr=$srv;
        $this->port=$port;
        $this->user=$usr;
        $this->pass=$pass;
        $this->DB=$db;
        $this->open();
    }    

    function __destruct()
    {
    }

    
    public function conn()
    {
      return $this->con;
    }

    public function open($con=NULL)
    {
        if (!isset($con))
        {
        
          $serverName = $this->svr.','.$this->port;
          $connectionInfo = array(
              "Database" => $this->DB,
              "UID"      => $this->user,
              "PWD"      => $this->pass
          );
          
          $this->con = sqlsrv_connect($serverName, $connectionInfo);        

         //sqlsrv_errors()
        if ($this->con===false) throw new Exception("Nie można ustanowić połączenia z serwerem bazy danch.||".__METHOD__."#".__LINE__."||this->svr:$this->port / $this->user / $this->pass / $this->DB |<br><br>".print_r( sqlsrv_errors(), true),10);
        }
        else $this->con=$con;
        
    }

    public function close()
    {
        if (!sqlsrv_close($this->con)) throw new Exception("Nie można prawidłowo zakończyć połączenia z serwerem bazy danych.||".__METHOD__."#".__LINE__,10);
    }        

    public function execute($q)
    {

        $this->rs=sqlsrv_query($this->con, $q);
        
        
        if ($this->rs===false) 
        {
        $err=sqlsrv_errors();
        //zapisz treść błędu
        //SQLerrorlog($q,$err);
        //rzuć wyjątek
        throw new Exception("Błąd wykonania kwerendy.||".__METHOD__."#".__LINE__."||$err<br><br>$q",11);
        }
        /*
        elseif (strpos($q,'DELETE')!==false && strpos($q,'xpagination')===false && strpos($q,'stat')===false)
        {
          SQLlog($q);
        }
        */
        return $this->rs;
    }


    public function row()
    {
        //$array = mysql_fetch_array($this->rs);
        if (isset($this->rs)) $array =  sqlsrv_fetch_array($this->rs, SQLSRV_FETCH_ASSOC);
        
        //jesli FALSE nie rzucam wyjątku bo ma być ono dalej przekazane do pętli while jako zakończnie
        return $array;
    }
    
    public function value()
    {
        $array = sqlsrv_fetch_array($this->rs, SQLSRV_FETCH_ASSOC);
        if (!isset($array)) return '';
        return $array[0];
    }    
    

}  //class: db_mssql

//###################################################################################################################
}
?>