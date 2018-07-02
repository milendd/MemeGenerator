$(function() {
    var $canvas = $('#create-canvas');
    var canvas = $canvas[0];
    window.context = canvas.getContext("2d");
    var originalWidth = 600.0;
    window.imgSource = "";
    window.img = new Image();
    window.positionsObj = {};
    window.positions = [];

    // TODO: remove
    window.showPositionsObj = function () {
        console.log(positionsObj);
    };

    window.showPositions = function () {
        console.log(positions);
    };

    var createInputsFromPositions = function(obj) {
        positions = obj.data;
        for (var i = 0; i < positions.length; i++) {
            var name = positions[i].text;
            var t = $("<input type='text' class='custom-input positions-input' placeholder='" + name + "' name='text_" + i  + "' />");
            $('.positions-container').append(t);
        }

        attachListeners();
    };

    window.reloadCanvas = function () {
        context.clearRect(0, 0, canvas.width, canvas.height);
        img.src = imgSource;

        img.onload = function () {
            context.drawImage(img, 0, 0, this.width, this.height, 0, 0, canvas.width, canvas.height);

            var inputs = $('.positions-input');
            for (var i = 0; i < inputs.length; i++) {
                var input = $(inputs[i]);
                var key = input.attr('name');
                var value = input.val();
                setPosition(key, value);
    
                var index = parseInt(key.substr(5)); // Removes 'text_'
                var currentPosition = positions[index];
                var x = currentPosition.x;
                var y = currentPosition.y;
    
                context.fillStyle = 'white';
                context.strokeStyle = 'black';
                context.lineWidth = 2;
                context.font = 'bold 36px Arial';
                context.fillText(value, x, y);
                context.strokeText(value, x, y);
            }
        };
    };

    $('.template-select').click(function () {
        imgSource = $(this).attr('src');
        clearPositions();

        $('.positions-container').html('');
        var positions = $(this).siblings('.template-positions').val();
        if (positions) {
            var objPositions = JSON.parse(positions);
            createInputsFromPositions(objPositions);
        }

        img = new Image();
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

            context.drawImage(img, 0, 0, img.width, img.height, 0, 0, canvas.width, canvas.height);
        };

        img.src = imgSource;
    });

    var attachListeners = function () {
        $('.positions-input').keyup(function (e) {
            reloadCanvas();
        });
    };
    
    var clearPositions = function () {
        positionsObj = {};
        positions = [];
    };

    var setPosition = function (key, value) {
        positionsObj[key] = value;
    };
});
