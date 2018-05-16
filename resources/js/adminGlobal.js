$(document).ready(function() {

    $('#modal_delete').on('show.bs.modal', function(e) {
        $("#deleteButton").click(function(){
            var constant = "Usun/";
            var id = $(e.relatedTarget).attr('value');
            var url = $(e.relatedTarget).data('href');
            $.ajax({
                type: "GET",
                dataType: "html",
                url: url+constant+id,
                success: function(html){
                    var data = $("#data").empty();
                    var items = $(html).find('#item');

                    $.each( items, function( key, value ) {
                        var content = $(items[key]).html();
                        var item = '<div id="item" class="row">' + content + '</div><hr/>'
                        data.append(item);
                    });

                    if (($("#message").length > 0)){
                        $("#messageText").text("Udało się usunąć.");
                    }
                    else{
                        $("#errorAndMessage").append(''+
                            '<div id="message" class="text-center alert alert-info" role="alert">\n' +
                            '    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>\n' +
                            '    <span class="sr-only">Info:</span>\n' +
                            '    <strong id="messageText">Udało się usunąć.</strong>\n' +
                            '</div>'+
                        '');
                    }
                },
                error: function(error){
                    console.log(error);
                }
            });
            $("#modal_delete").modal('hide');
        });
    });

});