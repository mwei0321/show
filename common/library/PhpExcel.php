<?php
  /**
	*  +---------------------------------------------------------------------------------+
	*   | Explain:  php导入导出 excel
	*  +---------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +---------------------------------------------------------------------------------+
	*   | Creater Time : 2016年6月2日
	*  +---------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +---------------------------------------------------------------------------------+
	**/
//     namespace StjApi\Library;
    require_once ROOT_PATH.'/common/library/PHPExcel/PHPExcel.php';

	class PhpExcel2{
	    //phpexcel object var
	    private $phpexcel;
	    //输入出文件对象
	    private $outObj;
	    //输出类型
	    private $outtype = ['xls'=>'Excel5','xlsx'=>'Excel2007','pdf'=>'PDF'];
	    //定义列
	    private $cells = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'];
        //列标题
        private $celltitle = [];
        //当前页码
        private $sheetIndex = 0;

	    function __construct(){
	        $this->phpexcel = new \PHPExcel();
	    }

	    /**
	     * 设置写入那一页
	     * @param  string
	     * @return array
	     * @author MaWei (http://www.phpython.com)
	     * @date 2016年6月3日 下午5:41:58
	    */
	    function setSheetIndex($_title,$_index = 0){
	        $this->sheetIndex = $_index;
            $this->setActiveSheet();
            $this->sheetTitle($_title);
            return $this;
	    }

	    /**
	     * 写入数据
	     * @param  array $_data 数据
	     * @param  int $_rows 行号
	     * @return array
	     * @author MaWei (http://www.phpython.com)
	     * @date 2016年6月3日 下午4:55:26
	    */
	    function writeData($_data,$_rows = 1){
	        foreach ($_data as $k => $v){
	            $_rows ++;$cell = 0;
	            foreach ($v as $key => $val){
	                $cellcode = (string)($this->cells[$cell].$_rows);
	                $this->phpexcel->getActiveSheet()->setCellValue($cellcode,$val);
	                //设置对齐方式
	                $this->setAlign($cellcode);
	                $cell++;
	            }
	        }
	        return $this;
	    }

	    /**
	     * 写入列表标题
	     * @param  array
	     * @return array
	     * @author MaWei (http://www.phpython.com)
	     * @date 2016年6月3日 下午4:02:30
	    */
	    function writeCellTitle($_celltitle,$_width = 20){
    		foreach ($_celltitle as $k => $v){
    		    $cellscode = $this->cells[$k].'1';
                $this->phpexcel->getActiveSheet()->setCellValue($cellscode,$v);
                //标题加粗
                $this->fontBold($cellscode);
                //标题居中
                $this->setVertical($cellscode);
                //设置宽度
                $this->cellWidth($this->cells[$k],is_array($_width) ? $_width[$k] : $_width);
    		}
    		return $this;
	    }

	    /**
	     * 下载为通用excel
	     * @param string $_outFileType ['xls'=>'Excel5','xlsx'=>'Excel2007','PDF'=>'pdf']
	     * @return array
	     * @author MaWei (http://www.phpython.com)
	     * @date 2016年6月3日 下午3:06:01
	    */
	    function downloadFile($_fileName = 'data',$_outFileType = "xlsx"){
	        header("Pragma: public");
	        header("Expires: 0");
	        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
	        header("Content-Type:application/force-download");
	        header("Content-Type: application/vnd.ms-excel;");
	        header("Content-Type:application/octet-stream");
	        header("Content-Type:application/download");
	        header("Content-Disposition:attachment;filename=".$_fileName.'.'.$_outFileType);
	        header("Content-Transfer-Encoding:binary");
	        $this->outtype = \PHPExcel_IOFactory::createWriter($this->phpexcel, $this->outtype[$_outFileType]);
	        $this->outtype->save('php://output');
	    }

	    /**
	     * 设置当前活动的sheet
	     * @return array
	     * @author MaWei (http://www.phpython.com)
	     * @date 2016年6月8日 上午10:48:47
	    */
	    function setActiveSheet(){
            $this->sheetIndex > 0 && $this->phpexcel->createSheet();
            $this->phpexcel->setActiveSheetIndex($this->sheetIndex);
	    }

	    /**
	     * 设置sheet的标题
	     * @param  string 标题
	     * @return array
	     * @author MaWei (http://www.phpython.com)
	     * @date 2016年6月2日 下午5:09:35
	     */
	    function sheetTitle($_title = 'samples'){
	        $this->phpexcel->getActiveSheet()->setTitle($_title);
	    }

	    /**
	     * 设置单元格宽度
	     * @param  string $_column 列号
	     * @param  int $_width 宽度
	     * @return array
	     * @author MaWei (http://www.phpython.com)
	     * @date 2016年6月2日 下午5:12:56
	     */
	    function cellWidth($_column = 'A',$_width = 20){
	        $this->phpexcel->getActiveSheet()->getColumnDimension($_column)->setWidth($_width);
	    }

	    /**
	     * 设置单元格高度
	     * @param  string $_column 行号
	     * @param  int $_height 高度
	     * @return array
	     * @author MaWei (http://www.phpython.com)
	     * @date 2016年6月2日 下午5:12:56
	     */
	    function cellHeight($_row = 1,$_height = 20){
	        $this->phpexcel->getActiveSheet()->getRowDimension($_row)->setRowHeight($_height);
	    }

	    /**
	     * 内容自适应
	     * @param  string $_column 列号
	     * @return array
	     * @author MaWei (http://www.phpython.com)
	     * @date 2016年6月2日 下午5:48:27
	     */
	    function autoWidthHeight($_column){
	        $this->phpexcel->getActiveSheet()->getColumnDimension($_column)->setAutoSize(true);
	    }

	    /**
	     * 合并单元格
	     * @param  string $_cells 列行：列行
	     * @return array
	     * @author MaWei (http://www.phpython.com)
	     * @date 2016年6月2日 下午5:17:53
	     */
        function mergeCells($_cells = "A1:B2"){
            $this->phpexcel->getActiveSheet()->mergeCells($_cells);
        }


	    /**
	     * 拆分单元格
	     * @param  string $_cells 列行：列行
	     * @return array
	     * @author MaWei (http://www.phpython.com)
	     * @date 2016年6月2日 下午5:19:41
	     */
        function unmergeCells($_cells = "A1:B2"){
            $this->phpexcel->getActiveSheet()->unmergeCells($_cells);
        }

        /**
         * 设置加粗
	     * @param  string $_cells 列行
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2016年6月2日 下午5:23:28
         */
        function fontBold($_cells = 'A1'){
            $this->phpexcel->getActiveSheet()->getStyle($_cells)->getFont()->setBold(true);
        }

        /**
         * 设置字体大小
         * @param  int $_size 字体大小
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2016年6月2日 下午5:25:28
         */
        function fontSize($_size = 14){
            $this->phpexcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize($_size);
        }

        /**
         * 设置垂直居中
	     * @param  string $_cells 列行
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2016年6月2日 下午5:27:50
         */
        function setVertical($_cells = 'A1'){
            $this->phpexcel->getActiveSheet()->getStyle($_cells)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        }

        /**
         * 设置对齐方式
	     * @param  string $_cells 列行
	     * @param  int $_align 对齐方式 (1:居右2:居左3:居中4:两端对齐)
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2016年6月2日 下午5:27:50
         */
        function setAlign($_cells = 'A1',$_align = 2){
            switch ($_align){
                case 1 :
                    $this->phpexcel->getActiveSheet()->getStyle($_cells)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                    break;
                case 2 :
                    $this->phpexcel->getActiveSheet()->getStyle($_cells)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                    break;
                case 3 :
                    $this->phpexcel->getActiveSheet()->getStyle($_cells)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    break;
                case 4 :
                    $this->phpexcel->getActiveSheet()->getStyle($_cells)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
                    break;
                default:
                    break;
            }
        }

        /**
         * 转换字符编码为utf8
         * @param  string $_str
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2016年6月2日 下午5:42:08
         */
        private function convertUTF8($_str){
            if(empty($str)) return '';
            return  iconv('gb2312', 'utf-8', $_str);
        }
	}