<?php
	class Tab {                        
		//table genetor class defination
		public $title;         // attribute
		public $rows = []; // array created
		public function setHeading($title){           // function to setheading
			$this->title = $title;

		}
		 public function addingRow($row)     // function for adding row
		{
			$this->row[] = $row;
		}
		public function getH(){             // function to get HTML
			$html = '<table border = "2">';
			$html .= '<tr>';
			foreach ($this->title as $title) {
				$html .='<th>' .$title .'</th>';

			}
			$html .='</tr>';
			foreach ($this->row as $row) {
				$html.= '<tr>';
				foreach ($row as $key=>$cell) {
					if(!is_numeric($key)){
						$html .='<td>' .$cell. '</td>';
				}

				}
				$html .= '</tr>';

			}
			$html .='</table>';
			return $html;
		}
	}
?>

