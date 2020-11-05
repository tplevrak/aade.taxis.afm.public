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
 * 		THIS FILE HAS ACCEPTS THE DATA AND CONSTRUCTS THE RESULT PAGE
*/
	// ********************************************************************************************************************

	// ******* Including Necessary files *******
	include "tf_fn_retrive_tax_data_from_afm.php";

	$tv_afm_searched = $_POST["afm2search"];
	$tv_afm_asking = $_POST["afm_asking"];
	$tv_reference_date = $_POST["reference_date"];
	$tv_username = $_POST["username"];
	$tv_password = $_POST["password"];

	$tv_result = tf_retrive_tax_data_from_afm($tv_afm_searched,
											$tv_afm_asking,
											$tv_reference_date,
											$tv_username,
											$tv_password);

		$tv_version_row = "
								<tr>
									<th colspan=\"3\">
										".$tv_result['result_version']."
									</th>
								</tr>
								<tr>
									<td colspan=\"3\"><br></td>
								</tr>
";

		$tv_taxinfo_rows = "
								<tr>
									<td>call_seq_id</td>
									<td> : </td>
									<td>".$tv_result['tax_info_call_seq_id']."</td>
								</tr>
								<tr>
									<td>call_error</td>
									<td> : </td>
									<td>".$tv_result['tax_info_call_error']."</td>
								</tr>
								<tr>
									<td>call_error_description</td>
									<td> : </td>
									<td>".$tv_result['tax_info_call_error_description']."</td>
								</tr>
								<tr>
									<td colspan=\"3\"><br></td>
								</tr>
								<tr>
									<td>username</td>
									<td> : </td>
									<td>".$tv_result['tax_info_used_username']."</td>
								</tr>
								<tr>
									<td>afm</td>
									<td> : </td>
									<td>".$tv_result['tax_info_used_afm']."</td>
								</tr>
								<tr>
									<td>afm_fullname</td>
									<td> : </td>
									<td>".$tv_result['tax_info_used_afm_fullname']."</td>
								</tr>
								<tr>
									<td>afm_called_by</td>
									<td> : </td>
									<td>".$tv_result['tax_info_used_afm_called_by']."</td>
								</tr>
								<tr>
									<td>afm_called_by_fullname</td>
									<td> : </td>
									<td>".$tv_result['tax_info_used_afm_called_by_fullname']."</td>
								</tr>
								<tr>
									<td>as_on_date</td>
									<td> : </td>
									<td>".$tv_result['tax_info_used_as_on_date']."</td>
								</tr>
								<tr>
									<td colspan=\"3\"><br></td>
								</tr>
								<tr>
									<td>afm</td>
									<td> : </td>
									<td>".$tv_result['tax_info_returned_afm']."</td>
								</tr>
								<tr>
									<td>doy</td>
									<td> : </td>
									<td>".$tv_result['tax_info_returned_doy']."</td>
								</tr>
								<tr>
									<td>doy_descr</td>
									<td> : </td>
									<td>".$tv_result['tax_info_returned_doy_descr']."</td>
								</tr>
								<tr>
									<td>i_ni_flag_descr</td>
									<td> : </td>
									<td>".$tv_result['tax_info_returned_i_ni_flag_descr']."</td>
								</tr>
								<tr>
									<td>deactivation_flag</td>
									<td> : </td
									<td>".$tv_result['tax_info_returned_deactivation_flag']."</td>
								</tr>
								<tr>
									<td>deactivation_flag_descr</td>
									<td> : </td>
									<td>".$tv_result['tax_info_returned_deactivation_flag_descr']."</td>
								</tr>
								<tr>
									<td>firm_flag_descr</td>
									<td> : </td>
									<td>".$tv_result['tax_info_returned_firm_flag_descr']."</td>
								</tr>
								<tr>
									<td>onomasia</td>
									<td> : </td>
									<td>".$tv_result['tax_info_returned_onomasia']."</td>
								</tr>
								<tr>
									<td>commer_title</td>
									<td> : </td>
									<td>".$tv_result['tax_info_returned_commer_title']."</td>
								</tr>
								<tr>
									<td>legal_status_descr</td>
									<td> : </td>
									<td>".$tv_result['tax_info_returned_legal_status_descr']."</td>
								</tr>
								<tr>
									<td>postal_address</td>
									<td> : </td>
									<td>".$tv_result['tax_info_returned_postal_address']."</td>
								</tr>
								<tr>
									<td>postal_address_no</td>
									<td> : </td>
									<td>".$tv_result['tax_info_returned_postal_address_no']."</td>
								</tr>
								<tr>
									<td>postal_zip_code</td>
									<td> : </td>
									<td>".$tv_result['tax_info_returned_postal_zip_code']."</td>
								</tr>
								<tr>
									<td>postal_area_description</td>
									<td> : </td>
									<td>".$tv_result['tax_info_returned_postal_area_description']."</td>
								</tr>
								<tr>
									<td>regist_date</td>
									<td> : </td>
									<td>".$tv_result['tax_info_returned_regist_date']."</td>
								</tr>
								<tr>
									<td>stop_date</td>
									<td> : </td>
									<td>".$tv_result['tax_info_returned_stop_date']."</td>
								</tr>
								<tr>
									<td>normal_vat_system_flag</td>
									<td> : </td>
									<td>".$tv_result['tax_info_returned_normal_vat_system_flag']."</td>
								</tr>
";

	$tv_presented_result = "
							<table>
								$tv_version_row
								$tv_taxinfo_rows
							</table>
";
	$tv_new_page_html = tf_make_page($tv_presented_result,
									"No",
									$tv_afm_searched,
									$tv_afm_asking,
									$tv_reference_date,
									$tv_username,
									$tv_password);

	echo $tv_new_page_html;
?>

