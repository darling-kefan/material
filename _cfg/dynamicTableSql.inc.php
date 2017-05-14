<?php 
/**
 * 动态生成分表SQL语句，其中<%{dbname}%>是需要动态替换的新表名称
 */
$_DeviceDataTable = <<<MM
CREATE  TABLE IF NOT EXISTS `<%{dbname}%>` (
    `DeviceDataID` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
    `DeviceID` INT UNSIGNED NOT NULL ,
    `GatherTime` DATETIME NOT NULL,
    `CreateTime` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `Value` VARCHAR(255) NULL,
    INDEX `DeviceID` (`DeviceID` ASC) ,
    PRIMARY KEY (`DeviceDataID`) )
ENGINE = MyISAM
MM;

?>