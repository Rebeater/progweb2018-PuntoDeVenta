var itemCounter = 0;

function addProduct(Codigo, Cantidad){
    var cantidad = 1;
    var codigo = "";
    
    if(arguments.length == 0)
    {   
        var input = document.getElementById('txt_Buscador').value.split("*");
        if(input.length > 1) {
            cantidad = input[0];
            codigo = input[1].toUpperCase();
        }
        else{
            codigo = input[0].toUpperCase();
        }
    }else if(arguments.length==2){
        codigo = Codigo;
        cantidad = Cantidad;
    }
    $.ajax(
        {
            type:"POST",
            url: "procesa_productos.php", 
            data: "getDataProducto=true&id="+codigo,
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
             if(result!=""){
                var producto = JSON.parse(result);
                const trow = document.createElement('tr');
                itemCounter = itemCounter+1;
                trow.id = "item"+itemCounter;
                trow.classList.add("rowitem");
                trow.innerHTML =  "<td id='id_row"+itemCounter+"' style='margin-left:1em'><span class='tdCodigo'>"+codigo+"</span></td>"+
                                  "<td id='concepto_row"+itemCounter+"' style='text-align:left'><span>"+producto.concepto+"</span></td>"+
                                  "<td id='cantidad_row"+itemCounter+"' style='margin-left:1em'><span class='tdCantidad'>"+ cantidad +"  <i class='fas fa-plus'></i></span></td>"+
                                  "<td id='precioUnitario_row"+itemCounter+"' style='margin-left:1em'><span>$"+producto.precioUnitario+"</span></td>"+
                                  "<td id='descuento_row"+itemCounter+"' style='margin-left:1em'><span class='tddescuento'>"+producto.descuento+" %</span></td>"+
                                  "<td id='monto_row"+itemCounter+"' style='margin-left:1em'><span>$</span><span class='tdmonto'>"+((producto.precioUnitario * cantidad)-(producto.precioUnitario*cantidad*(producto.descuento/100)))+"</span></td>"+
                                  "<td id='cancelar_row"+itemCounter+"' style='margin-left:1em'><i id='itemcancelar_row"+itemCounter+"' class='fas fa-times' onclick='quitarItem(this)'></i></td>";
                document.getElementById("tbody").appendChild(trow);
                document.getElementById("lbl_totalDinero").innerHTML = calcularTotal().toFixed(2);
                document.getElementById("lbl_totalArticulos").innerHTML = calcularCantArticulos();
                document.getElementById('txt_Buscador').value = "";
                
                document.getElementById('tableContainer').scrollTop = 10000;

            }
            else{
                show_snackbar("Codigo de producto no encontrado", 1500);
            }
            }						
        });		
        
        

}

function quitarItem(item){
    var itemId = item.id.substring(16);
    document.getElementById("item"+itemId).remove();
    document.getElementById("lbl_totalDinero").innerHTML = calcularTotal().toFixed(2);
    document.getElementById("lbl_totalArticulos").innerHTML = calcularCantArticulos();
    
}

function calcularTotal(){
    var total = 0;

    var elementos = document.getElementsByClassName('tdmonto');
    for (i = 0; i < elementos.length; i++){
        total = total + parseFloat(elementos[i].textContent);        
    }
    return total;
}

function calcularCantArticulos(){
    return document.getElementsByClassName('tdmonto').length;
}

function establecerCaja(){
    var caja = document.getElementById("cboxCajas").value;
    $.ajax(
        {
            type:"POST",
            url: "procesa_cajas.php", 
            data: "setCaja=" + caja,
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
                if(result != "error"){
                    $("#PuntoDeVenta").toggleClass("mostrar");
                    document.getElementById("lbl_caja").innerHTML = result;
                    $("#modalCaja").toggleClass("hidden");
                    document.getElementById("txt_Buscador").focus();
                }
                else{
                    show_snackbar("Error al cargar caja.", 3000);
                }
            }						
        });
}

function recuperarItemsVenta(){
        var items = [];
        
        var codigos = document.getElementsByClassName('tdCodigo');
        var cantidades = document.getElementsByClassName('tdCantidad');
        
        for (i = 0; i < codigos.length; i++){
            var item = new Object();
            item.codigo = codigos[i].textContent.toString();
            item.cantidad = parseInt(cantidades[i].textContent.toString());
            items.push(item);            
        }
        
        return items;
}

function registrarVenta(){
    var cliente  = document.getElementById("cbox_cliente").value;
    var vendedor = document.getElementById("lbl_cajero").innerText;
    var total    = document.getElementById("lbl_totalDinero").innerText;1
    
    $.ajax(
        {
            type:"POST",
            url: "procesa_ventas.php", 
            data: "insertarVenta="+"true"+"&cliente="+cliente+"&vendedor="+vendedor+"&total="+total,
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
             if(result!="error"){
                registrarVentas(result);
                reiniciarCampos();
            }
            else{
                show_snackbar("Venta no registrada", 3000);
            }
            }						
        });
}

