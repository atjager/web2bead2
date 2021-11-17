function years() {
    $.post(
        "models/webservice.php",
        {"lotterySelect" : "caseYears"},
        function(data) {
            $("#yearSelect").html('<option value="0">Válasszon ...</option>');       
            //$("<option>").val("0").text("Válasszon ...").appendTo("#yearSelect");     
            var years = data.years;
            for(i=0; i<years.length; i++)
                //$("#orszagselect").append('<option value="'+lista[i].id+'">'+lista[i].nev+'</option>');
                $("<option>").val(years[i].id).text(years[i].year , years[i].week).appendTo("#yearSelect");
        },
        "json"                                                    
    );
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