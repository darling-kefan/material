<?php
/**
 * lib class
 *
 * @package _libs
 * @author qiushi
 * @access public
 * @version v1.0 2011-02-24
 */
class Excel{

    /**
     * 读取csv文件
     *
     * @param string $path
     * @param int $num
     * @return array
     */
    function getCsvList($path, $num = 1000)
    {
        $handle = fopen($path,"r");
        $csvList = array();
        while ($data = fgetcsv($handle, $num, ",")) {
            if($data[0] == null){
                break;
            }
            $dataNum = count($data);
            for($c = 0; $c < $dataNum; $c++) {
                if($data[$c] == null){
                    continue;
                }
                $dataNew[$c] = mb_convert_encoding($data[$c], "UTF-8", "GBK");
            }
            $csvList[] = $dataNew;
        }
        return $csvList;
    }

     /**
     * 读取excel文件
     *
     * @param string $path
     * @return array
     */
    function getExcelList($path)
    {
        require_once('excel/reader.php');
        $data = new Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('CP1251');
        $data->read($path);
        $excelList = array();
        for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
            for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
               $dataNew[$j] = mb_convert_encoding($data->sheets[0]['cells'][$i][$j], "UTF-8", "GBK");
            }
	        $excelList[] = $dataNew;

        }
        return $excelList;

    }
}

?>