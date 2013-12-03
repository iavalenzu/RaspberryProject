(function(){

function remove(element){
    element.parentElement.removeChild(element);
}

function getFromHtml(html){
    /*Crea un elemento contenedor, para luego fijar su html interno*/
    var container = document.createElement('div');
    container.innerHTML = html;
    /*Retorna el hijo que representa al html en el DOM*/
    return container.childNodes[1];
}


/*Se obtienen los scripts que se han cargado hasta el momento, resulta que el ultimo corresponde al actual.*/
var scripts = document.getElementsByTagName('script');
var thiscript = scripts[ scripts.length-1 ];


/*Se verifica que vengan definidos los parametros*/
/*Si no viene definido algun parametro, borramos el script y retornamos un error.*/
<?php if(!isset($allowed_url) || !isset($html) || !isset($js) || !isset($css)): ?>
    remove(thiscript);
    throw new Error("Missing Parameters!!");
<?php endif; ?>


<?php $allowed_url = parse_url($allowed_url); ?>


/*Si no esta definido el host, la url no viene en el formato correcto por lo tanto removemos el script y retornamos un error*/
<?php if(!isset($allowed_url['host'])): ?>
    remove(thiscript);
    throw new Error("");
<?php endif; ?>


/*Si no coinciden los hosts removemos el script y lanzamos un error*/
if(window.location.host !== '<?php echo $allowed_url['host']; ?>'){
    remove(thiscript);
    throw new Error("No coinciden los hosts!!!");
}


/*Se obtiene un nuevo elemento del html y se inserta sobre el script*/
var new_element = getFromHtml('<?php if(isset($html)) echo $html; ?>');
thiscript.parentElement.insertBefore(new_element, thiscript);


/*Se agrega el codigo JS*/
<?php if(isset($js)) echo $js; ?>


/*Se obtiene el HEAD del documento para insertar los scripts necesarios*/    
var head = document.getElementsByTagName('head')[0];


/*Crea un nuevo elemento que incluye el CSS de la caja de login*/
var new_style = document.createElement('style');
new_style.innerHTML = '<?php if(isset($css)) echo $css; ?>';
new_style.type = "text/css";


/*Se agrega al HEAD el nuevo estilo*/
head.appendChild(new_style);


/*Se elimina el script*/
remove(thiscript);
    
})();