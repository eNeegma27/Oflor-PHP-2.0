/*============================================================================*/
function setCookie()
{

    $.ajax({
         url: "__acceptcookie/set.php"
        ,dataType:'json'
        ,async: false
        ,success: function(json) {
            if (json["ok"]==1) $("#cookieinfo").fadeOut(1000);
            else alert(json["msg"]);
            return false;
        }
        ,error: function() {
                alert("[AJAX] Wystąpił błąd.");
                return false;
        }
    });

    return false;

}