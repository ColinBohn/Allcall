$( document ).ready(
    function() {
        updateLabels();
        setInterval(updateLabels, 15000);
    }
);

function updateLabels(){
    $( "[data-node]" ).each(
        function() {
            url = "/nodes/" + $(this).attr("data-node") + "/status";
            $.ajax({
                url: url,
                dataType: 'json',
                context: this,
                complete: function(data) {
                    
                    if ($.parseJSON(data.responseText) === "Invalid Key") {
                        $(this).find( "[type=checkbox]" )
                        .bootstrapToggle('disable');

                        $(this).find( ".label" )
                        .html("Invalid Key")
                        .removeClass("label-default")
                        .removeClass("label-success")
                        .addClass("label-warning")   
                    }                     
                    
                    else if (data.responseText != "false") {  
                        $(this).find( "[type=checkbox]" )
                        .bootstrapToggle('enable');
                        
                        $(this).find( ".label" )
                        .html($.parseJSON(data.responseText))
                        .removeClass("label-default")
                        .removeClass("label-danger")
                        .addClass("label-success")
                    }
                    
                    else {
                        $(this).find( "[type=checkbox]" )
                        .bootstrapToggle('disable');

                        $(this).find( ".label" )
                        .html("Offline")
                        .removeClass("label-default")
                        .removeClass("label-success")
                        .addClass("label-danger")
                    }
                }
            });
        }
    );
}
//# sourceMappingURL=broadcast.js.map
