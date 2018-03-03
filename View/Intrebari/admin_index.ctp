<?php echo $this->Html->link(__('<span data-icon="&#x50;"></span> Adauga o intrebare'), array('action' => 'add'), array('escape' => false)); ?>
          <p></p>

<div class="row">

        <header class="panel-heading">
                
        </header>
        <?php if($intrebari) { ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <th><?=$this->Paginator->sort('id', '#')?></th>


                    <th><span data-icon="&#x74;"></span> Intrebare</th>
                    <th><span data-icon="&#x2a;"></span> Categorie</th>

                    <th><i class="icon_cogs"></i> Actiuni</th>
                </tr>

             <?php

             foreach ($intrebari as $respondent) {
                 ?>
            <td><?php echo $respondent['Intrebare']['id']; ?></td>
          <td><?php echo $respondent['Intrebare']['intrebare']; ?></td>
            <td><?php echo $respondent['CategorieIntrebare']['nume']; ?></td>
            <td>
                <div class="btn-group">
                    <?php echo $this->Html->link(__('<span data-icon="&#x6b;"></span> Modifica'), array('action' => 'edit', $respondent['Intrebare']['id']), array('escape' => false, 'data-original-title' => 'Modifica', 'data-placement' => 'top', 'data-toggle' => 'tooltip', 'class' => 'tooltips')); ?>

                </div>
            </td>
            </tr>

             <?php } ?>
        </table>
          <?php }  // end if $intrebari?>

  s
  <ul class="pagination pagination-lg">
	<?php
		echo $this->Paginator->prev('Inapoi', array('tag' => 'li', 'disabledTag' => 'a'), null, array('class' => 'prev disabled', 'currentTag' =>'a'));
		echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentTag' =>'a'));
		echo $this->Paginator->next(__('Inainte') , array('tag' => 'li', 'disabledTag' => 'a'), null, array('class' => 'next disabled', 'currentTag' =>'a'));
	?>
   </ul>
</div>
