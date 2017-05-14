<?php
if(! defined('MATERIAL')){
    exit('Include Permission Denied!');
}

/**
 * 判断经纬度是否在多边形内
 * @param float  $lat
 * @param float  $lng
 * @param array  $latlngs array(array(31.50931375402958, 121.3360919122992), array(31.5033481528527, 121.3218484738624))
 * @return int 0/无效 1/是节点 2/在边界线上 3/多边行内 4/多边行外
 */
//function inPolygon($lat, $lng, $latlngs)
//{
//    if(!$latlngs){
//        return 0;
//    }
//    $polygon = $latlngs;
//    $pointInPolygon = new PointInPolygon($polygon);
//    $point = array($lat, $lng);
//    return $pointInPolygon->is_inside($point);
//}

/**
 * 判断点是否在多边形内。
 * 该类来源于网络，参考地址：
 * http://blog.haaway.com/if-point-in-polygon-php/
 * http://www.assemblysys.com/dataServices/php_pointinpolygon.php
 * http://dev.gameres.com/Program/Abstract/Geometry.htm
 * 不做重复的车轮，使我们有更多的时间去享受生活。
 * 
 * @example
 * $polygon = array(array(0, 0), array(12, 0), array(12, 11), array(0, 11));
 * $polygon_verifier = new PointInPolygon($polygon);
 * $point = array(12, 10.99999999);
 * echo 'Point ' . $point['0'] . ', ' . $point['1'] . ' is ' . $polygon_verifier->is_inside($point) . '<br />';
 */
class PointInPolygon
{
    /**
     * The different types of polygon points
     */
    const POINT_VERTEX   = 1;
    const POINT_BOUNDARY = 2;
    const POINT_INSIDE   = 3;
    const POINT_OUTSIDE  = 4;
    /**
     * The Array-indexes to use for X- and Y-coordinates
     */
    const POLYGON_X_INDEX = 0;
    const POLYGON_Y_INDEX = 1;
    /**
     * The vertices that form the polygon.
     * @var Array
     */
    private $vertices;
    /**
     * Check whether the point is a vertex or not
     * @var boolean
     */
    private $vertex_check = true;
    
    
    /**
     * PointInPolygon constructor
     * @param Array $vertices The vertices that form the polygon.
     */
    function PointInPolygon($vertices)
    {
        $this->vertices = $vertices;
    }
    
    /**
     * Check if the point is inside the polygon
     * @param Array $point The point to check.
     * @param boolean $vertex_check Check whether the point is a vertex or not
     * @return int The point type.
     */
    function isInside($point, $vertex_check = true)
    {
        $this->vertex_check = $vertex_check;
        $vertices = $this->vertices;
        // Check if the point sits exactly on a vertex
        if($this->vertex_check === true && $this->point_is_on_vertex($point, $vertices) === true){
            return self::POINT_VERTEX;
        }
        // Check if the point is inside the polygon or on the boundary
        $intersections = 0;
        $vertices_count = count($vertices);
        for($i = 1; $i < $vertices_count; $i++){
            $vertex1 = $vertices[$i - 1];
            $vertex2 = $vertices[$i];
            // Check if point is on an horizontal polygon boundary
            if($vertex1[self::POLYGON_Y_INDEX] == $vertex2[self::POLYGON_Y_INDEX] 
            && $vertex1[self::POLYGON_Y_INDEX] == $point[self::POLYGON_Y_INDEX] 
            && $point[self::POLYGON_X_INDEX] > min($vertex1[self::POLYGON_X_INDEX], $vertex2[self::POLYGON_X_INDEX]) 
            && $point[self::POLYGON_X_INDEX] < max($vertex1[self::POLYGON_X_INDEX], $vertex2[self::POLYGON_X_INDEX])){
                return self::POINT_BOUNDARY;
            }
            if($point[self::POLYGON_Y_INDEX] > min($vertex1[self::POLYGON_Y_INDEX], $vertex2[self::POLYGON_Y_INDEX]) 
            && $point[self::POLYGON_Y_INDEX] <= max($vertex1[self::POLYGON_Y_INDEX], $vertex2[self::POLYGON_Y_INDEX]) 
            && $point[self::POLYGON_X_INDEX] <= max($vertex1[self::POLYGON_X_INDEX], $vertex2[self::POLYGON_X_INDEX]) 
            && $vertex1[self::POLYGON_Y_INDEX] != $vertex2[self::POLYGON_Y_INDEX]){
                $xinters = ($point[self::POLYGON_Y_INDEX] - $vertex1[self::POLYGON_Y_INDEX]) * ($vertex2[self::POLYGON_X_INDEX] - $vertex1[self::POLYGON_X_INDEX])/($vertex2[self::POLYGON_Y_INDEX] - $vertex1[self::POLYGON_Y_INDEX]) + $vertex1[self::POLYGON_X_INDEX];
                // Check if point is on the polygon boundary (other than horizontal)
                if($xinters == $point[self::POLYGON_X_INDEX]){
                    return self::POINT_BOUNDARY;
                }
                if($vertex1[self::POLYGON_X_INDEX] == $vertex2[self::POLYGON_X_INDEX] || $point[self::POLYGON_X_INDEX] <= $xinters){
                    $intersections ++;
                }
            }
        }
        // If the number of edges we passed through is even, then it's in the polygon.
        if($intersections % 2 != 0){
            return self::POINT_INSIDE;
        }else{
            return self::POINT_OUTSIDE;
        }
    }
    
    /**
     * Check if the point sits exactly on one of the vertices
     * @param Array $point The point to check.
     * @return boolean True if the point is a vertex, false otherwise.
     */
    function point_is_on_vertex($point)
    {
        $vertices = $this->vertices;
        foreach($vertices as $vertex){
            if($point === $vertex){
                return true;
            }
        }
        return false;
    }
}
?>