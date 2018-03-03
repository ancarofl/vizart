<div class="row">
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                Adauga o intrebare
            </header>
            <div class="panel-body">
                              <?php echo $this->Form->create('Intrebare', array('class' => 'form-horizontal')); ?>
                                   <?php
		echo $this->Form->input('intrebare', array('class' => 'form-control')); 
		echo $this->Form->input('categorie_intrebare_id', array('class' => 'form-control', 'options' => $categorii_intrebari, 'empty' => true, 'label' => 'Tip intrebare')); ?>
<div class="col-lg-6">
        <?php
		echo $this->Form->input('type', array('class' => 'form-control ', 'label' => 'Tip raspunsuri', 'options' => array('regular' => 'Specifice', 'da-nu' => 'Da, Nu', 'da-nu-poate' => 'Da, Nu, Poate', '1-5' => 'Acord-Dezacord in 5 trepte', 'text' => 'Text', 'number' => 'Numeric', 'textarea' => 'Text Area'))); ?>

    </div>
    <div class="col-lg-3">
        <?php
		echo $this->Form->input('max_raspunsuri_posibile', array('class' => 'form-control ', 'label' => 'Numar maxim de raspunsuri *', 'value' => 1));
	?>
</div>

        <div class="row">
            <div class="col-lg-6">
        <?php
        echo $this->Form->input('has_other', array( 'label' => 'Permite raspuns liber', 'type' => 'checkbox'));
        ?><span class="help-block">Genereaza caseta de "Altul"</span></div>
        <div class="col-lg-6">
        <?php
        echo $this->Form->input('has_none', array( 'label' => 'Permite nici un raspuns', 'type' => 'checkbox'));
        ?><span class="help-block">Genereaza caseta de "Niciunul"</span></div>
        </div>
                <div class="form-group">
                    <div class="col-sm-12">
                                 <?php 
echo $this->Form->end( array('class' => 'btn btn-primary', 'label' => 'Salveaza', 'div' => false)); ?>

<span class="help-block">* Valoarea 0 inseamna ca se pot bifa toate optiunile</span>
                    </div>
                </div>
            </div>
        </section>
    </div>
   </div>

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">

            </header>
            <div class="panel-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">


                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">

                    </div>
                </div>
        </section>
    </div>
</div>
