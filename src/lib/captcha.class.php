<?php
	session_start();

	class captcha {
		public $image;

		/**
		   Create a new captchaimage
		*/
		public function create($img, $font) {
			Header ("Content-type: image/png");
			$this->image = ImageCreateFromPNG($img);
			$randomText = "";
			for ($i = 1; $i <= 5; $i++) {
				$fontSize = rand(15, 32);
				$x = $i * 25 + rand(1, 10);
				$y = rand(0, 10) + 30;
				$winkel = rand(-10, 10);
				$char = $this->generateRandomChar();
				ImageTTFText ($this->image,
								$fontSize,
								$winkel,
								$this->validateX($x, $fontSize),
								$y,
								$this->generateRandomColor(),
								$font,
								$char
				);
				$randomText .= $char;
			}
			ImagePng($this->image);
			imagedestroy($this->image);
			$_SESSION["captchaString"] = $randomText;
			return $randomText;
		}
		
		/**
			Checks the captcha
		*/
		public function check($captchaString) {
			return $captchaString == $_SESSION["captchaString"];
		}
		
		/**
			Gernerate a random color
		*/
		public function generateRandomColor() {
			return ImageColorAllocate($this->image, rand(1, 255), rand(1, 255), rand(1, 255));
		}
		/**
			Generate a random Char
		*/
		public function generateRandomChar() {
			$charPool = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!?+=";
			return $charPool[rand(0, strlen($charPool)-1)];
		}
		
		/**
			Validate the x padding
		*/
		private function validateX($x, $fontSize) {
			return $x > (200 - $fontSize - 5) ? (200 - $fontSize - 5) : $x;
		}
	}
?>