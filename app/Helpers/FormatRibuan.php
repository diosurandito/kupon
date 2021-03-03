<?php
function format_ribuan($n){
	$n_format = number_format($n / 1000, 1);
    $suffix = 'K';
    $dotzero = '.' . str_repeat( '0', 1 );
    $n_format = str_replace( $dotzero, '', $n_format );
    $hasil = $n_format.$suffix;
    return $hasil;	 
}	
?>