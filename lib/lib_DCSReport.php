<?php
if (!class_exists('ReportDCS')) {
/*******************************************************************************
* Author: Rafał Likowski                                                       *
*******************************************************************************/
 
 
 class ReportDCS
 {
     var $classname="Report";
     private $db;
 
    function __construct()
    {
      //global $objDB;    
      //$this->db=new db($objDB->conn());    
      $this->db=new dbDCS();
    }
    
    function __destruct()
    {
      $this->db->close();
    }
    
    function SumOfProdDay()
    {
      $this->db->execute("EXEC DCSreport.spMsgDesktop_01_SumOfProd");
      $rec=$this->db->row();      

      return $rec['Net'];       
      
    }
 
    function SumOfProdMonth()
    {
      $this->db->execute("EXEC DCSreport.spMsgDesktop_02_SumOfProd");
      $rec=$this->db->row();      

      return $rec['Net'];       
      
    }
    
     
 }
 
 
 
}
?>