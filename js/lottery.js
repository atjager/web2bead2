class Lottery{
    constructor(){}

    years() {
        $.post(
            "models/webservice.php",
            {"lotterySelect" : "caseYears"},
            function(data) {
                var i=0;
                $("#yearSelect").html('<option value="0">Válasszon ...</option>');          
                for(i=0; i<data.length; i++){
                    $("<option>").val(data[i]).text(data[i]).appendTo("#yearSelect");
                }
            },
            "json"                                                    
        ).fail((xhr, responseStatus, responseText) => {
            console.log(xhr, responseStatus, responseText);
        });
    }


    weeks(){
        $('#weekSelect').html("");
        $('#resultSelect').html("");
        $('#hiddenNumber').html("");
        $('#hiddenData').html("");
        $("#resultSelect").prop('disabled', false);
        const selectedYear = $('#yearSelect').val();
        if(selectedYear !=0){
            $.post(
                "models/webservice.php",
                {"lotterySelect" : "caseWeeks", "selectedYear" : selectedYear},
                function(data) {
                    
                    $("#weekSelect").html('<option value="0">Válasszon ...</option>');        
                    var i=0;  
                    var weeks = data.weeks;
                    for(i=0; i<weeks.length; i++)
                        $("<option>").val(weeks[i].id).text(weeks[i].week).appendTo("#weekSelect");
                },
                "json"                                                    
            ).fail((xhr, responseStatus, responseText) => {
                console.log(xhr, responseStatus, responseText);
            });
        }
    }

    results(){
        $('#resultSelect').html("");
        $('#hiddenNumber').html("");
        $('#hiddenData').html("");
        $("#resultSelect").prop('disabled', false);
        const selectedWeekId = $('#weekSelect').val();
        console.log(selectedWeekId);
        if(selectedWeekId !=0){
            $.post(
                "models/webservice.php",
                {"lotterySelect" : "caseResult", "selectedWeekId" : selectedWeekId},
                function(data) {
                    var i=0;
                    if(data.results == 0){
                        $.post(
                            "models/webservice.php",
                            {"lotterySelect" : "numberResult", "selectedWeekId" : selectedWeekId},
                            function(noResultdata) {
                                $("#resultSelect").prop('disabled', 'disabled');
                                $("#hiddenNumber").append("<br> <p> We doesn't no the results of this week! </p> <br>");        
                                $("#hiddenNumber").append("<p> But the winner numbers was: </p><br>");      
                                for(i=0; i<noResultdata.length; i++)
                                    $("#hiddenNumber").append("<strong> " + noResultdata[i] + " </strong>");
                                    
                            },
                            "json"   
                        );
                    } else {    
                        $("#resultSelect").html('<option value="0">Válasszon ...</option>');       
                        var results = data.results;
                        var i=0;
                        for(i=0; i<results.length; i++)
                            $("<option>").val(results[i].id).text(results[i].result).appendTo("#resultSelect");
                    }
                },
                "json"                                                    
            ).fail((xhr, responseStatus, responseText) => {
                console.log(xhr, responseStatus, responseText);
            });
        }
    }

    showResult(){
        $('#hiddenData').html("");
        $('#hiddenNumber').html("");
        const selectedWeekId = $('#weekSelect').val();
        const selectedResult = $('#resultSelect').val();
        if(selectedWeekId!=0 && selectedResult!=0){
            $.post(
                "models/webservice.php",
                {"lotterySelect" : "caseShowResult", "selectedWeekId" : selectedWeekId, "selectedResult" : selectedResult},
                function(data) {  
                    $("#hiddenNumber").append('<br> <p>The winner numbers was: </p>');       
                    let szam = data.szam;
                    var i=0;
                    for(i=0; i<szam.length; i++)
                        $("#hiddenNumber").append('<strong>'+ szam[i] +' </strong> ');
                    let darab = data.darab;
                    let ertek = data.ertek;
                    let talalat = data.talalat;
                    
                    $("#hiddenData").append('<br> <p>It was <strong>'+ darab 
                        +'</strong> draw that match <strong>'+ talalat
                        +'</strong> <br> The prize was: <strong>'+ertek+' Huf </strong> </p>'); 
                },
                "json"                                                    
            ).fail((xhr, responseStatus, responseText) => {
                console.log(xhr, responseStatus, responseText);
            });
        }
    }
}

    


$(document).ready(function() {
    let lottery = new Lottery;
    lottery.years();
    
    $("#yearSelect").change(lottery.weeks);
    $("#weekSelect").change(lottery.results);
    $("#resultSelect").change(lottery.showResult);
    
 });