<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CaptchaController extends Controller
{
	public function generate(Request $request)
	{
		// If refresh button clicked → generate new
		if ($request->has('refresh') || $request->has('id')) {

			$code = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 6);

			Session::put('captcha_code', $code);
		} else {

			// First time load → create only if not exists
			if (!Session::has('captcha_code')) {

				$code = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 6);

				Session::put('captcha_code', $code);
			} else {

				// VERY IMPORTANT: reuse same captcha
				$code = Session::get('captcha_code');
			}
		}


		// CREATE IMAGE

		$width = 180;
		$height = 60;

		$image = imagecreatetruecolor($width, $height);

		$bgColor = imagecolorallocate($image, 255, 255, 255);
		imagefill($image, 0, 0, $bgColor);

		$fontPath = base_path('public/fonts/Arial.ttf');

		$fontSize = 24;

		for ($i = 0; $i < strlen($code); $i++) {

			$angle = rand(-25, 25);

			$x = 20 + ($i * 25);

			$y = rand(35, 45);

			$textColor = imagecolorallocate($image, 0, 0, 0);

			imagettftext(
				$image,
				$fontSize,
				$angle,
				$x,
				$y,
				$textColor,
				$fontPath,
				$code[$i]
			);
		}

		\Session::save(); // ADD THIS LINE

		ob_start();

		imagepng($image);

		$imageData = ob_get_clean();

		imagedestroy($image);

		return response($imageData)->header('Content-Type', 'image/png');
	}
}
