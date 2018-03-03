
               <h5 <?=$intrebare['Intrebare']['intrebare']?></h5>
               <div class="form-group">

       <?php

echo $this->Form->select('Varianta.valoare.'.$intrebare['Intrebare']['id'], array(1 => 'Da', 'Nu'), array('multiple' => 'checkbox'));

 ?>

                   </div>
