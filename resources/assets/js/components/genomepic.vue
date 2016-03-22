<style>

	polygon {
	    fill: #42b983;
	    opacity: .75;
	}

	circle {
	    fill: transparent;
	    stroke: #999;
	}

	text {
	    font-family: Helvetica Neue, Arial, sans-serif;
	    font-size: 10px;
	    fill: #666;
	}


	#raw {
	    position: absolute;
	    top: 0;
	    left: 300px;
	}
</style>

<template>
	<svg width="200" height="200">
	<g>
    <polygon :points="points"></polygon>
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
    computed: {
      points() {
        var total = this.genome.length
        return this.genome.map(function (value, i) {
          var point = valueToPoint(value, i, total)
          return point.x + ',' + point.y
        }).join(' ')
      }
    },
    ready: function(){
    }
  }

  // math helper...
	function valueToPoint (value, index, total) {
	  var x     = 0
	  var y     = -value*100 * 0.8
	  var angle = Math.PI * 2 / total * index
	  var cos   = Math.cos(angle)
	  var sin   = Math.sin(angle)
	  var tx    = x * cos - y * sin + 100
	  var ty    = x * sin + y * cos + 100
	  return {
	    x: tx,
	    y: ty
	  }
	}


</script>