function registrarVentas(idVenta){
    var items = recuperarItemsVenta();
    for (let i = 0; i < items.length; i++) {
        $.ajax(
            {
                type:"POST",
                url: "procesa_ventas.php", 
                data: "insertarVentas="+"true"+"&idVenta="+idVenta+"&idProducto="+items[i].codigo+"&cantidad="+items[i].cantidad,
                contentType: "application/x-www-form-urlencoded",
                success: function(result){
                if(result!="error"){
                }
                else{
                    show_snackbar("Venta no registrada", 3000);
                }
                }						
            });
    }
}

function reiniciarCampos(){
    document.getElementById("tbody").innerHTML = "";
    document.getElementById("lbl_totalArticulos").innerHTML = "0";
    document.getElementById("lbl_totalDinero").innerHTML = "0";
    document.getElementById("cbox_cliente").value = "1";
    
    itemCounter = 0;
}

function onKeyDownHandler(event) {
    event.preventDefault();
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Trigger the button element with a click
        $('#btnBuscar').trigger('click');     
  }  
}

function paginaCargada(){
    createCboxClientes();
    $.ajax(
        {
            type:"POST",
            url: "procesa_cajas.php", 
            data: "validaCajaActiva=" + "true",
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
                if(result != "error"){
                    if(result == ""){
                    }
                    else{
                        $("#PuntoDeVenta").toggleClass("mostrar");
                        document.getElementById("lbl_caja").innerHTML = result;
                        $("#modalCaja").toggleClass("hidden");
                        document.getElementById("txt_Buscador").focus();
                        recuperarVenta();
                    }
                }
                else{
                    show_snackbar("Error al cargar caja.", 3000);
                }
            }						
        });        
    iniciarReloj();
    
}

var days = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
var months = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
function iniciarReloj(){
    var today = new Date();
    var d = today.getDate();
    var nameDay = days[today.getDay()-1];
    var month = months[today.getMonth()-1];
    var year = today.getFullYear();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    
    m = checkTime(m);
    s = checkTime(s);
                                                    //Domingo 22 de Diciembre del 2018 12:22 PM 
    document.getElementById('datetime').innerHTML = nameDay + " " + d + " de " + month + " del " + year + "   " + h + ":" + m + ":" + s;
    var t = setTimeout(iniciarReloj, 500);
}

function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

function paginaClose(){
    var itemsJSON = JSON.stringify(recuperarItemsVenta());
    var cliente = document.getElementById('cbox_cliente').value;
        
    
    $.ajax({
        async:false,
        type:"POST",
        url: "procesa_ventas.php", 
        data: "cliente="+cliente.toString()+ "&guardarVenta=" + itemsJSON,
        contentType: "application/x-www-form-urlencoded",
        success: function(result){
            if(result != "error"){
                if(result != ""){
                }
            }
            else{
                show_snackbar("", 3000);
            }
        }						
    });        
    
}

function recuperarVenta(){
    $.ajax(
        {
            type:"POST",
            url: "procesa_ventas.php", 
            data: "recuperarVenta=" + "true",
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
                if(result != "error"){
                    if(result != "venta no definida" && result != ""){
                        var items = JSON.parse(result);
                        for (let i = 0; i < items.length; i++) {
                            addProduct(items[i]["codigo"], items[i]["cantidad"]);
                        }
                        recuperarCliente();
                    }
                }
                else{
                    show_snackbar("", 3000);
                }
            }						
        });        
}

function recuperarCliente(){
    

    $.ajax(
        {
            type:"POST",
            url: "procesa_ventas.php", 
            data: "getVentaGuardadaClient=" + "true",
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
                if(result != "error"){
                    if(result != "no definida" && result != ""){
                        document.getElementById('cbox_cliente').value = result;
                    }
                }
                else{
                    show_snackbar("", 3000);
                }
            }						
        }); 
}

function createCboxClientes(){

    const cboxUsuario = document.getElementById('cbox_cliente');
    $.ajax(
        {
            type:"POST",
            url: "procesa_clientes.php", 
            data: "getListJSON=" + "true",
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
                if(result != ""){
                    const clientes = JSON.parse(result);
                    for (let i = 0; i < clientes.length; i++) {
                        var element = document.createElement('option')
                        element.id = clientes[i]['id'];
                        element.textContent = clientes[i]['nombre'];
                        element.value = clientes[i]['id'];
                        cboxUsuario.appendChild(element);
                    }
                }
                else{
                    show_snackbar("No se pudo recuperar la lista de clientes o no existe ninguno.", 3000);
                }
            }						
        });   
    








/*
    const v = '<div> Buscar Cliente </div>';
    const menu = document.appendChild(v);
    //menu.textContent = "Buscar Cliente";
    document.body.appendChild();

    menu.style.padding = '1em';
    menu.style.background = '#eee';
    menu.style.position = 'fixed';
    menu.style.top = '$(e.pageX)px';
    menu.style.left = '$(e.pageX)px';*/
}



/*
 $.ajax(
        {
            type:"POST",
            url: "procesa_cajas.php", 
            data: "validaCajaActiva=" + "true",
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
                if(result != "error"){
                    if(result != ""){
                    }
                }
                else{
                    show_snackbar("", 3000);
                }
            }						
        });        
*/

