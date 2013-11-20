<html>
    <head>
        <?php echo $this->StaticContent->js(array('/test.js', '/test/test.js', 'test'), 'http://konalen.dev' ,false); ?>
        <?php echo $this->StaticContent->css(array('/css1.css', '/cake.generic.css'), 'http://konalen.dev' ,false); ?>
    </head>
    <body>
        
        <button id="b0">Holas</button>
        <?php echo $this->StaticContent->image('cake.icon.png', 'http://konalen.dev' ,false); ?>
        <?php echo $this->StaticContent->file(array('test_1.txt', 'test.txt'), 'http://konalen.dev' ,false, array('title_link'=>'Descarga', 'download'=>true, 'name' => 'descarga')); ?>
        <?php echo $this->StaticContent->file('test_1.txt', 'http://konalen.dev' ,false, array('title_link'=>'Descarga', 'download'=>true, 'name' => 'descarga')); ?>
    </body>
    
    
</html>

