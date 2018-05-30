var paisesJSON;

$( document ).ready(function() {
    recuperarPaises();

    $('#cbx_pais').change(function(){
        i= 0;
        pais="";
        paisSelected = document.getElementById('cbx_pais').value;
        while (pais=="") {
            if(paisSelected == paisesJSON[i].name){
             pais = paisesJSON[i];
             document.getElementById('txt_telefonoCode').value = pais.callingCodes   ;
            }
            i++;
        }
            
    });

    $('#txt_cp').blur(function(){
        if(document.getElementById('cbx_pais').value == "Mexico"){
        var cp = document.getElementById('txt_cp').value;
        fetch("https://api-codigos-postales.herokuapp.com/v2/codigo_postal/"+cp)
        .then((respuesta)=>{
            return respuesta.json();
        }).then((respuesta)=>{
            if(respuesta.municipio !="" && respuesta.estado != ""){
                document.getElementById('txt_ciudad').value = respuesta.municipio;
                document.getElementById('txt_estado').value = respuesta.estado;
            }
            else{
                show_snackbar("No se encuentra codigo postal");
            }
        }) 
    }

    });
    

});


function recuperarPaises(){
    fetch("https://restcountries.eu/rest/v2/all?fields=name;callingCodes")
    .then((respuesta)=>{
        return respuesta.json();
    }).then((respuesta)=>{
        armarCboxPaises(respuesta);
    })   
}

function armarCboxPaises(paises){
    paisesJSON = paises;
    var inner= "<option value=''>País</option>";
    for (let i = 0; i < paises.length; i++) {
        inner += "<option id='"+ paises[i].name +"' value='"+paises[i].name+"'>"+ paises[i].name + "</option>";
        
    }
    document.getElementById("cbx_pais").innerHTML = inner;
    loadData();
    
}

function loadData(){
    //objeto de prueba
     var result2 = '{ "companyName":"Electronics" ,'+
                       ' "pais":"Mexico" ,'+
                       ' "cp":"2305" ,'+
                       ' "ciudad":"La Pah" ,'+
                       ' "estado":"BCS" ,'+
                       ' "domicilio":"Rosaura Zapata" ,'+
                       ' "telefonoCode":"52" ,'+
                       ' "telefono":"61215451" ,'+
                       ' "correo":"correo@gmai.com" ,'+
                       ' "correoSoporte":"correoSuppor@gmail.com" ,'+
                       ' "passSoporte":"contrasena" ,'+
                       ' "img":"img/131-logo-steren.png" ,'+
                       ' "descripcion":"Electrónica Steren es una empresa Mexicana que fue fundada en la Ciudad de México en 1956 que se dedica a comercializar bienes electrónicos, de computación y tecnología. Tiene más de 360 tiendas distribuidas en México, Costa Rica, República Dominicana, Guatemala, Colombia y Estados Unidos, y una oficina de control de calidad en Shanghai, China."}';
        
                      
    $.ajax(
        {
            type:"POST",
            url: "procesa_ajustes.php", 
            data: "loadData=" + "true",
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
                var ajustes = JSON.parse(result2);
                $('#companyName').val(ajustes.companyName);
                $('#cbx_pais').val(ajustes.pais);
                $('#txt_cp').val(ajustes.cp);
                $('#txt_ciudad').val(ajustes.ciudad);
                $('#txt_estado').val(ajustes.estado);
                $('#txt_domicilio').val(ajustes.domicilio);
                $('#txt_telefonoCode').val(ajustes.telefonoCode);
                $('#txt_telefono').val(ajustes.telefono);
                $('#txt_correo').val(ajustes.correo);
                $('#txt_correoSoporte').val(ajustes.correoSoporte);
                $('#txt_passCorreoSoporte').val(ajustes.passSoporte);
                $('#logo').attr("src",ajustes.img);
                $('#logo').val(ajustes.img);
                $('#txt_Descripcion').val(ajustes.descripcion);
            }						
        });		
}


function saveData(){
    var companyName       = $('#companyName').val();
    var pais              = $('#cbx_pais').val();
    var cp                = $('#txt_cp').val();
    var ciudad            = $('#txt_ciudad').val();
    var estado            = $('#txt_estado').val();
    var domicilio         = $('#txt_domicilio').val();
    var telefonoCode      = $('#txt_telefonoCode').val();
    var telefono          = $('#txt_telefono').val();
    var correo            = $('#txt_correo').val();
    var correoSoporte     = $('#txt_correoSoporte').val();
    var passCorreoSoporte = $('#txt_passCorreoSoporte').val();
    var descripcion       = $('#txt_Descripcion').val();
    var img               = $('#logo').val();

    obj = { "companyName":      companyName, 
            "pais":             pais,         
            "cp":               cp,           
            "ciudad":           ciudad,       
            "estado":           estado,       
            "domicilio":        domicilio,    
            "telefonoCode":     telefonoCode, 
            "telefono":         telefono,     
            "correo":           correo,       
            "correoSoporte":    correoSoporte,
            "passCorreoSoporte":passCorreoSoporte, 
            "img":              img,
            "descripcion":      descripcion };
    var ajustesJSON = JSON.stringify(obj);

    $.ajax(
        {
            type:"POST",
            url: "procesa_ajustes.php", 
            data: "saveData=" + "true" + "&ajustesJSON=" + ajustesJSON,
            contentType: "application/x-www-form-urlencoded",
            success: function(result){
                    show_snackbar(result)
            }						
        });		


    
}