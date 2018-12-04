const Home = { template: '<div>This is Home</div>' }
const Foo = { template: '<div>This is productos</div>' }
const Bar = { template: '<div>This is toma muestras</div>' }

const router = new VueRouter({
    mode: 'history',
    base: "webAliver",
    routes: [
      { path: '/', name: 'home', component: Home},
      { path: '/pages/productos.html', name: 'consultas', component: Foo },
      { path: '/pages/tomaMuestra.html', name: 'toma de muestras', component: Bar }
    ]
  })

const app = new Vue({
    router,
    el: '#app',
    data: {
        productos: '',
        jsonProductos: [],
        productosHTML: '',
        busqueda: '',
        drawer: null,
            items: [
                { title: 'Página principal', icon: 'dashboard', url: '/'},
                { title: 'Consultas', icon: 'favorite_border', url: '/pages/Consultas.html' },
                { title: 'Toma de muestras', icon: 'invert_colors', url: '/pages/tomaMuestra.html' }
            ]   
        
    },
    mounted() {
        //this.getProducts(),
        this.getProductsAsJSON("/webaliver/server/loadProductosJSON.php?accion=*")
    },
    methods: {
        getProducts() {
            axios.get('/webaliver/server/loadProducts.php')
                .then(articulos => {
                    //console.log(articulos)
                    //this.setMessages(res)
                    this.productos = articulos.data;
                }).catch(function (error) {
                    console.log(error);
                });
        },
        getProductsAsJSON(accion) {
            axios.get(accion)
                .then(articulos => {
                    this.jsonProductos = articulos.data;
                    console.log(this.jsonProductos.Medicamento);
                    this.getProductsAsHtml();
                }).catch(function (error) {
                    console.log(error);
                });
        },
        getProductsAsHtml() {
            var articulos = "";
            console.log(this.jsonProductos.Medicamento.length == 0)
            if (this.jsonProductos.Medicamento.length == 0) {
                articulos = "<article class='box2' style='width:50%'><p>Lo sentimos. Por el momento no contamos con ese medicamento.<br>Tambien puede intentar buscar con otro nombre o la formula del anterior para obtener mejores resultados</br></p></article>";
            } else {
                var Meds = this.jsonProductos.Medicamento;
                Meds.forEach(function (e) {
                    articulos += "<article class='box2'><img src='./img/" +
                        e.idMedicamento + ".jpg'><h1>" +
                        e.nom_comercial + "</h1><p><precio>" +
                        e.precio_publico + "</precio><br>" +
                        e.descripcion + "</p><button class='today'>Comprar ahora</button><button class='tomorrow'>Ordena para ma&ntildeana</button></article>"
                });
            }
            this.productosHTML = articulos;
        },
        submitSearch: function name(params) {
            var ejec = "/webaliver/server/loadProductosJSON.php?accion=" + this.busqueda;
            //alert(ejec)
            this.getProductsAsJSON(ejec);
        },
        onClickDrawer(item){
            if(item){

            }
        }
        
    }
});
