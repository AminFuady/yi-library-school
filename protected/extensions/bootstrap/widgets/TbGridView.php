<?php
/**
 * TbGridView class file.
 * @author Antonio Ramirez <ramirez.cobos@gmail.com>
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

Yii::import('zii.widgets.grid.CGridView');

/**
 * Bootstrap Zii grid view.
 */
class TbGridView extends CGridView
{
    /**
     * @var string|array the table style.
     * Valid values are TbHtml::GRID_TYPE_STRIPED, TbHtml::GRID_TYPE_BORDERED, TbHtml::GRID_TYPE_CONDENSED and/or
     * TbHtml::GRID_TYPE_HOVER.
     */
    public $type;
    /**
     * @var array the configuration for the pager.
     * Defaults to <code>array('class'=>'ext.bootstrap.widgets.TbPager')</code>.
     */
    public $pager = array('class' => 'bootstrap.widgets.TbPager');
    /**
     * @var string the URL of the CSS file used by this grid view.
     * Defaults to false, meaning that no CSS will be included.
     */
    public $cssFile = false;
    /**
     * @var string the template to be used to control the layout of various sections in the view.
     */
    public $template = "{items}\n<div class=\"row-fluid\"><div class=\"span6\">{pager}</div><div class=\"span6\">{summary}</div></div>";
    /**
     * @var array table property like border, style, width, etc.
     */
    public $tableProperty;

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        $classes = array('table');
        if (isset($this->type) && !empty($this->type)) {
            if (is_string($this->type)) {
                $this->type = explode(' ', $this->type);
            }

            foreach ($this->type as $type) {
                $classes[] = 'table-' . $type;
            }
        }
        if (!empty($classes)) {
            $classes = implode(' ', $classes);
            if (isset($this->itemsCssClass)) {
                $this->itemsCssClass .= ' ' . $classes;
            } else {
                $this->itemsCssClass = $classes;
            }
        }
    }

    /**
     * Creates column objects and initializes them.
     */
    protected function initColumns()
    {
        foreach ($this->columns as $i => $column) {
            if (is_array($column) && !isset($column['class'])) {
                $this->columns[$i]['class'] = 'bootstrap.widgets.TbDataColumn';
            }
        }
        parent::initColumns();
    }

    /**
     * Creates a column based on a shortcut column specification string.
     * @param mixed $text the column specification string
     * @return \TbDataColumn|\CDataColumn the column instance
     * @throws CException if the column format is incorrect
     */
    protected function createDataColumn($text)
    {
        if (!preg_match('/^([\w\.]+)(:(\w*))?(:(.*))?$/', $text, $matches)) {
            throw new CException(Yii::t(
                'zii',
                'The column must be specified in the format of "Name:Type:Label", where "Type" and "Label" are optional.'
            ));
        }
        $column = new TbDataColumn($this);
        $column->name = $matches[1];
        if (isset($matches[3]) && $matches[3] !== '') {
            $column->type = $matches[3];
        }
        if (isset($matches[5])) {
            $column->header = $matches[5];
        }
        return $column;
    }
    
    /**
     * A Header Group Grid View that groups header columns
     */
    public $mergeHeaders = array();
    private $_mergeindeks = array();
    private $_nonmergeindeks = array();
    
    public function renderItems()
    {
        if($this->dataProvider->getItemCount()>0 || $this->showTableOnEmpty)
        {
            if(!empty($this->tableProperty)){
                $property='';
                if(is_array($this->tableProperty)){
                    foreach ($this->tableProperty as $key=>$value){
                        $property.="$key = \"{$value}\" ";
                    }
                }
                echo "<table class=\"{$this->itemsCssClass}\" $property>\n";
            }else{
                echo "<table class=\"{$this->itemsCssClass}\">\n";
            }
            if(!empty($this->mergeHeaders)){
                echo "<thead>\n";
                $this->renderGroupHeaders();
                echo "</thead>\n";
            } else {
                $this->renderTableHeader();
            }
            $this->renderTableBody();
            $this->renderTableFooter();
            echo "</table>";
        }
        else
            $this->renderEmptyText();
    }

    public function renderGroupHeaders()
    {
        $this->setMergeIndeks();
        $this->setNonMergeIndeks();
        if($this->filterPosition===self::FILTER_POS_HEADER)
                $this->renderFilter();
        echo "<tr>\n";

        ob_start();
        echo "<tr>\n";
        $i=0;
        foreach($this->columns as $column){
                if(in_array($i, $this->_mergeindeks)):
                        $column->headerHtmlOptions['colspan']='1';
                        $column->renderHeaderCell();
                endif;
                $i++;
        }
        echo "</tr>\n";
        $header_bottom = ob_get_clean();

        $i=0;
        foreach($this->columns as $column){			
                for($m=0;$m<count($this->mergeHeaders);$m++){
                        if($i==$this->mergeHeaders[$m]["start"]):
                                $column->headerHtmlOptions['colspan']=$this->mergeHeaders[$m]["end"]-$this->mergeHeaders[$m]["start"]+1;
                                $column->headerHtmlOptions['class']='header-center';
                                $column->header = $this->mergeHeaders[$m]["name"];
                                $column->id = NULL;
                                $column->renderHeaderCell();
                        endif;
                }
                if(in_array($i, $this->_nonmergeindeks)){
                        $column->headerHtmlOptions['rowspan']='2';
                        $column->renderHeaderCell();
                }
                $i++;
        }
        echo "</tr>\n";

        echo $header_bottom;
        if($this->filterPosition===self::FILTER_POS_BODY)
                $this->renderFilter();
    }

    protected function setMergeIndeks()
    {
        for($i=0;$i<count($this->mergeHeaders);$i++)
                for($j=$this->mergeHeaders[$i]["start"];$j<= $this->mergeHeaders[$i]["end"];$j++)
                        $this->_mergeindeks[] = $j;
    }

    protected function setNonMergeIndeks()
    {
        foreach($this->columns as $key=>$val) $h[] = $key;
        $this->_nonmergeindeks = array_diff($h, $this->_mergeindeks);
    }
}
