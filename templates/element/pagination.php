<?php
    $this->Paginator->setTemplates([
        'number' => '<li class="page-item" style="border: none;"><a class="page-link link-primary bg-dark" style=" color: white; border: none;" href="{{url}}">{{text}}</a></li>',
        'nextActive' => '<li class="page-item"><a style=" color: white; border: none" class="page-link bg-dark" href="{{url}}"><span aria-hidden="true">&rsaquo;</span></a></li>',
        'nextDisabled' => '<li class="page-item bg-dark"><a style=" color: white; border: none" class="page-link bg-dark" href="{{url}}"><span style="border: none;" aria-hidden="true">&rsaquo;</span></a></li>',
        'prevActive' => '<li class="page-item bg-dark"><a style=" color: white; border: none" class="page-link bg-dark" href="{{url}}"> <span aria-hidden="true">&lsaquo;</span></a></li>',
        'prevDisabled' => '<li class="page-item bg-dark"><a style=" color: white; border: none" class="page-link bg-dark" href="{{url}}"> <span aria-hidden="true">&lsaquo;</span></a></li>',
        'first' => '<li class="page-item bg-dark"><a style="color: white; border: none" class="page-link bg-dark" href="{{url}}"><span aria-hidden="true">&laquo;</span></a></li>',
        'last' => '<li class="page-item bg-dark"><a style="color: white; border: none" class="page-link bg-dark" href="{{url}}"><span aria-hidden="true">&raquo;</span></a></li>',
        'current' => '<li class="page-item bg-dark"><a style="color: white; font-weight:bold; border: none" class="page-link bg-dark" href="{{url}}">{{text}}</a></li>',
    ]);
    $result = $this->Paginator->getTemplates('number');
    ?>
<ul class="pagination">
    <?= $this->Paginator->first('<< ' . __('first')) ?>
    <?= $this->Paginator->prev('< ' . __('previous')) ?>
    <?= $this->Paginator->numbers()?>
    <?= $this->Paginator->next(__('next') . ' >') ?>
    <?= $this->Paginator->last(__('last') . ' >>') ?>
</ul>