var itemCounter = 0;
function addProduct(value){
    
    var cantidad = 1;
    var codigo = "";
    var input = document.getElementById('txt_Buscador').value.split("*");
    if(input.length > 1) {
        cantidad = input[0];
        codigo = input[1].toUpperCase();
    }
    else{
        codigo = input[0].toUpperCase();
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
                trow.innerHTML =  "<td id='id_row"+itemCounter+"' style='margin-left:1em'><span>"+codigo+"</span></td>"+
                                  "<td id='concepto_row"+itemCounter+"' style='text-align:left'><span>"+producto.concepto+"</span></td>"+
                                  "<td id='cantidad_row"+itemCounter+"' style='margin-left:1em'><span>"+ cantidad +"  <i class='fas fa-plus'></i></span></td>"+
                                  "<td id='precioUnitario_row"+itemCounter+"' style='margin-left:1em'><span>$"+producto.precioUnitario+"</span></td>"+
                                  "<td id='monto_row"+itemCounter+"' style='margin-left:1em'><span>$</span><span class='tdmonto'>"+(producto.precioUnitario * cantidad)+"</span></td>"+
                                  "<td id='cancelar_row"+itemCounter+"' style='margin-left:1em'><i id='itemcancelar_row"+itemCounter+"' class='fas fa-times' onclick='quitarItem(this)'></i></td>";
                document.getElementById("tbody").appendChild(trow);
                document.getElementById("lbl_totalDinero").innerHTML = calcularTotal().toFixed(2);
                document.getElementById("lbl_totalArticulos").innerHTML = calcularCantArticulos();
                document.getElementById('txt_Buscador').value = "";

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
    alert(caja);
    
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
                }
                else{
                    show_snackbar("Error al cargar caja.", 3000);
                }
            }						
        });
}