<template>
  <div>
    <canvas 
        id="canvasBlackboard" 
        @mousedown="empezarDibujo"
        @mousemove="drawOnCanvas" 
        @mouseup="stopDraw"
        @touchstart="empezarDibujo"
        @touchmove="drawOnCanvas"
        @touchend="stopDraw">
    </canvas>
    <div v-if="viewElements" class="text-center">
        <b-row class="col-md-6 elementsPizarra">
            <b-col>
                <b-button @click="backMouse" :disabled="mouse" >
                    <i class="fa fa-mouse-pointer"></i>
                </b-button>
            </b-col>
            <b-col>
                <b-button @click="beginDraw" :disabled="pencil">
                    <i class="fa fa-pencil"></i>
                </b-button>
            </b-col>
            <b-col>
                <b-button @click="deleteEnd" :disabled="mouse">
                    <i class="fa fa-eraser"></i>
                </b-button>
            </b-col>
            <b-col>
                <input type="color" v-model="color" :disabled="mouse" >
            </b-col>
            <b-col>
                <b-form-select class="grosor-linea" v-model="selected" :options="options" :disabled="mouse"></b-form-select>
            </b-col>
        </b-row>
    </div> 
  </div>
</template>

<script>
let miCanvas
let contenido
let ctx
let lineas = []
let correccionX = 0
let correccionY = 0
let pintarLinea = false
let posicion
export default {
  name: 'BlackboardComponent',
  data () {
    return {
        pencil: false,
        mouse: true,
        color: '#E60026',
        selected: 5,
        options: [
            { value: 5, text: '5' },
            { value: 10, text: '10' },
            { value: 15, text: '15' },
        ],
        viewElements: false
    }
  },
  created: function(){
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            this.viewElements = false;
        } else { this.viewElements = true; }
  },
  methods: {
    backMouse () {
        contenido = document.getElementById('book')
        miCanvas = document.getElementById('canvasBlackboard')
        this.pencil = false
        this.mouse = true
        this.sizeCanvas(0, 0)
        miCanvas.style.zIndex = 1
        contenido.style.zIndex = 2
    },
    deleteEnd () {
        ctx.clearRect(0, 0, miCanvas.width, miCanvas.height)
    },
    beginDraw () {
        contenido = document.getElementById('book')
        miCanvas = document.getElementById('canvasBlackboard')
        posicion = miCanvas.getBoundingClientRect()
        correccionX = posicion.x
        correccionY = posicion.y
        this.sizeCanvas(contenido.clientWidth - 200, contenido.clientHeight)
        contenido.style.zIndex = 1
        miCanvas.style.zIndex = 2

        this.mouse = false
        this.pencil = true
    },
    sizeCanvas (clientWidth, clientHeight) {
        miCanvas.width = clientWidth;
        miCanvas.height = clientHeight;
        miCanvas.style.width = clientWidth + 'px';
        miCanvas.style.height = clientHeight + 'px';
        miCanvas.style.left = 130 + 'px';
        miCanvas.style.top = 60 + 'px';
    },
    empezarDibujo () {
        if (this.pencil == true) {
            pintarLinea = true;
            lineas = []
            lineas.push([])
        }
    },
    drawOnCanvas (event) {
        event.preventDefault()
        if (pintarLinea) {
            ctx = miCanvas.getContext('2d')
            // Estilos de linea
            ctx.lineJoin = ctx.lineCap = 'round'
            // Marca el nuevo punto
            let nuevaPosicionX = 0
            let nuevaPosicionY = 0
            if (event.changedTouches === undefined) {
                // Versión ratón
                nuevaPosicionX = event.layerX
                nuevaPosicionY = event.layerY
            } else {
                // Versión touch, pantalla tactil
                nuevaPosicionX = event.changedTouches[0].pageX - correccionX
                nuevaPosicionY = event.changedTouches[0].pageY - correccionY
                //  - 730 en Y
            }
            // Guarda la linea
            lineas[lineas.length - 1].push({
                x: nuevaPosicionX,
                y: nuevaPosicionY,
                color: this.color,
                size: this.selected
                // transparency: 0.1
            });
            // Redibuja todas las lineas guardadas
            ctx.beginPath()
            lineas.forEach(function (segmento) {
                ctx.moveTo(segmento[0].x, segmento[0].y)
                segmento.forEach(function (punto, index) {
                    ctx.lineWidth = punto.size
                    ctx.strokeStyle = punto.color
                    ctx.lineTo(punto.x, punto.y)
                    
                });
            });
            ctx.stroke()
        }
    },
    stopDraw () {
        pintarLinea = false
    }
  }
}
</script>
