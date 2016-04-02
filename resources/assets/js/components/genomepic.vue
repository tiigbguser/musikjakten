<style>

  polygon {
      fill: #42b983;
      opacity: .75;
  }

  circle {
      fill: transparent;
      stroke: #999;
  }
</style>

<template>
  <svg width="200" height="200">
  <defs>
    <filter id="darkify">
      <feBlend mode="multiply">
    </filter>
  </defs>
  <g>
    <!-- <polygon :points="points"></polygon> -->

    <!-- <path style="fill-rule:evenodd; fill-opacity:0.5; fill:deeppink;"  :d="path"></path> -->

    <template v-for="subgene in segmentedGenome">
      <geneshape :index="$index" :subgene="subgene"></geneshape>
    </template>
    <!-- <path v-for="gene in genome" filter="url(#darkify)" style=" fill-rule:evenodd;
                  fill-opacity:0.5;
                  fill:#{{Math.floor(Math.random() * (99 - 10)) + 10}}{{Math.floor(Math.random() * (99 - 10)) + 10}}{{Math.floor(Math.random() * (99 - 10)) + 10}};
                  transform: scale({{gene,gene}})"
    d="M{{Math.floor(gene*50)}},{{Math.floor(gene*50)}}
    a10,10 0 0,1 10,-10 
    h100 
    a10,10 0 0,1 10,10 
    v100 
    a10,10 0 0,1 -10,10 
    h-100 
    a10,10 0 0,1 -10,-10 z

    m10,10 
    a10,10 0 0,1 10,-10 
    h80 
    a10,10 0 0,1 10,10 
    v80 
    a10,10 0 0,1 -10,10 
    h-80 
    a10,10 0 0,1 -10,-10 z"/> -->
<!-- 
    <p v-for="gene in genome"> {{color(gene)}} </p> -->

    <circle cx="100" cy="100" r="80"></circle>
  </g>
  </svg>
</template>

<script>
  import * as actions from '../vuex/actions'
  module.exports = {
    props: ['genome', 'isActive'], 
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
      color(gene){

        return rgbToHex(floatToRGB(gene, 0.5));
      },
    },
    computed: {
      segmentedGenome(){
        const CHUNKSIZE = Math.floor(this.genome.genome.length/3)+1;
        var segmentedArray = [];
        var j = 0;
        for(var i = 0; i < this.genome.genome.length; i+= CHUNKSIZE){
          // this.$log(i);
          // console.log("inside loop: " + i);
          // segmentedArray[j] = this.genome.slice(i, i+CHUNKSIZE);
          segmentedArray[j] = this.genome.genome.slice(i, i+CHUNKSIZE);
          j++;
        }
        // console.log(segmentedArray);
        return segmentedArray;
      },
      // points() {
      //   var total = this.genome.length;
      //   return this.genome.map(function (value, i) {
      //     var point = valueToPoint(value, i, total)
      //     return point.x + ',' + point.y
      //   }).join(' ')
      // },
      // path(){
      //   var total = this.genome.length;
      //   var pathstring = "M" + pointToString(valueToPoint(this.genome[0], 0, total));
      //   pathstring += " C" + pointToString(valueToPoint(this.genome[1], 1, total)) + " " + pointToString(valueToPoint(this.genome[1], 1, total)) + " " + pointToString(valueToPoint(this.genome[2], 2, total));
      //   for(var i = 3; i+1 < this.genome.length; i+=2){
      //     pathstring += "S" + pointToString(valueToPoint(this.genome[i], i, total)) + " " + pointToString(valueToPoint(this.genome[i+1], i+1, total));
      //   }
      //   pathstring += "z";
      //   return pathstring;
      // }
    },
    ready: function(){
    },
    components: {
      'geneshape' : require('./geneshape.vue')
    }
  }

  // function floatToRGB(f, brightness){
  //   var wheelPos = f * 255;
  //   var rgb = [0,0,0];
  //   if(wheelPos < 85) {
  //     rgb[0] = Math.floor((255 - wheelPos * 3)*brightness);
  //     rgb[2] = Math.floor((wheelPos * 3)*brightness);
  //   }else if(wheelPos < 170) {
  //     wheelPos -= 85;
  //     rgb[1] = Math.floor((wheelPos * 3)*brightness);
  //     rgb[2] = Math.floor((255 - wheelPos * 3)*brightness);
  //   }else {
  //     wheelPos -= 170;
  //     rgb[0] = Math.floor((wheelPos * 3)*brightness);
  //     rgb[1] = Math.floor((255 - wheelPos * 3)*brightness);
  //   }
  //   return rgb;
  // }

  // function componentToHex(c) {
  //   var hex = c.toString(16);
  //   return hex.length == 1 ? "0" + hex : hex;
  // }

  // function rgbToHex(rgb) {
  //   return "#" + componentToHex(rgb[0]) + componentToHex(rgb[1]) + componentToHex(rgb[2]);
  // }

  // function pointToString(point){
  //   return point.x + "," + point.y;
  // }

  // math helper...
  // function valueToPoint (value, index, total) {
  //   var scale = 50 + value*100 * 0.3
  //   var angle = (Math.PI * 2 / total) * index
  //   var cos   = Math.cos(angle)
  //   var sin   = Math.sin(angle)
  //   var tx    = scale * sin + 100
  //   var ty    = scale * cos + 100
  //   return {
  //     x: tx,
  //     y: ty
  //   }
  // }

  // function valueToPoint (value, index, total) {
  //   var x     = 0
  //   var y     = -value*100 * 0.8
  //   var angle = Math.PI * 2 / total * index
  //   var cos   = Math.cos(angle)
  //   var sin   = Math.sin(angle)
  //   var tx    = x * cos - y * sin + 100
  //   var ty    = x * sin + y * cos + 100
  //   return {
  //     x: tx,
  //     y: ty
  //   }
  // }


</script>