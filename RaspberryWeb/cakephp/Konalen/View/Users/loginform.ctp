<?php if (isset($partner_form)): ?>

    <?php
    $session_expire = $partner_form['PartnerForm']['session_expire'];
    $session_id = $partner_form['PartnerForm']['session_id'];
    $data = $partner_form['PartnerForm']['data'];

    $captcha = isset($data['captcha']) ? true : false;
    $email = isset($data['fields']['email']['value']) ? $data['fields']['email']['value'] : '';

    $timeout_millis = (strtotime($session_expire) - time()) * 1000;

    ?>
    
    /*Se obtienen los scripts que se han cargado hasta el momento, resulta que el ultimo corresponde al actual.*/
    
    var scripts = document.getElementsByTagName('script');
    var thiscript = scripts[ scripts.length-1 ];

    
    
    /*Se obtiene el head del documento para insertar los scripts necesarios*/    
    
    var head = document.getElementsByTagName('head')[0];

    var new_script = document.createElement('script');
    new_script.src = '<?php echo $this->StaticContent->js(array('mootools-core-1.4.5-full-compat-yc.js', 'mootools-more-1.4.0.1.js'), 'http://konalen.dev', true); ?>';
    new_script.type = 'text/javascript';
    new_script.onload = function(){
    
        /*Se agrega el codigo que se desea ejecutar luego que se carge el javascript*/

        /*Antes de ocupar las librerias cargadas, se debe verificar que esten cargadas*/

        //console.log();
        
    <?php 
    
        $box = $this->element('login1/box');
        
        $box = preg_replace('/<!--(.*)-->/Uis', '', $box);
        $box = preg_replace("/'/", '"', $box);
        $box = preg_replace("/\s+/", " ", $box);
    
    ?>        
        
        var content = Elements.from('<?php echo $box; ?>');

        //Se obtiene el script y se inserta a continuacion el nuevo elemento con el formulario de login
        content.inject(thiscript, 'before');

        //Se elimina el script
        thiscript.destroy(); 
        
    };

    <?php 
    
        $css = $this->element('login1/css');
        
        $css = preg_replace("/'/", '"', $css);
        $css = preg_replace("/\s+/", " ", $css);
    
    ?>            
    
    
    var new_style = document.createElement('style');
    new_style.innerHTML = '<?php echo $css; ?>';
    new_style.type = "text/css";
    
    
    head.appendChild(new_script);
    head.appendChild(new_style);

    /*Eliminamos el script*/
    head.removeChild(new_script);
    
<?php endif; ?>