<?php $this->widget('zii.widgets.grid.CGridView',array(
    'id'=>'loaning-book-detail-grid',
    'itemsCssClass' => 'table table-bordered table-responsive table-nomargin',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        array(
            'header'=>'No',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
        array(
            'name' => 'code',
            'value' => '$data->geToLinkBook()',
            'type'=>'raw',
        ),
        'qty',
        'description',
        array(
            'name'=>'status',
            'value'=>'$data->getStatusWithStyle($data->status)',
            'type'=>'raw',
        ),
        array(
            'name'=>'created_at',
            'value'=>'Lib::datetime($data->created_at)',
            'type'=>'raw',
        ),
        array(
            'class'=>'CButtonColumn',
            'htmlOptions'=>array('style'=>'width:115px; text-align:center;'),
            'template'=>'',//'{update}',
             'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
            'buttons'=>array(
                'update' => array(
                    'label'=>'<i class="fa fa-pencil-square-o"></i>',
                    'imageUrl'=>false,
                    //'buttonUrl' => '#',
                    'options'=>array( 'class'=>'btn btn-blue btn-sm', 'title'=>'Update'),
                ),
            ),
        ),
    ),
    'pager' => array(
        'maxButtonCount'=>8,
        'header' => false,
        'prevPageLabel' => 'Previous',
        'nextPageLabel' => 'Next',
        'firstPageLabel'=>'First',
        'lastPageLabel'=>'Last',
    ),
)); ?>