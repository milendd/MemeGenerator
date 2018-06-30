$(function() {
    var $canvas = $('#create-canvas');
    var canvas = $canvas[0];
    var originalWidth = 600.0;

    $('.template-select').click(function () {
        var source = $(this).attr('src');
        var ctx = canvas.getContext("2d");

        var img = new Image();
        img.onload = function() {
            canvas.width = this.width;
            canvas.height = this.height;

            var ratio = this.width / originalWidth;
            var resultWidth = this.width;
            var resultHeight = this.height;
            if (ratio > 1) {
                resultWidth = this.width / ratio;
                resultHeight = this.height / ratio;
            }
            
            var bigImageRatio = resultHeight - 500;
            if (bigImageRatio > 0) {
                var newRatio = bigImageRatio / 100;
                if (newRatio > 1) {
                    resultHeight /= (1 + newRatio / 5);
                    resultWidth /= (1 + newRatio / 5);
                } 
            }

            $canvas.css('width', resultWidth + 'px');
            $canvas.css('height', resultHeight + 'px');

            ctx.drawImage(this, 0, 0, this.width, this.height, 0, 0, canvas.width, canvas.height);
        };

        img.src = source;
    });
});
