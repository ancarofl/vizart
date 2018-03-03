<?php echo $this->Form->create('Raspuns', array('class' => 'form-horizontal', 'url' => 'salveaza_raspunsuri/'.$this->request->data['Intrebare']['id'],)); ?>
                              <?php
                              $key = 0;
                             // pr($this->request->data['Raspuns']);
                              if($this->request->data['Raspuns']) {
                              foreach($this->request->data['Raspuns'] as $key => $raspuns) {
                                $traduceri = array();
                                foreach($raspuns['RaspunsuriTraduceri'] as $traducere) {
                                  if(isset($traducere['translation'])) {
                                    $traduceri[$traducere['language_id']] = $traducere['translation'];
                                  }
                                }

                               ?>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-1 control-label"></label>
                        <div class="col-lg-10">
                            <?=$this->Form->input("Raspuns.$key.raspuns", array('value' => $raspuns['raspuns'], 'class' => 'form-control', 'label' => false, 'div' => false))?>
                            <?=$this->Form->input("Raspuns.$key.id", array('value' => $raspuns['id']))?>
                            <?php
                            foreach($languages as $languageId => $language) {
                     echo $this->Form->input('RaspunsuriTraduceri.'.$raspuns['id'].'.'.$languageId, array('class' => 'form-control', 'placeholder' => 'In limba '.$language, 'label' => false, 'value' => (isset($traduceri[$languageId]))?$traduceri[$languageId]:''));
                }
                  ?>
                            
                        </div>
                       
                      
                        
                        <label for="inputEmail1" class="col-lg-3 control-label">
                           <a href='<?=$this->Html->url(array('controller' => 'raspunsuri', 'action' => 'moveup',$raspuns['id'] ))?>' data-icon="&#x21;">Sus</a>
                            <a href='<?=$this->Html->url(array('controller' => 'raspunsuri', 'action' => 'movedown',$raspuns['id'] ))?>' data-icon="&#x22;">Jos</a>
                            <a href='<?=$this->Html->url(array('controller' => 'raspunsuri', 'action' => 'sterge',$raspuns['id'] ))?>' data-icon="&#x51;" onclick='return confirm("Sunteti sigur ca doriti sa stergeti raspunsul #<?=$raspuns['raspuns']?>?")'>Sterge</a>
                        </label>
                    </div>
                              <?php  } } $key++;           ?>

                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-1 control-label"><span data-icon="&#x50;"></span></label>
                        <div class="col-lg-8">
                            <?=$this->Form->input("Raspuns.$key.raspuns", array('value' => '', 'class' => 'form-control', 'label' => false, 'div' => false))?>
                            <?=$this->Form->input("Raspuns.$key.ordine", array('value' => $key+1, 'class' => 'form-control', 'label' => false, 'div' => false, 'type' => 'hidden'))?>
                           
                        </div>
                       
                       
                      
                    </div>
                   <?php echo $this->Form->end( array('class' => 'btn btn-primary', 'label' => 'Salveaza', 'div' => false));  ?>