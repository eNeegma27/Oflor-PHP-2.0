var config="";
var TimeCounter=0
var TimeCountdown=0

var PanelInstantAlert=0;
var PanelInstantAlert_prev=-1;
var PanelAlert=0;
var PanelInfo=0;
var PanelSumOfProd=0;
var RefreshTime=0

var Alert_time=0;
var Info_time=0;
var SumOfProd_time=0;

var Alert_content="";
var Info_content1="";
var Info_content2="";
var SumOfProd_content="";

var StartInfo = `
  <div style="
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
    font-family: 'Segoe UI', sans-serif;
    color: #d32f2f;
    text-align: center;
    padding: 40px;
  ">
    <div style="
      font-size: clamp(4rem, 12vw, 10rem);
      font-weight: 900;
      margin-bottom: 30px;
      text-shadow: 0 4px 12px rgba(0,0,0,0.2);
    ">ŁADOWANIE...</div>
    <div style="
      font-size: clamp(2rem, 6vw, 4rem);
      color: #555;
    ">Proszę czekać</div>
  </div>
`;

let InstantAlertFlashing_colors_background = ['red', 'white'];
let InstantAlertFlashing_colors = ['white', 'red'];
let InstantAlertFlashing_i = 0;

$(document).ready(

function()
{

  setInterval(ReadConfig, 1000);
  setInterval(InstantAlertFlashing, 700);


}

);

function InstantAlertFlashing()
{
    $('#InstantAlert #Content1').css('background-color', InstantAlertFlashing_colors_background[InstantAlertFlashing_i]);
    $('#InstantAlert #Content1').css(           'color', InstantAlertFlashing_colors           [InstantAlertFlashing_i]);
    InstantAlertFlashing_i = (InstantAlertFlashing_i + 1) % InstantAlertFlashing_colors_background.length;
}

function ReadConfig()
{
    $.ajax({
        url: 'config.txt',
        dataType: 'text',
        cache: false,
        success: function(dane) {
            try {
                if (config !== dane) {
                    config = dane;
                    TimeCounter = 1;
                    $("#mainpanel").html(StartInfo);
                }

                var json = JSON.parse(dane);

                PanelSumOfProd = json.SumOfProd || 0;
                SumOfProd_time = json.SumOfProdTime || 30;
                RefreshTime = json.RefreshTime || 60;
                TimeCountdown = RefreshTime;

                // TYLKO SumOfProd – ignorujemy resztę!
                if (PanelSumOfProd == 1 && TimeCounter >= SumOfProd_time) {
                    ShowSumOfProd();
                    TimeCounter = 1; // reset licznika
                }

                TimeCounter++;
                if (TimeCountdown <= 0) TimeCountdown = RefreshTime;

            } catch (e) {
                console.error("Błąd parsowania config.txt", e);
            }
        },
        error: function() {
            $("#mainpanel").html(StartInfo);
        }
    });
}


function ShowInstantAlert()
{

    $.ajax({
         url: "ajax/InstantAlert.php"
        ,dataType:'json'  
        ,type: "POST"
        ,success: function(json) {
            if (json["ok"]==0) {
                $('#mainpanel').css('width','100%');
                $("#mainpanel").html(json["content"]);
            }
            else            
            {
              $('#mainpanel').css('width','95%');
              $("#mainpanel").html( "<br><br>" + json["msg"] + "<br><br>Kod błędu:" + json["ok"]);

            } 
        }
        ,error: function() {alert("[AJAX] Wystąpił błąd.");}        
    });
    
    return false;
}


function ShowAlert()
{

    $.ajax({
         url: "ajax/Alert.php"
        ,dataType:'json'  
        ,type: "POST"
        ,success: function(json) {
            if (json["ok"]==0) {
                $('#mainpanel').css('width','100%');
                $("#mainpanel").html(json["content"]);
                $("#mainpanel #Alert #Content").html(Alert_content);
            }
            else            
            {
              $('#mainpanel').css('width','95%');
              $("#mainpanel").html( "<br><br>" + json["msg"] + "<br><br>Kod błędu:" + json["ok"]);
            }  
        }
        ,error: function() {alert("[AJAX] Wystąpił błąd.");}        
    });
    
    return false;
}



function ShowInfo()
{

    $.ajax({
         url: "ajax/Info.php"
        ,dataType:'json'  
        ,type: "POST"
        ,success: function(json) {
            if (json["ok"]==0) {
                $('#mainpanel').css('width','100%');
                $("#mainpanel").html(json["content"]);
                $("#mainpanel #Info #Content1").html(Info_content1);
                $("#mainpanel #Info #Content2").html(Info_content2);
            }
            else            
            {
              $('#mainpanel').css('width','95%');
              $("#mainpanel").html( "<br><br>" + json["msg"] + "<br><br>Kod błędu:" + json["ok"]);

            } 
        }
        ,error: function() {alert("[AJAX] Wystąpił błąd.");}        
    });
    
    return false;
}



function ShowSumOfProd()
{
 

    $.ajax({
         url: "ajax/SumOfProd.php"
        ,dataType:'json'  
        ,type: "POST"
        ,success: function(json) {
    if (json["ok"] == 0) {
        $('#mainpanel').css('width','95%');
        $("#mainpanel").html(json["content"]);
    } else {
        $('#mainpanel').css('width','95%');
        $("#mainpanel").html("<br><br>" + json["msg"] + "<br><br>Kod błędu:" + json["ok"]);
    }
}
        ,error: function() {alert("[AJAX] Wystąpił błąd.");}        
    });
    
    return false;
}