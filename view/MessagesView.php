<?php

require_once("model/MessageModel.php");
/////////////////////
/// COMMENT VIEW  ///
/////////////////////
class MessageView{


	/////////////////////
	/// MESSAGE BACK   ///
	/////////////////////
	public function showNewMessages($dataArray){
		$html = "";
		for ($i=0; $i<count($dataArray); $i++) {	
			$html.= '<div class="adminCom">
						<div class="adminComment">
							<b>'.$dataArray[$i]["user_name"].'</b></br>
							<p>'.$this->frDate($dataArray[$i]["date_creation"]).'</p></br>
						</div>

						<div class="adminComment">
							<p>'.$dataArray[$i]["message"].'</p>
						</div>

						<div class="adminComment">
							<form method="POST" action="">
								<input type="hidden" id="state" name="state" value="1"/>
								<input type="hidden" id="id" name="id" value="'.$dataArray[$i]["id"].'"/>
								<input type="submit" value="Archiver le message" />
							</form>
							<form method="POST" action="">
								<input type="hidden" id="state" name="state" value="2"/>
								<input type="hidden" id="id" name="id" value="'.$dataArray[$i]["id"].'"/>
								<input type="submit" value="Supprimer le message" />
							</form>
							<p>Répondre à '.$dataArray[$i]["user_name"].':</p><a href="mailto:'.$dataArray[$i]["email"].'">'.$dataArray[$i]["email"].'</a></br>
						</div>
					</div>';
		}
		return $html;
	}


	public function showOldMessages($dataArray){
		$html = "";
		for ($i=0; $i<count($dataArray); $i++) {	
			$html.= '<div class="adminCom">
						<div class="adminComment">
							<b>'.$dataArray[$i]["user_name"].'</b></br>
							<p>'.$this->frDate($dataArray[$i]["date_creation"]).'</p></br>
						</div>

						<div class="adminComment">
							<p>'.$dataArray[$i]["message"].'</p>
						</div>

						<div class="adminComment">
							<form method="POST" action="">
								<input type="hidden" id="state" name="state" value="2"/>
								<input type="hidden" id="id" name="id" value="'.$dataArray[$i]["id"].'"/>
								<input type="submit" value="Supprimer le message" />
							</form>
							<p>Répondre :</p><a href "mailto:'.$dataArray[$i]["email"].'">'.$dataArray[$i]["email"].'</a></br>
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

