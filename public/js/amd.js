jQuery(function ()
{
    $('body').on('click touch', '.show-movie', function ()
    {
        var id = $(this).data('id');

        var request = jQuery.ajax({
            url: "/get-movie",
            type: "get",
            data:{'id':id},
            dataType: "json",
            success : function (result) {
                var genre = '';
                for(x in result.genres){
                    genre += result.genres[x]['name']+', ';
                }
                $("#movie-more-title").html(result.title);
                $("#movie-more-overview").html(result.overview);
                $("#movie-more-release-date").html(result.release_date);
                $("#movie-more-genre").html(genre.slice(0, -2));
                $('.show-poster').attr('src','https://image.tmdb.org/t/p/original/'+result.poster_path);
                $("#movie-more").modal('show');
            }
        });
    });

    $('body').on('click', '.favourite, .favourite-set', function ()
    {
        var id = $(this).data('id');

        var request = jQuery.ajax({
            url: "/set-favourite",
            type: "get",
            data:{'id':id},
            dataType: "json",
            success : function (result) {
                if(result.update){
                    $("#"+id).removeClass('favourite');
                    $("#"+id).addClass('favourite-set');
                    $("#favourite-result-msg").html('Added to your favourites');
                    $("#favourite-result").toast({ delay: 3000 });
                    $("#favourite-result").toast('show');
                }
                else{
                    $("#"+id).removeClass('favourite-set');
                    $("#"+id).addClass('favourite');
                    $("#favourite-result-msg").html('Removed from your favourites');
                    $("#favourite-result").toast({ delay: 3000 });
                    $("#favourite-result").toast('show');
                }
            }
        });
    });

    $('body').on('submit', '#form-contact-us', function (event)
    {
        $("#alert-error").hide('slow');
        $("#alert-success").hide('slow');
        event.preventDefault();
        var formData = $("#form-contact-us").serialize();

        var request = jQuery.ajax({
            url: "/contact-us",
            type: "post",
            data:formData,
            dataType: "json",
            success : function (result) {
                if(result.result == true){
                    $("#alert-success").show('slow');
                }
                else{
                    $("#alert-error").show('slow');
                }
            }
        });
    });
});