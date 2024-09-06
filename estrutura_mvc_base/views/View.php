<?php
	namespace views;

	class View{

		const DEFAULT_HEADER = 'header.php';
		const DEFAULT_FOOTER = 'footer.php';
		
		public function render($body,$item= [],$header = null,$footer = null){
			if($body=="login.php"){

				include('views/templates/'.$body);

			}

			else{
				
				if($header == null)
				{
					include('views/templates/'.self::DEFAULT_HEADER);
				}
				extract($item);
				include('views/templates/'.$body);

				if($footer == null){
					include('views/templates/'.self::DEFAULT_FOOTER);
				}


			}


		}

	}
?>