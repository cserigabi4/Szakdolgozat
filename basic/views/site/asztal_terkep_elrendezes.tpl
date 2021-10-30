<div id="vue_asztal_terkep">
<div class="shadow-lg border rounded shadow-lg p-3 mb-5 bg-white w-25 text-center">
    <div class="form-group">
        <label>Név:</label>
        <input class="form-control" type="text" value="" id="nev">
        <label>Szélesség:</label>
        <input class="form-control" type="number" value="100" id="x">
        <label>Magasság:</label>
        <input class="form-control" type="number" value="50" id="y">
    <button class="btn btn-dark" onclick="felvesz()"> Felvesz </button>
    </div>
</div>
<div id="outerContainer">
    <div id="container">
        {if $asztalok}
            {foreach $asztalok as $asztal}
                <div id="{$asztal['nev']}" class="shadow-lg bg-white rounded align-self-baseline mx-auto text-center" style="width: 100px;height: 50px; position: absolute; top: 100px; left:300px;">
                    <p>{$asztal['nev']}</p>
                </div>
            {/foreach}
        {/if}
    </div>
</div>
</div>
<script type="text/javascript">
    class Rect {
        constructor(active, dragItem, nev, x = null, y = null) {
            this.active = active;
            this.currentX = x;
            this.currentY = y;
            this.xOffset = x;
            this.yOffset = y;
            this._dragItem = dragItem;
            this._nev = nev;
            this.initialX = x;
            this.initialY = y;
        }

        get nev() {
            return this._nev;
        }

        set nev(value) {
            this._nev = value;
        }

        get dragItem() {
            return this._dragItem;
        }

        dragStart(e) {
            if (e.type === "touchstart") {
                this.initialX = e.touches[0].clientX - this.xOffset;
                this.initialY = e.touches[0].clientY -  this.yOffset;
            } else {
                this.initialX = e.clientX -  this.xOffset;
                this.initialY = e.clientY -  this.yOffset;
            }
            this.active = true;

        }
         dragEnd(e) {
            this.initialX =  this.currentX;
            this.initialY =  this.currentY;

             var t = this.dragItem.getBoundingClientRect();
             var formData = new FormData();

             formData.append('x', this.initialX);
             formData.append('y', this.initialY);
             formData.append('nev', this.nev);

             var request = new XMLHttpRequest();
             request.open("POST", "/site/menteskordinata");
             request.send(formData);

            this.active = false;
        }

         drag(e) {
            if (this.active) {

                e.preventDefault();

                if (e.type === "touchmove") {
                    this.currentX = e.touches[0].clientX -  this.initialX;
                    this.currentY = e.touches[0].clientY -  this.initialY;
                } else {
                    this.currentX = e.clientX -  this.initialX;
                    this.currentY = e.clientY -  this.initialY;
                }

                this.xOffset =  this.currentX;
                this.yOffset =  this.currentY;

                this.setTranslate( this.currentX,  this.currentY, this.dragItem);
            }
        }

        setTranslate(xPos, yPos, el) {
            el.style.transform = "translate3d(" + xPos + "px, " + yPos + "px, 0)";
        }

    }

    var rects = [];

    {if $asztalok}
    {foreach $asztalok as $asztal}
        var d = document.querySelector("#{$asztal['nev']}");
        var r = new Rect(false,d,'{$asztal['nev']}',{$asztal['x']},{$asztal['y']});
        r.setTranslate({$asztal['x']},{$asztal['y']}, d)
        rects.push(r);
        console.log(rects);
    {/foreach}
    {/if}

    var container = document.querySelector("#container");

    container.addEventListener("mousedown", dragStart, false);
    container.addEventListener("mouseup", dragEnd, false);
    container.addEventListener("mousemove", drag, false);

    function dragStart(e) {
        for ( rect of rects) {
            if (e.target === rect.dragItem) {
                rect.dragStart(e)
            }
        }
    }
    function dragEnd(e) {
        for ( rect of rects) {
            if (e.target === rect.dragItem) {
                rect.dragEnd(e)
            }
        }
    }
    function drag(e) {
        for ( rect of rects) {
            if (e.target === rect.dragItem) {
                rect.drag(e)
            }
        }
    }


    function felvesz(){
       var nev = document.getElementById('nev').value;
       var x = document.getElementById('x').value;
       var y = document.getElementById('y').value;

       var div = document.createElement("div");
       div.innerHTML = "<p class='' >"+ nev +"</p>";
       div.className = 'asztal ui-widget-content shadow-lg bg-white rounded align-self-baseline text-center';
       div.style.width = x +'px';
       div.style.height = y +'px';
       div.style.position = 'absolute';
       div.style.top =  '100px';
       div.style.left = '300px';
       div.id = nev;

       $('#container').append(div);

        var rect = new Rect(false,div,nev);
        rects.push(rect);
    }
</script>
