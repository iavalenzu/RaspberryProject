    
/*Se obtienen los scripts que se han cargado hasta el momento, resulta que el ultimo corresponde al actual.*/

var scripts = document.getElementsByTagName('script');
var thiscript = scripts[ scripts.length-1 ];


/*Se obtiene el HEAD del documento para insertar los scripts necesarios*/    

var head = document.getElementsByTagName('head')[0];

var new_script = document.createElement('script');
new_script.src = '<?php echo $this->StaticContent->js(array('mootools-core-1.4.5-full-compat-yc.js', 'mootools-more-1.4.0.1.js'), 'http://konalen.dev', true); ?>';
new_script.type = 'text/javascript';
new_script.onload = function(){

    /*Se agrega el codigo que se desea ejecutar luego que se carge el javascript*/


    /*Antes de ocupar las librerias cargadas, se debe verificar que esten cargadas*/
    if(MooTools){

        var content = Elements.from('<?php if(isset($html)) echo $html; ?>');

        /*Se obtiene el script y se inserta a continuacion el nuevo elemento con el formulario de login*/
        content.inject(thiscript, 'before');
        
        
        /*Se agrega el codigo JS*/
        <?php if(isset($js)) echo $js; ?>

    }

    /*Se elimina el script*/
    thiscript.destroy(); 

};

/*Crea un nuevo elemento que incluye el CSS de la caja de login*/
var new_style = document.createElement('style');
new_style.innerHTML = '<?php if(isset($css)) echo $css; ?>';
new_style.type = "text/css";

/*Se agrega al HEAD el script creado y el nuevo estilo*/
head.appendChild(new_script);
head.appendChild(new_style);

/*Eliminamos el script*/
head.removeChild(new_script);
    
