<?php
	// Start the session
	session_start();

	// ********************************************************************************************************************
/*		Υλοποίηση της αναζήτησης των φορολογικών στοιχείων προσώπου με την χρήση του API της ΑΑΔΕ σε php
 * 
 * 		PLEVRAKIS THEOPHILOS
 * 		tplevrak@tplevrak.gr
 * 		https://github.com/tplevrak/aade.taxis.afm.public
 * 
 * 		November 2020
 * 		MIT License - https://opensource.org/licenses/MIT
 *
 * 		Copyright 2020 PLEVRAKIS THEOPHILOS - tplevrak@tplevrak.gr
 * 		
 * 		Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated 
 * 		documentation files (the "Software"), to deal in the Software without restriction, including without limitation 
 * 		the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, 
 * 		and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * 		The above copyright notice and this permission notice shall be included in all copies or 
 * 		substantial portions of the Software.
 *
 * 		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED 
 * 		TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL 
 * 		THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION 
 * 		OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER 
 * 		DEALINGS IN THE SOFTWARE.
 * 
 * 
 * 	// ********************************************************************************************************************
 * 
 * 		AADE API info
 * 		https://www.aade.gr/epiheiriseis/forologikes-ypiresies/mitroo/anazitisi-basikon-stoiheion-mitrooy-epiheiriseon
 * 
 * 	// ********************************************************************************************************************
 * 
 * 		INITIAL PAGE
*/
	// ********************************************************************************************************************

	// ******* Including Necessary files *******
	include "tf_fn_retrive_tax_data_from_afm.php";

	$tv_new_page_html = tf_make_page($tv_extra_input, 
									$tv_called_1st_time = "Yes",
									$tv_afm_searched = "AFM_SEARCHED",
									$tv_afm_asking = "AFM_ASKING",
									$tv_reference_date = "2000-01-01",
									$tv_username = "USERNAME",
									$tv_password = "PASSWORD") ;

	echo $tv_new_page_html;
?>

