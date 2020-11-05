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
 * 		THIS FILE HAS TWO FUNCTIONS 
 * 		
 * 		tf_make_page
 * 		THAT CONTRUCTS THE PAGE 
 * 
 * 		tf_retrive_tax_data_from_afm
 * 		THAT CONNECTS TO THE API TO RETRIEVE THE DATA
*/

	// ********************************************************************************************************************

	function tf_make_page($tv_extra_input, 
						$tv_called_1st_time = "No",
						$tv_afm_searched = "AFM_SEARCHED",
						$tv_afm_asking = "AFM_ASKING",
						$tv_reference_date = "2000-01-01",
						$tv_username = "USERNAME",
						$tv_password = "PASSWORD") {

		try {

			if ($tv_reference_date == "2000-01-01") {
				$tv_reference_date = date("Y-m-d");
			}

			if ($tv_called_1st_time == "Yes") {
				$tv_result_padding = "";
				$tv_extra_br = "";
			}
			else {
				$tv_result_padding = "padding:10px; ";
				$tv_extra_br = "<br>";
			}

			$tv_page_html = "
<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
<html>
	<head>
		<title>TAXIS - AADE from tplevrak@tplevrak.gr</title>
		<meta name='author' content='tplevrak@tplevrak.gr'>
		<meta http-equiv='content-type' content='text/html; charset=UTF-8'>
		<meta charset='UTF-8'>
		<style>
			html {
				height:100%;
				text-align:center;
			}

			body {
				width:95%;
				font-family: Verdana, Geneva, sans-serif;
			}

			.plain_transparent_table, 
			.plain_transparent_table:hover {
				background-color: white;
			}

			.plain_transparent_table,
			.plain_transparent_table:hover {
				background-color:transparent;
			}
			
			.main_grid {
				display:grid;
				background-color:transparent;
				grid-column-gap:0px;
				grid-row-gap:20px;
				grid-template-columns: auto auto auto;
				grid-template-rows: auto auto auto;
			}

			.main_grid_item {
				background-color:transparent;
			}

			#dv_username {
				grid-row-start: 1;
				grid-row-end: 2;
				grid-column-start: 1;
				grid-column-end: 2;
			}

			#dv_password {
				grid-row-start: 1;
				grid-row-end: 2;
				grid-column-start: 2;
				grid-column-end: 3;
			}

			#dv_afm_asking {
				grid-row-start: 1;
				grid-row-end: 2;
				grid-column-start: 3;
				grid-column-end: 4;
			}

			#dv_afm_searched {
				grid-row-start: 2;
				grid-row-end: 3;
				grid-column-start: 1;
				grid-column-end: 2;
			}

			#dv_reference_date {
				grid-row-start: 2;
				grid-row-end: 3;
				grid-column-start: 3;
				grid-column-end: 4;
			}

			#dv_submit_button {
				grid-row-start: 3;
				grid-row-end: 4;
				grid-column-start: 1;
				grid-column-end: 4;
			}

			#dv_select_action {
				grid-row-start: 3;
				grid-row-end: 4;
				grid-column-start: 3;
				grid-column-end: 4;
			}

			/* Responsive layout */
			@media (max-width: 800px) {

				.main_grid {
					grid-template-columns: auto;
					grid-template-rows: repeat(7,auto);
				}

				#dv_username {
					grid-row-start: 1;
					grid-row-end: 2;
					grid-column-start: 1;
					grid-column-end: 2;
				}

				#dv_password {
					grid-row-start: 2;
					grid-row-end: 3;
					grid-column-start: 1;
					grid-column-end: 2;
				}

				#dv_afm_asking {
					grid-row-start: 3;
					grid-row-end: 4;
					grid-column-start: 1;
					grid-column-end: 2;
				}

				#dv_afm_searched {
					grid-row-start: 4;
					grid-row-end: 5;
					grid-column-start: 1;
					grid-column-end: 2;
				}

				#dv_reference_date {
					grid-row-start: 5;
					grid-row-end: 6;
					grid-column-start: 1;
					grid-column-end: 2;
				}

				#dv_submit_button {
					grid-row-start: 6;
					grid-row-end: 7;
					grid-column-start: 1;
					grid-column-end: 2;
				}

			}
		</style>
	</head>
	<body>
		<div 
			style=\"width:90%; 
				text-align:center; 
				margin:auto;
				background-color:#FFB69F;
				padding:10px;
				border-radius:5px;\">
				<br>
			<div id=\"searchcriteria\">
				<div>
					<div style=\"width:95%; 
							text-align:center; 
							margin:auto;
							background-color:#CEF2FF;
							padding:10px;
							border-radius:5px;\">
						<b>
							Υλοποίηση της αναζήτησης των φορολογικών στοιχείων προσώπου με την χρήση του API της ΑΑΔΕ σε php
							<br><br>
							Πλευράκης Θεόφιλος<br>
							tplevrak@tplevrak.gr
						</b>
					</div>
					<br>
					<div
						id=\"dv_form\" 
						style=\"width:95%; 
							text-align:center; 
							margin:auto;
							background-color:#E7FFDF;
							padding:10px;
							border-radius:5px;\">
						<form
							method=\"post\" 
							target=\"_self\" 
							action=\"tf_cmd_retrieve_from_afm.php\"
							style=\"text-align:center; margin:auto;\"
							>
							<div class=\"main_grid\">
								<div 
									class=\"main_grid_item\"
									id=\"dv_username\"
									name=\"dv_username\">
										<label for=\"username\">User Name</label><br>
										<input   
											id=\"username\" 
											name=\"username\"
											type=\"text\"
											value=\"$tv_username\"
											style=\"width:200px; text-align:center;\"
											>
								</div>
								<div 
									class=\"main_grid_item\"
									id=\"dv_password\"
									name=\"dv_password\">
										<label for=\"password\">Password</label><br>
										<input   
											id=\"password\" 
											name=\"password\"
											type=\"text\"
											value=\"$tv_password\"
											style=\"width:200px; text-align:center;\"
											>
								</div>
								<div 
									class=\"main_grid_item\"
									id=\"dv_afm_asking\"
									name=\"dv_afm_asking\">
										<label for=\"afm_asking\">AFM Asking</label><br>
										<input   
											id=\"afm_asking\" 
											name=\"afm_asking\"
											type=\"text\"
											value=\"$tv_afm_asking\"
											style=\"width:200px; text-align:center;\"
											>
								</div>
								<div 
									class=\"main_grid_item\"
									id=\"dv_afm_searched\"
									name=\"dv_afm_searched\">
										<label for=\"afm2search\">AFM Searched</label><br>
										<input   
											id=\"afm2search\" 
											name=\"afm2search\"
											type=\"text\"
											value=\"$tv_afm_searched\"
											style=\"width:200px; text-align:center;\"
											>
								</div>
								<div 
									class=\"main_grid_item\"
									id=\"dv_reference_date\"
									name=\"dv_reference_date\">
										<label for=\"reference_date\">Reference Date</label><br>
										<input   
											id=\"reference_date\" 
											name=\"reference_date\"
											type=\"date\"
											value=\"$tv_reference_date\"
											style=\"width:200px; text-align:center;\"
											>
								</div>
								<div 
									class=\"main_grid_item\"
									id=\"dv_submit_button\"
									name=\"dv_submit_button\">
										<br>
										<input
											id=\"submit_button\" 
											name=\"submit_button\"
											type=\"submit\"
											value=\"Submit\"
											style=\"width:200px; height:50px;\"
											>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<br>
			<div id=\"results_div\"
				style=\"width:95%; 
					text-align:left; 
					word-break: break-word;
					margin:auto;
					background-color:#FFFFDA;
					border-radius:5px;
					$tv_result_padding\">
				$tv_extra_input
			</div>
			$tv_extra_br
		</div>
	</body>
