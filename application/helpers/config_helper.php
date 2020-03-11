<?php 

if ( ! function_exists('helper_ws_stock')){
	function helper_ws_stock($id_repuesto){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://ts.metusa.com/ServiciosWebPVJ2/WS_BAPI_ECOMMERCE_SOLE.asmx/mDatos_Material_Catalogo_Repuestos",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS =>"{\"pCodigoMaterial\":\"".$id_repuesto."\"}",
		  CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json"
		  ),
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);
		return $response;
	}

}

	if ( ! function_exists('helper_get_semilla')){
	    function helper_get_semilla(){
	        return '983h4g983g98';
	    }

	    function helper_btn_enviar_salir($url){
	        echo "<button type='submit' class='btn btn-success'>Enviar</button> <a class='btn btn-danger' href='".$url."'>Cancelar</a>";
	    }
	}

	if ( ! function_exists('helper_form_text')){
	    function helper_form_text($id,$texto,$valor="",$tipo="text",$placeholder="",$required="",$size1="4",$size2="8"){
				$step="";
				if($tipo=="number")
					$step = "step='.01'";
			echo "
			<div class='form-group row'>
				<label for='".$id."' class='col-sm-".$size1." col-form-label'>".$texto."</label>
				<div class='col-sm-".$size2."'>
					<input ".$required." type='".$tipo."' ".$step." placeholder='".$placeholder."' name='".$id."' class='form-control' id='".$id."' value='".$valor."'>".form_error($id, '<div class="text-danger">', '</div>')."
				</div>
			</div>
			";
	    }
	}

	if ( ! function_exists('helper_form_textarea')){
	    function helper_form_textarea($id,$texto,$valor="",$size1="4",$size2="8",$cols="4",$rows="8"){
			echo "
			<div class='form-group row'>
				<label for='".$id."' class='col-sm-".$size1." col-form-label'>".$texto."</label>
				<div class='col-sm-".$size2."'>
					<textarea rows='".$rows."' rows='".$cols."' name='".$id."' class='form-control' id='".$id."'>".$valor."</textarea>".form_error($id, '<div class="text-danger">', '</div>')."
				</div>
			</div>
			";
	    }
	} 

	if ( ! function_exists('helper_form_select')){
	    function helper_form_select($id,$texto,$data,$descripcion="descripcion",$ide="",$size1="4",$size2="8"){
			$options = "<option value=''>Elegir...</option>";
			foreach ($data as $key => $value) {
				$selected = ($ide==$value->id)?"selected":"";
				//echo $ide. "  - ".$value->id;
				$options.="<option ".set_select($id, $value->id)." ".$selected." value='".$value->id."'>".$value->$descripcion."</option>";
			}

			echo "
			<div class='form-group row'>
				<label for='".$id."' class='col-sm-".$size1." col-form-label'>".$texto."</label>
				<div class='col-sm-".$size2."'>
					<select class='form-control' name='".$id."' id='".$id."'>
						".$options."
					</select>".form_error($id, '<div class="text-danger">', '</div>')."
				</div>
			</div>
			";
	    }
	}

	if ( ! function_exists('helper_config_upload')){
	    function helper_config_upload($ruta){
			if(!file_exists($ruta)){
				if(!mkdir($ruta, 0777, true)) {
					return false;
				}
			}


			$config['upload_path']          = $ruta;
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 1000;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;
			$config['overwrite']            = true;
			$config['file_name']            = 1;

			return $config;

	    }
	}

?>