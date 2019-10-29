<?php

require_once("model/CommentModel.php");
/////////////////////
/// COMMENT VIEW  ///
/////////////////////
class CommentView{

	/////////////////////
	/// COMENT FRONT  ///
	/////////////////////
	public function showComments($dataArray){
		$html = "";
		for ($i=0; $i<count($dataArray); $i++) {	
			$html.= '<div class="major">
						<h3>'.$dataArray[$i]["user_name"].'</h3>
						<h5>'.$this->frDate($dataArray[$i]["date_creation"]).'</h5>
						<p>'.$dataArray[$i]["content"].'</p>
						<form method="POST" action="">
							<input type="hidden" id="state" name="state" value="1"/>
							<input type="hidden" id="id" name="id" value="'.$dataArray[$i]["id"].'"/> 
							';
			if ($dataArray[$i]["state"] == 2) {$html.='<input type="submit" value="Signaler" />';} // REPORT BUTTON
			$html.='
						</form>
					</div>';
		}
		return $html;
	}

	/////////////////////
	/// COMENT BACK   ///
	/////////////////////
	public function showCommentsAdmin($dataArray){
		$html = "";
		for ($i=0; $i<count($dataArray); $i++) {	
			$html.= '<div class="adminCom">';
				if ($dataArray[$i]["state"] == 1) {$html.='<span id="report">Signalé</span>';}
				if ($dataArray[$i]["state"] == 0) {$html.='<span id="new">Nouveau</span>';}

				$html.= '
						<div class="adminComment">
							<b>'.$dataArray[$i]["user_name"].'</b>
							<p>'.$this->frDate($dataArray[$i]["date_creation"]).'</p>
						</div>	

						<div class="adminComment">
							<p>'.$dataArray[$i]["content"].'</p></br>
						</div>
						
						<div class="adminComment">
							<form method="POST" action="">
								<input type="hidden" id="state" name="state" value="2"/>
								<input type="hidden" id="id" name="id" value="'.$dataArray[$i]["id"].'"/>
								<input type="submit" value="Publier" />
							</form>

							<form method="POST" action="">
								<input type="hidden" id="state" name="state" value="3"/>
								<input type="hidden" id="id" name="id" value="'.$dataArray[$i]["id"].'"/>
								<input type="submit" value="Publier définitivement" />
							</form>

							<form method="POST" action="">
								<input type="hidden" id="state" name="state" value="4"/>
								<input type="hidden" id="id" name="id" value="'.$dataArray[$i]["id"].'"/>
								<input type="submit" value="Supprimer le commentaire" />
							</form>
						</div>
					</div>';
		}
		return $html;
	}
	
	//////////////////////////
	/// FR DATE FUNCTION   ///
	//////////////////////////
	private function frDate($date){
		$date = explode(" ", $date);
		$date[0] = explode("-", $date[0]);
		$date[1] = explode(":", $date[1]);
		return $date[0][2] . "-" . $date[0][1] . "-" . $date[0][0] . " " . $date[1][0] . ":" . $date[1][1];
	}
}

