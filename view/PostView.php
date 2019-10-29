<?php

////////////////////////////////
//         POST VIEW          //
////////////////////////////////

class PostView{

	////////////////////////////////
	//      CHAPTER MENU LIST     //
	////////////////////////////////
	public function listChapter($dataArray){
		$html = "";
		for ($i=0; $i<count($dataArray); $i++) {
			$html.= '<li><a href="chapter/'.$dataArray[$i]["id"].'">'.$dataArray[$i]["title"].'</a></li>';
		}
		return $html;
	}

	//////////////////////////////////////
	//      CHAPTER MENU LIST  ADMIN    //
	//////////////////////////////////////
	public function listChapterAdmin($dataArray){
		$html = "";
		for ($i=0; $i<count($dataArray); $i++) {
			$html.= '<div class="listChapter">
						<a href="chapter/'.$dataArray[$i]["id"].'">'.$dataArray[$i]["title"].'</a>
						<form method="post" action="">
							<input type="hidden" id="chapterid" name="chapterid" value="' .$dataArray[$i]["id"]. '">
							<input type="submit" value="Supprimer le chapitre">
						</form>
					</div>';
		}
		return $html;
	}


	////////////////////////////////
	//         FULL CHAPTER       //
	////////////////////////////////
	public function fullChapter($dataArray){
		$html = "";
		for ($i=0; $i<count($dataArray); $i++) {	
			$html.= '<div class="chapter"><h2>'.$dataArray[$i]["title"].'</h2><h4>'.$this->frDate($dataArray[$i]["date_creation"]).'</h4><p>'.$dataArray[$i]["content"].'</p></div>';
		}
		return $html;
	}

	////////////////////////////////
	//      FR DATE FUCNTION      //
	////////////////////////////////
	private function frDate($date){
		$date = explode(" ", $date);
		$date[0] = explode("-", $date[0]);
		$date[1] = explode(":", $date[1]);
		return $date[0][2] . "-" . $date[0][1] . "-" . $date[0][0] . " " . $date[1][0] . ":" . $date[1][1];
	}
	
}

