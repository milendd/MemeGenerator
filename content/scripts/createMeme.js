$(function() {
    var canvas = $('#create-canvas')[0];

    $('.template-select').click(function () {
        var source = $(this).attr('src');
        var ctx = canvas.getContext("2d");
        var img = new Image();
        img.onload = function() {
            ctx.drawImage(this, 0, 0, 1000, 1000);
        };

        img.src = source;
    });
});
