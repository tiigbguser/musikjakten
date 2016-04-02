<style>

</style>

<template>
    <path :id="shape" filter="url(#darkify)" style="fill-rule:evenodd;
                  fill-opacity:0.3;
                  fill:{{color}};
                  "
    :d="path"> </path>

</template>

<!-- transform: scale({{(1+3-this.index)*0.25}})
transform-origin: 100px 100px; -->

<script>

  import * as actions from '../vuex/actions'
  module.exports = {
    props: ['subgene', 'index'],
    data: function () {
      return {
      }
    },
    vuex: {
      getters: {

      },
      actions
    },
    methods: {
    },
    computed: {
      sizeMultiplier(){
        return (3-this.index)*0.33;
        // return 1;
      },
      path(){
        var total = this.subgene.length;
        var pathstring = "M" + pointToString(valueToPoint(this.subgene[0]*this.sizeMultiplier, 0, total));
        pathstring += " C" + pointToString(valueToPoint(this.subgene[1]*this.sizeMultiplier, 1, total)) + " " + pointToString(valueToPoint(this.subgene[1]*this.sizeMultiplier, 1, total)) + " " + pointToString(valueToPoint(this.subgene[2]*this.sizeMultiplier, 2, total));
        for(var i = 3; i+1 < this.subgene.length; i+=2){
          pathstring += "S" + pointToString(valueToPoint(this.subgene[i]*this.sizeMultiplier, i, total)) + " " + pointToString(valueToPoint(this.subgene[i+1]*this.sizeMultiplier, i+1, total));
        }
        pathstring += "z";
        return pathstring;
      },
      color(){
        // var color;
        if(this.index < 1)
          return "#985110";
        else if(this.index < 2)
          return "#352759";
        else if(this.index < 3)
          return "#851140";
        else if(this.index < 4)
          return "#832365";
        else if(this.index < 5)
          return "#661078";
        else
          return rgbToHex(floatToRGB(Math.random()));
        // return rgbToHex(floatToRGB(this.subgene[0], 1));
      }
    },
    ready: function(){

      // console.log("myIndex is " + this.index);
      // $(document).ready(function() {
        // TweenLite.set(this.$el,{transformOrigin:50%,50%});
        // console.log("ready in shape was called");
        TweenMax.to(this.$el, 0.6, {
          scale:1.1,
          transformOrigin:"50% 50%",
          repeat:-1, 
          yoyo:true, 
          delay:(this.index*0.15),
          ease: Power1.easeInOut
        });
      // });
    }
  }

  function floatToRGB(f, brightness){
    var wheelPos = f * 255;
    var rgb = [0,0,0];
    if(wheelPos < 85) {
      rgb[0] = Math.floor((255 - wheelPos * 3)*brightness);
      rgb[2] = Math.floor((wheelPos * 3)*brightness);
    }else if(wheelPos < 170) {
      wheelPos -= 85;
      rgb[1] = Math.floor((wheelPos * 3)*brightness);
      rgb[2] = Math.floor((255 - wheelPos * 3)*brightness);
    }else {
      wheelPos -= 170;
      rgb[0] = Math.floor((wheelPos * 3)*brightness);
      rgb[1] = Math.floor((255 - wheelPos * 3)*brightness);
    }
    return rgb;
  }

  function componentToHex(c) {
    var hex = c.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
  }

  function rgbToHex(rgb) {
    return "#" + componentToHex(rgb[0]) + componentToHex(rgb[1]) + componentToHex(rgb[2]);
  }

   function pointToString(point){
    return point.x + "," + point.y;
  }

  // math helper...
  function valueToPoint (value, index, total) {
    var scale = 20 + value*100 * 0.6;
    var angle = (Math.PI * 2 / total) * index
    var cos   = Math.cos(angle)
    var sin   = Math.sin(angle)
    var tx    = scale * sin + 100
    var ty    = scale * cos + 100
    return {
      x: tx,
      y: ty
    }
  }


</script>