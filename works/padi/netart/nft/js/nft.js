

let sketch = function(p) {
    let content = '<:TEXT_CONTENT/>';
    let imgWidth = 720, imgHeight = 400;

    p.setup = function() {
        p.createCanvas(imgWidth, imgHeight);
        p.noLoop();
    }


    p.draw = function() {
        p.background(0); 

        for (var i = 0, y = 0; y < imgHeight; y++) {
            for (var x = 0; x < imgWidth; x++, i+=3) {
                var r = content.charCodeAt(i % content.length);
                var g = content.charCodeAt((i+1) % content.length);
                var b = content.charCodeAt((i+2) % content.length);
                p.stroke(
                    p.map(r, 97, 122, 0, 0xff),
                    p.map(g, 97, 122, 0, 0xff),
                    p.map(b, 97, 122, 0, 0xff)
                );
                p.strokeWeight(10); 
                p.point(x, y);
            }
            
        }
    }

};

$(document).ready(function () {
    new p5(sketch, 'resultContainer');
});

