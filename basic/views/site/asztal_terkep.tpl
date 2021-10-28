<div id="terkep" class="w-100 h-100">
</div>
<script>
    /*var width = window.innerWidth;
    var height = window.innerHeight;*/
    var szamlalo = 1;
    var width = document.getElementById("terkep").scrollWidth;
    //var height = document.getElementById("terkep").scrollHeight;
    var height = window.innerHeight;
    console.log(width,height)
    var stage = new Konva.Stage({
        container: 'terkep',
        width: width,
        height: height,
    });

    var layer = new Konva.Layer();


    var rect2 = new Konva.Rect({
        x: 10,
        y: 10,
        width: 100,
        height: 50,
        fill: 'white',
        shadowBlur: 10,
        cornerRadius: 10,
        draggable: false,
    });

    var simpleText = new Konva.Text({
        x: 20,
        y: 25,
        text: 'Simple Text',
        fontSize: 15,
        fontFamily: 'Calibri',
        fill: 'green',
    });


  /*  var group = new Konva.Group({
        x: 0,
        y: 0,
    });*/
    rect2.on('mousedown', function () {
      //  rect2.draggable(true);
        var rect = new Konva.Rect({
            x: 50,
            y: 50,
            width: 100,
            height: 50,
            fill: 'white',
            shadowBlur: 10,
            cornerRadius: 10,
            draggable: true,
        });
        rect.on('dragend', function () {
            var k = rect.position();
            k['id'] = rect._id;
            console.log(k);
            $.ajax({
                type: "POST",
                data: k,
                url : "/site/menteskordinata",
                success : function(result) {
                }
            });

        });
       // group.add(rect);
        layer.add(rect);

    });
    // layer.add(group);



    /*group.on('dragend', function () {
        console.log(group.dr)
        console.log(group.position());
        var k = rect2.position()
        $.ajax({
            type: "POST",
            data: k,
            url : "/site/menteskordinata",
            success : function(result) {
                alert('siker');
            }
                });

    });*/

    layer.add(rect2);
    layer.add(simpleText);

    // add the layer to the stage
    stage.add(layer);
</script>