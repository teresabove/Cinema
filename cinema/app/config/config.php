<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define ('ROOT_DIR', 'C:\xampp\htdocs\progetto\cinema');
global $config;

$config['debug']=true;
$config['mysql']['user']='root';
$config['mysql']['password']='';
$config['mysql']['host']='localhost';
$config['mysql']['db']='cinema';


function debug($var){
         global $config;
         if ($config['debug']){
            echo "<pre>";
            print_r($var);
            echo "</pre>\n";
            }
         }
?>