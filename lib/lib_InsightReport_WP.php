<?php
if (!class_exists('ReportInsight')) {
/*******************************************************************************
* Author: Rafał Likowski                                                       *
*******************************************************************************/
 
 
 class ReportInsight
 {
     var $classname="Report";
     private $db;
     
    var $ProductionGoalDay=0; 
    var $ProductionGoalMonth=0;
 
    function __construct()
    {
      //global $objDB;    
      //$this->db=new db($objDB->conn());    
      $this->db=new dbInsight();
    }
    
    function __destruct()
    {
      $this->db->close();
    }
    
    function SumOfProdDay()
    {
      $this->db->execute("EXEC DRL.spMsgDesktop_01_SumOfProd");
      $rec=$this->db->row();      

      $this->ProductionGoalDay=$rec['GoalDay'];

      return $rec['Net'];       
      
    }
 
    function SumOfProdMonth()
    {
      $this->db->execute("EXEC DRL.spMsgDesktop_02_SumOfProd");
      $rec=$this->db->row();      

      $this->ProductionGoalMonth=$rec['GoalMonth'];

      return $rec['Net'];       
      
    }
     
 }
 
 
 
 }
?>