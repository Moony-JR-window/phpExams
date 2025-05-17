<?php

function ForLoop(){
    $i = 0;

    for($i=0; $i<5; $i++){
        echo "This For loop $i \n  ";
    }
}

ForLoop();

function DoWhileLoop(){
    $i=0;
    do{
        echo "This Do while Loop $i \n  ";
        $i++;
    }while($i<5);
}

DoWhileLoop();

function Whileloop(){
    $i=0;
    while ($i<5){
        echo "This is While Loop $i \n";
        $i++;
    }
}

Whileloop();

