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
                document.getElementById("companyName").value = ajustes.companyName;
                document.getElementById("cbx_pais").value = ajustes.pais;
                document.getElementById("txt_cp").value = ajustes.cp;
                document.getElementById("txt_ciudad").value = ajustes.ciudad;
                document.getElementById("txt_estado").value = ajustes.estado;
                document.getElementById("txt_domicilio").value = ajustes.domicilio;
                document.getElementById("txt_telefonoCode").value = ajustes.telefonoCode;
                document.getElementById("txt_telefono").value = ajustes.telefono;
                document.getElementById("txt_correo").value = ajustes.correo;
                document.getElementById("txt_correoSoporte").value = ajustes.correoSoporte;
                document.getElementById("txt_passCorreoSoporte").value = ajustes.passSoporte;
                document.getElementById("logo").src = ajustes.img;
                document.getElementById("logo").value = ajustes.img;
                document.getElementById("txt_Descripcion").value = ajustes.descripcion;
            }						
        });		
}


function saveData(){
    var companyName = document.getElementById("companyName").value;
    var pais = document.getElementById("cbx_pais").value;
    var cp = document.getElementById("txt_cp").value;
    var ciudad = document.getElementById("txt_ciudad").value;
    var estado = document.getElementById("txt_estado").value;
    var domicilio= document.getElementById("txt_domicilio").value;
    var telefonoCode= document.getElementById("txt_telefonoCode").value;
    var telefono= document.getElementById("txt_telefono").value;
    var correo = document.getElementById("txt_correo").value;
    var correoSoporte = document.getElementById("txt_correoSoporte").value;
    var passCorreoSoporte = document.getElementById("txt_passCorreoSoporte").value;
    var descripcion = document.getElementById("txt_Descripcion").value;
    var img = document.getElementById("logo").value;

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