</html>
";

			return $tv_page_html;
		}
		// ERROR HANDLING
		catch(Exception $e) {
			$tv_message = "tf_make_page : " . $e->getMessage();
			echo $tv_message;
			return $tv_message;
		}
	}

	// ********************************************************************************************

	function tf_retrive_tax_data_from_afm($tv_afm_searched,
											$tv_afm_asking,
											$tv_reference_date,
											$tv_username,
											$tv_password) {
												
		try {

			// ************* Soap Variable for TAX Info ***********************************
			$tv_request_string = "
<soap:Envelope xmlns:soap=\"http://www.w3.org/2003/05/soap-envelope\" xmlns:rgw=\"http://rgwspublic2/RgWsPublic2Service\" xmlns:rgw1=\"http://rgwspublic2/RgWsPublic2\">
	<soap:Header>
	</soap:Header>
	<soap:Body>
		<rgw:rgWsPublic2AfmMethod>
			<rgw:INPUT_REC>
				<!--Optional:-->
				<rgw1:afm_called_by>$tv_afm_asking</rgw1:afm_called_by>
				<!--Optional:-->
				<rgw1:afm_called_for>$tv_afm_searched</rgw1:afm_called_for>
				<!--Optional:-->
				<rgw1:as_on_date>$tv_reference_date</rgw1:as_on_date>
			</rgw:INPUT_REC>
		</rgw:rgWsPublic2AfmMethod>
	</soap:Body>
</soap:Envelope>";

			// $_SESSION["tv_debug"] = "<br>teomantest<br><pre>$tv_request_string</pre>";			// 4 debug

			$tv_request_tax_info = new SoapVar($tv_request_string, XSD_ANYXML);


			// ************* Soap Variable for Version Info ********************************
			$tv_request_version = new SoapVar("
<soap:Envelope xmlns:soap=\"http://www.w3.org/2003/05/soap-envelope\" xmlns:rgw=\"http://rgwspublic2/RgWsPublic2Service\">
	<soap:Header/>
	<soap:Body>
		<rgw:rgWsPublic2VersionInfo/>
	</soap:Body>
</soap:Envelope>", XSD_ANYXML);


			// ************* Prepare SOAP Options *****************************
			$options = array(
							'soap_version'=>SOAP_1_2,
							'exceptions'=>true,
							'trace'=>1,
							'cache_wsdl'=>WSDL_CACHE_NONE
							);

			// ************* Establish Soap Object ****************************
			$client = new SoapClient('https://www1.gsis.gr/wsaade/RgWsPublic2/RgWsPublic2?WSDL', $options);

			// ************* Set Header Parameters for Authentication **************
			$authHeader = new stdClass();
			$authHeader->UsernameToken = new stdClass();
			$authHeader->UsernameToken->Username = $tv_username;
			$authHeader->UsernameToken->Password = $tv_password;
			$Headers[] = new SoapHeader('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd', 'Security', $authHeader,TRUE);
			$client->__setSoapHeaders($Headers);

			// ************* Execute Methods for acquiring data ***************
			$result_tax_info = $client->rgWsPublic2AfmMethod($tv_request_tax_info);
			$result_version = $client->rgWsPublic2VersionInfo($tv_request_version);

			// ************* Grabs the data ***********************************
			// For Version Info
			$version_info_result = $result_version->result;

			// For TAX Info
			$tax_info_call_seq_id = $result_tax_info->result->rg_ws_public2_result_rtType->call_seq_id;
			$tax_info_call_error = $result_tax_info->result->rg_ws_public2_result_rtType->error_rec->error_code;
			$tax_info_call_error_description = $result_tax_info->result->rg_ws_public2_result_rtType->error_rec->error_descr;

			$tax_info_used_username = $result_tax_info->result->rg_ws_public2_result_rtType->afm_called_by_rec->token_username;
			$tax_info_used_afm = $result_tax_info->result->rg_ws_public2_result_rtType->afm_called_by_rec->token_afm;
			$tax_info_used_afm_fullname = $result_tax_info->result->rg_ws_public2_result_rtType->afm_called_by_rec->token_afm_fullname;
			$tax_info_used_afm_called_by = $result_tax_info->result->rg_ws_public2_result_rtType->afm_called_by_rec->afm_called_by;
			$tax_info_used_afm_called_by_fullname = $result_tax_info->result->rg_ws_public2_result_rtType->afm_called_by_rec->afm_called_by_fullname;
			$tax_info_used_as_on_date = $result_tax_info->result->rg_ws_public2_result_rtType->afm_called_by_rec->as_on_date;

			$tax_info_returned_afm = $result_tax_info->result->rg_ws_public2_result_rtType->basic_rec->afm;
			$tax_info_returned_doy = $result_tax_info->result->rg_ws_public2_result_rtType->basic_rec->doy;
			$tax_info_returned_doy_descr = $result_tax_info->result->rg_ws_public2_result_rtType->basic_rec->doy_descr;
			$tax_info_returned_i_ni_flag_descr = $result_tax_info->result->rg_ws_public2_result_rtType->basic_rec->i_ni_flag_descr;
			$tax_info_returned_deactivation_flag = $result_tax_info->result->rg_ws_public2_result_rtType->basic_rec->deactivation_flag;
			$tax_info_returned_deactivation_flag_descr = $result_tax_info->result->rg_ws_public2_result_rtType->basic_rec->deactivation_flag_descr;
			$tax_info_returned_firm_flag_descr = $result_tax_info->result->rg_ws_public2_result_rtType->basic_rec->firm_flag_descr;
			$tax_info_returned_onomasia = $result_tax_info->result->rg_ws_public2_result_rtType->basic_rec->onomasia;
			$tax_info_returned_commer_title = $result_tax_info->result->rg_ws_public2_result_rtType->basic_rec->commer_title;
			$tax_info_returned_legal_status_descr = $result_tax_info->result->rg_ws_public2_result_rtType->basic_rec->legal_status_descr;
			$tax_info_returned_postal_address = $result_tax_info->result->rg_ws_public2_result_rtType->basic_rec->postal_address;
			$tax_info_returned_postal_address_no = $result_tax_info->result->rg_ws_public2_result_rtType->basic_rec->postal_address_no;
			$tax_info_returned_postal_zip_code = $result_tax_info->result->rg_ws_public2_result_rtType->basic_rec->postal_zip_code;
			$tax_info_returned_postal_area_description = $result_tax_info->result->rg_ws_public2_result_rtType->basic_rec->postal_area_description;
			$tax_info_returned_regist_date = $result_tax_info->result->rg_ws_public2_result_rtType->basic_rec->regist_date;
			$tax_info_returned_stop_date = $result_tax_info->result->rg_ws_public2_result_rtType->basic_rec->stop_date;
			$tax_info_returned_normal_vat_system_flag= $result_tax_info->result->rg_ws_public2_result_rtType->basic_rec->normal_vat_system_flag;


			// ************* Assembling Final Result **************************
			$tv_final_result["result_version"] = $result_version->result;

			$tv_final_result["tax_info_call_seq_id"] = $tax_info_call_seq_id;
			$tv_final_result["tax_info_call_error"] = $tax_info_call_error;
			$tv_final_result["tax_info_call_error_description"] = $tax_info_call_error_description;

			$tv_final_result["tax_info_used_username"] = $tax_info_used_username;
			$tv_final_result["tax_info_used_afm"] = $tax_info_used_afm;
			$tv_final_result["tax_info_used_afm_fullname"] = $tax_info_used_afm_fullname;
			$tv_final_result["tax_info_used_afm_called_by"] = $tax_info_used_afm_called_by;
			$tv_final_result["tax_info_used_afm_called_by_fullname"] = $tax_info_used_afm_called_by_fullname;
			$tv_final_result["tax_info_used_as_on_date"] = $tax_info_used_as_on_date;

			$tv_final_result["tax_info_returned_afm"] = $tax_info_returned_afm;
			$tv_final_result["tax_info_returned_doy"] = $tax_info_returned_doy;
			$tv_final_result["tax_info_returned_doy_descr"] = $tax_info_returned_doy_descr;
			$tv_final_result["tax_info_returned_i_ni_flag_descr"] = $tax_info_returned_i_ni_flag_descr;
			$tv_final_result["tax_info_returned_deactivation_flag"] = $tax_info_returned_deactivation_flag;
			$tv_final_result["tax_info_returned_deactivation_flag_descr"] = $tax_info_returned_deactivation_flag_descr;
			$tv_final_result["tax_info_returned_firm_flag_descr"] = $tax_info_returned_firm_flag_descr;
			$tv_final_result["tax_info_returned_onomasia"] = $tax_info_returned_onomasia;
			$tv_final_result["tax_info_returned_commer_title"] = $tax_info_returned_commer_title;
			$tv_final_result["tax_info_returned_legal_status_descr"] = $tax_info_returned_legal_status_descr;
			$tv_final_result["tax_info_returned_postal_address"] = $tax_info_returned_postal_address;
			$tv_final_result["tax_info_returned_postal_address_no"] = $tax_info_returned_postal_address_no;
			$tv_final_result["tax_info_returned_postal_zip_code"] = $tax_info_returned_postal_zip_code;
			$tv_final_result["tax_info_returned_postal_area_description"] = $tax_info_returned_postal_area_description;
			$tv_final_result["tax_info_returned_regist_date"] = $tax_info_returned_regist_date;
			$tv_final_result["tax_info_returned_stop_date"] = $tax_info_returned_stop_date;
			$tv_final_result["tax_info_returned_normal_vat_system_flag"] = $tax_info_returned_normal_vat_system_flag;

			return $tv_final_result;
		}
		// ERROR HANDLING
		catch(Exception $e) {
			$tv_message = "tf_retrive_tax_data_from_afm : " . $e->getMessage();
			echo $tv_message;
			return $tv_message;
		}
	}

?>
