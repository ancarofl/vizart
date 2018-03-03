
               <h3> <?=$intrebare['Intrebare']['intrebare']?></h3>
               <div class="form-group">

       <?php

echo $this->Form->select('Varianta.valoare.'.$intrebare['Intrebare']['id'], array(1 => 'De acord', 'Partial de acord', 'Neutru', 'Partial impotriva', 'Total impotriva'), array('multiple' => 'checkbox'));
  echo $this->Form->input('Varianta.motivatie.'.$intrebare['Intrebare']['id'], array('class' => 'form-control', 'label' => 'Motivul atasat'));

 ?>

                   </div>
