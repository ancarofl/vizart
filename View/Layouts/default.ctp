<!DOCTYPE html>
<html>
<head>
   <?php echo $this->Html->css('vizart'); ?>
   <?php
echo $this->Html->script('jquery-3.3.1.min');
echo $this->Html->script('jquery.i18n.min');
echo $this->Html->script('vizart');
   ?>
 
</head>

<body>
<div id="va-outer-app-wrapper">
<div id="va-app-wrapper">

  <div id="va-header-wrapper">
    <div id="va-header">
      Muzeul Judeţean de Artă <br> &lt&lt Centrul Artistic Baia Mare &gt&gt
    </div>
  </div>
          <?php echo $this->Flash->render(); ?>

      <?php echo $this->fetch('content'); ?>

</body>
</html>



<?php echo $this->element('sql_dump'); ?>