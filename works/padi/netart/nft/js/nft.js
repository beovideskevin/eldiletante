

let sketch = function(p) {
    let content = '<:TEXT_CONTENT/>';

    let w = $("#resultContainer").width();
    let h = w / 0.666;

    console.log(w);
    console.log(h);

    let imgWidth = w, imgHeight = h;

    p.setup = function() {
        p.createCanvas(imgWidth, imgHeight);
        p.noLoop();
    }


    p.draw = function() {
        p.background(0); 

        for (var i = 0, y = 0; y < imgHeight; y+=10) {
            for (var x = 0; x < imgWidth; x+=10, i+=3) {
                var r = content.charCodeAt(i % content.length);
                var g = content.charCodeAt((i+1) % content.length);
                var b = content.charCodeAt((i+2) % content.length);
                p.stroke(
                    p.map(r, 97, 122, 0, 0xff),
                    p.map(g, 97, 122, 0, 0xff),
                    p.map(b, 97, 122, 0, 0xff)
                );
                p.strokeWeight(10); 
                p.point(x+5, y+5);
            }
            
        }
    }

};

$(document).ready(function () {
  new p5(sketch, 'resultContainer');
});

