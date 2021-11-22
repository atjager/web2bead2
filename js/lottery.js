function years() {
    $.post(
        "models/webservice.php",
        {"lotterySelect" : "caseYears"},
        function(data) {
            
            $("#yearSelect").html('<option value="0">Válasszon ...</option>');       
            //$("<option>").val("0").text("Válasszon ...").appendTo("#yearSelect");     
            for(i=0; i<data.length; i++){
                //$("#orszagselect").append('<option value="'+lista[i].id+'">'+lista[i].nev+'</option>');
                $("<option>").val(data[i]).text(data[i]).appendTo("#yearSelect");
            }
        },
        "json"                                                    
    ).fail((xhr, responseStatus, responseText) => {
        console.log(xhr, responseStatus, responseText);
    });
}


function weeks(){
    const selectedYear = $('#yearSelect').val();
    if(selectedYear !=0){
        $.post(
            "models/webservice.php",
            {"lotterySelect" : "caseWeeks", "selectedYear" : selectedYear},
            function(data) {
                
                $("#weekSelect").html('<option value="0">Válasszon ...</option>');       
                //$("<option>").val("0").text("Válasszon ...").appendTo("#yearSelect");     
                var weeks = data.weeks;
                for(i=0; i<weeks.length; i++)
                    //$("#orszagselect").append('<option value="'+lista[i].id+'">'+lista[i].nev+'</option>');
                    $("<option>").val(weeks[i].id).text(weeks[i].week).appendTo("#weekSelect");
            },
            "json"                                                    
        ).fail((xhr, responseStatus, responseText) => {
            console.log(xhr, responseStatus, responseText);
        });
    }
}

function results(){
    const selectedWeekId = $('#weekSelect').val();
    console.log(selectedWeekId);
    if(selectedWeekId !=0){
        $.post(
            "models/webservice.php",
            {"lotterySelect" : "caseResult", "selectedWeekId" : selectedWeekId},
            function(data) {
                if(data.results == 0){
                    $("#hiddenNumbers").html('<>');
                } else {    
                    $("#resultSelect").html('<option value="0">Válasszon ...</option>');       
                    //$("<option>").val("0").text("Válasszon ...").appendTo("#yearSelect");     
                    var results = data.results;
                    for(i=0; i<results.length; i++)
                        //$("#orszagselect").append('<option value="'+lista[i].id+'">'+lista[i].nev+'</option>');
                        $("<option>").val(results[i].id).text(results[i].result).appendTo("#resultSelect");
                
                   
                }
            },
            "json"                                                    
        ).fail((xhr, responseStatus, responseText) => {
            console.log(xhr, responseStatus, responseText);
        });
    }
}


    


$(document).ready(function() {
    years();
    
    $("#yearSelect").change(weeks);
    $("#weekSelect").change(results);
    /*$("#intezmenyselect").change(intezmeny);
    
    $(".adat").hover(function() {
         $(this).css({"color" : "white", "background-color" : "black"});
     }, function() {
         $(this).css({"color" : "black", "background-color" : "white"});
     }); */
 });