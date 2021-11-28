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


function weaks(){
    $.post(
        "models/webservice.php",
        {"lotterySelect" : "caseWeaks"},
        function(data) {
            
            $("#weakSelect").html('<option value="0">Válasszon ...</option>');       
            //$("<option>").val("0").text("Válasszon ...").appendTo("#yearSelect");     
            var years = data.years;
            for(i=0; i<years.length; i++)
                //$("#orszagselect").append('<option value="'+lista[i].id+'">'+lista[i].nev+'</option>');
                $("<option>").val(years[i].id).text(years[i].year+" - "+years[i].week+".hét ").appendTo("#weakSelect");
        },
        "json"                                                    
    ).fail((xhr, responseStatus, responseText) => {
        console.log(xhr, responseStatus, responseText);
    });
}


    


$(document).ready(function() {
    years();
    
    //$("#yearSelect").change(varosok);
    /* $("#varosselect").change(intezmenyek);
    $("#intezmenyselect").change(intezmeny);
    
    $(".adat").hover(function() {
         $(this).css({"color" : "white", "background-color" : "black"});
     }, function() {
         $(this).css({"color" : "black", "background-color" : "white"});
     }); */
 });