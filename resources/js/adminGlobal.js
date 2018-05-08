$(document).ready(function() {

    $('#modal_delete').on('show.bs.modal', function(e) {
        $("#deleteButton").click(function(){
            var stala = "Usun/";
            var idU = $(e.relatedTarget).attr('value');
            var sciezka = $(e.relatedTarget).data('href');
            $.ajax({
                type: "GET",
                dataType: "html",
                url: sciezka+stala+idU,
                success: function(html){
                    var tutaj = $("#data").empty();
                    var elementy = $(html).find('#item');

                    $.each( elementy, function( key, value ) {
                        var content = $(elementy[key]).html();
                        var element = '<div id="showing" class="row">' + content + '</div>'
                        tutaj.append(element);
                    });

                    $("#message").text("Udało się usunąć.");
                },
                error: function(blad){
                    console.log(blad);
                }
            });
            $("#modal_delete").modal('hide');
        });
    });
});