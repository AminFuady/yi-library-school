<?php
    /* @var $this DashboardController */
    $this->breadcrumbs=array(
            'Dashboard',
    );
    $this->pageTitle = "Dashboard";
?>

<div class="row">
    <div class="col-sm-12">
        <h3>Buku</h3>
        <ul class="tiles">
            <li class="blue long">
                <a href="<?php echo Yii::app()->createUrl('book/create') ?>">
                    <span><i class="glyphicon-book_open"></i></span><span class="name">Data Buku</span>
                </a>
            </li>
            <li class="lime long">
                <a href="<?php echo Yii::app()->createUrl('book/import') ?>">
                    <span><i class="glyphicon-import"></i></span><span class="name">Import Data Buku</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="col-sm-12">
        <h3>Transaksi</h3>
        <ul class="tiles">
            <li class="blue long">
                <a href="<?php echo Yii::app()->createUrl('loaningBook/create') ?>">
                    <span><i class="glyphicon-cart_out"></i></span><span class="name">Form Peminjaman Buku</span>
                </a>
            </li>
            <li class="lime long">
                <a href="<?php echo Yii::app()->createUrl('reimbursementBook/create') ?>">
                    <span><i class="glyphicon-cart_in"></i></span><span class="name">Pengembalian Buku</span>
                </a>
            </li>
            <li class="green long">
                <a href="<?php echo Yii::app()->createUrl('loaningBook/index') ?>">
                    <span><i class="glyphicon-book"></i></span><span class="name">Data Pinjaman Buku</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="col-sm-12">
        <h3>Laporan</h3>
        <ul class="tiles">
            <li class="blue long">
                <a href="<?php echo Yii::app()->createUrl('report/denda') ?>">
                    <span><i class="glyphicon-coins"></i></span><span class="name">Pendapatan Denda</span>
                </a>
            </li>
            <li class="lime long">
                <a href="<?php echo Yii::app()->createUrl('loaningBook/report') ?>">
                    <span><i class="glyphicon-cart_out"></i></span><span class="name">Peminjaman Buku</span>
                </a>
            </li>
            <li class="green long">
                <a href="<?php echo Yii::app()->createUrl('reimbursementBook/report') ?>">
                    <span><i class="glyphicon-cart_in"></i></span><span class="name">Pengembalian Buku</span>
                </a>
            </li>
        </ul>
    </div>
</div>