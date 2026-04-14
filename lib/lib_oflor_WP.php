<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('lib_db_WP.php');
require_once('lib_InsightReport_WP.php');
require_once('lib_DCSReport_WP.php');

define("__SYSID", "700");

define('__ver', '?v=' . date('YmdHis'));




//############################################################
// BAZA DANYCH
//############################################################

define("__InsightServer", "172.28.42.21");
define("__InsightPort", "1433");

define("__InsightUser", "InsightPHP");
define("__InsightPass", "kqw9##dh&^*(Hui6A7A");

//define("__InsightDB", "Insight_rl");
define("__InsightDB", "Insight_prod");


define("__DCSServer", "172.21.0.4");
define("__DCSPort", "1433");

define("__DCSUser", "DCSreporting");
define("__DCSPass", "kbd234hh$643!6g");

//define("__InsightDB", "Insight_rl");
define("__DCSDB", "DCS3");


//###################################################################################################################



class dbInsight extends db_mssql
{
  function __construct($con=NULL)
  {
      $this->svr=__InsightServer;
      $this->port=__InsightPort;
      $this->user=__InsightUser;
      $this->pass=__InsightPass;
      $this->DB=__InsightDB;
      $this->open($con);
  }
}

class dbDCS extends db_mssql
{
  function __construct($con=NULL)
  {
      $this->svr=__DCSServer;
      $this->port=__DCSPort;
      $this->user=__DCSUser;
      $this->pass=__DCSPass;
      $this->DB=__DCSDB;
      $this->open($con);
  }
}


class oflor 
{
    var $classname="oflor";

    var $Alert="";
    var $Info1="";
    var $Info2="";

    var $ProductionInfo="";
    var $ProductionGoalDay=0; 
    var $ProductionGoalMonth=0;
    
    public $db;  

    function __construct()
    {
      $this->db=new dbInsight();
    }
    
    function __destruct()
    {
      $this->db->close();
    }

    function READ()
    {
    
      $this->db->execute("EXEC DRL.spMsgDesktop_00_Param");
      $rec=$this->db->row();
      
      $this->Alert=$rec["Alert"];
      $this->Info1=$rec["Info1"];
      $this->Info2=$rec["Info2"];

      $this->ProductionInfo=$rec["ProductionInfo"];
      $this->ProductionGoalDay=$rec["ProductionGoalDay"];
      $this->ProductionGoalMonth=$rec["ProductionGoalMonth"];
          
    }      
   

    public function HTML_SumOfProd2()
{
    $objI = new ReportInsight();
    $objD = new ReportDCS();

    $valIDay = $objI->SumOfProdDay();
    $valDDay = $objD->SumOfProdDay();
    $valIMonth = $objI->SumOfProdMonth();
    $valDMonth = $objD->SumOfProdMonth();
    $valGoalDay = $objI->ProductionGoalDay;
    $valGoalMonth = $objI->ProductionGoalMonth;

    $totalDay = $valIDay + $valDDay;
    $totalMonth = $valIMonth + $valDMonth;
    $missingDay = max(0, $valGoalDay - $totalDay);
    $missingMonth = max(0, $valGoalMonth - $totalMonth);

    // Procenty
    $percentDay = $valGoalDay > 0 ? round(($totalDay / $valGoalDay) * 100, 1) : 0;
    $percentMonth = $valGoalMonth > 0 ? round(($totalMonth / $valGoalMonth) * 100, 1) : 0;

    return '
    <div id="SumOfProd2">
      <div class="header">
        <i class="fas fa-shield-alt"></i> ŻYCZYMY BEZPIECZNEJ PRACY
      </div>
      <div class="stats-grid">
        <div class="stat-card insight">
          <div class="stat-label">INSIGHT</div>
          <div class="stat-value">' . number_format($valIDay ?: 0, 0, ',', ' ') . '</div>
        </div>
        <div class="stat-card dcs">
          <div class="stat-label">DCS</div>
          <div class="stat-value">' . number_format($valDDay ?: 0, 0, ',', ' ') . '</div>
        </div>
        <div class="stat-card razem">
          <div class="stat-label">RAZEM</div>
          <div class="stat-value">' . number_format($totalDay ?: 0, 0, ',', ' ') . '</div>
        </div>
      </div>
      <div class="progress-section">
        <div class="progress-card">
          <div class="progress-title">CEL NA DZIŚ</div>
          
          <!-- PASEK POSTĘPU -->
          <div class="progress-bar-container">
            <div class="progress-bar" style="width: ' . $percentDay . '%"></div>
            <div class="progress-percent">' . $percentDay . '%</div>
          </div>
          
          <div class="progress-numbers">
            <span class="achieved">' . number_format($totalDay, 0, ',', ' ') . ' </span>
            <span class="separator"> / </span>
             <span class="separator"> <br></b> </span>
            <span class="target">' . number_format($valGoalDay, 0, ',', ' ') . ' </span>
          </div>
          <div class="missing">Brakuje: ' . number_format($missingDay, 0, ',', ' ') . ' </div>
        </div>

        <div class="progress-card">
          <div class="progress-title">CEL MIESIĘCZNY</div>
          
          <!-- PASEK POSTĘPU -->
          <div class="progress-bar-container">
            <div class="progress-bar" style="width: ' . $percentMonth . '%"></div>
            <div class="progress-percent">' . $percentMonth . '%</div>
          </div>
          
          <div class="progress-numbers">
            <span class="achieved">' . number_format($totalMonth, 0, ',', ' ') . ' </span>
            <span class="separator"> / </span>
             <span class="separator"> <br></b> </span>
            <span class="target">' . number_format($valGoalMonth, 0, ',', ' ') . ' </span>
          </div>
          <div class="missing">Brakuje: ' . number_format($missingMonth, 0, ',', ' ') . ' </div>
        </div>
      </div>
    </div>';
}

    public function HTML_InstantAlert()
    //alarm ze stałem napisem
    {
        $result='';

         $result.="<div id=\"InstantAlert\">";
          $result.="<div id=\"Title\">";  
            $result.= "!!!! ALARM !!!!";
          $result.="</div>";

          $result.="<div id=\"Content1\">";  
            $result.= "E W A K U A C J A";
          $result.="</div>";

          $result.="<div id=\"Content2\">";  
            $result.= "Opuść budynek T E R A Z";
          $result.="</div>";
         
         $result.="</div>";  //InstantAlert

                                                   
        return $result;    
    
    
    }

    public function HTML_Alert()
    //alarm z definiowanym napisem
    {
        $result=''; 
      
         $result.="<div id=\"Alert\">";
          $result.="<div id=\"Title\">";  
            $result.= "U w a g a";
          $result.="</div>";

          $result.="<div id=\"Content\">";  
            $result.= $this->Alert;
          $result.="</div>";
         
         $result.="</div>";  //Alert      
     
        
        return $result;                            
    }
    

    public function HTML_Info()
    //alarm z definiowanym napisem
    {
        $result=''; 
    
         $result.="<div id=\"Info\">";
          $result.="<div id=\"Title\">";  
            $result.= "INFORMACJA";
          $result.="</div";

          $result.="<div id=\"Content1\">";  
            $result.= $this->Info1;
          $result.="</div";

          $result.="<div id=\"Content2\">";  
            $result.= $this->Info2;
          $result.="</div";
         
         $result.="</div>";  //InstantAlert    
      
        
        return $result;                   
    }
    
    
    
}

?>