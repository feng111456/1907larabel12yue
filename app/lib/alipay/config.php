<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016101700707247",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEowIBAAKCAQEA1J7B3xbyizeVZm1X97uHhE244dWPV1hKE+xJvdYfe5sWwI05Vu/0KEqdLBtg/XdcDY8+oxu2AcUYAzxYXjT7bKM6nw8i/qHAMhaCT8jHJQDk2jjGwXTsumQOfXY2NBBmb3olUsqtnMU047ctoEpWcQ0h1xFP8XtU97b5Es8lr6YTHRoM4bkWVObzUdaVKYGoTtluYwM3Tw2ym5qkaaPdTGNV4tkOqg42fNZnjmf1LV0Npw1ouDw6dsFI+65S807HudugLorY5poXeNsFDvjd6WNbegwUTsDBib71+eUasHB5QKirq4el7672QDN6/e9gEPAGTCRviSSgyCaFypZV6wIDAQABAoIBAE3MOUwT7XObRwNPhxySdaeneLrJlcVz/McFcoYPzz0/JjgWdKCm9EO56YC2E+sqvXgIrfaosRQ8teiZMAxofoblwxFoTHm3Xcf2DIB9CsEzbomatL8ctXIOIm8tze+HALRRkU6V8qimUA/yerNn//ElyPgU0ZeedRyeysxjF3sJMlraieiYuJCBIvPK9rqTXxLZ59Cm4RDP1RnmZ/cMjbdZ+yW3G+78koOq+vjOQI0G/AEFtmvNmEDGCYrkE4DBYz65eqSvYk2wU5xiILJ9uuy/NSozzXUBxOv50G897TkMulkEPn/t5CeB2tPncYXJQT1CIruQFgJ1pDrO5E/TMGECgYEA+dK1mG82OLxgvyjL4kygf8GFucF5LSTnA87Takil4BZc5ghnyiDeGCKOkSQEAY7PSJ09c9bbDRj/bLUsldD4DRdqwrLK18qJ6zZrjCpP+Wr4mzppUPY5DTtRdst66m8fCpk4fn1Sz5Is++FTEfeRD9i7Mcg2pBPHCx32aJLS4S0CgYEA2eCREhIPulp1rwwnlMiznsVXhTRHMT2SL8jwtrfwZtCRXQZb5iQ8BDdgfcSbczir0jDH+ijHEG5424ohP7VwQ9Xum9Ox7GM4QaVQtw+ijrij3b2jyqOm0EznaEgYqjlE7UpR0gJjxCi/vkUPaQMCC1Bh7H7yAWgsnn/WMU00kncCgYEA96Z4nFbKsm2TnoxLqNb7WAo4jU8M18K4O58hF0BTJxQkHWkBsm7om5ZOK/U+/2hZdYtiat33okFAm7vyKcXQz/GBxOZGjKpcFE6LSJR9WSxArGi4FCkxnztJY3ENNS7Y38HKLiIAIIKwkzToC2yWYdYgo5XtDLQKYavfJAVAhTUCgYB2om27njQML5dm4kJnJEWRzTiTolyldjY0aMCRbWSsRyLvuTeu/8niLdkPgk92lMQSJletYijKTKzoNbVXAE+J0GIlXUbDRV9rdz2VACFufyFS6yDVhPie8VELmj476gUbA927cWurcti9HNOARZAGYxV+9byGgZfSEh+qJrTajwKBgA0kfWwU305IWDc5FESWefm/RxeORjyJEOH+e3cWI39NYrorYKLET+f3CO9RAIdVzLNX5IVSalT+9PkBKenHxU97vV4CWrLtETYgYBxR5hHZnm19XbsyWPaYvevB+gLEa1WGihvGfiEAUqfSElX5tMgezcLz/YMgqSgWNgD4rZ2L",
		
		//异步通知地址
		'notify_url' => "http://localhost/alipay/notify_url.php",
		
		//同步跳转
		'return_url' => "http://localhost/alipay/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAnkKV6K8s+NyEoNtyoD1u6yESM5MNigEiYwj7VGl0bdT6rN1K+CQoCwu9qevAkRtsWBg4DtMnWX9/LF3bbxODH9r3njIjXXW4EGWI9oop1n+wyEGvhUK+jqKWWztyX5SU5LQXmizWF7l7Q6bm9hUrX9QJ2ftvwYrT9uCDQxG8JsflvfVmkYmuoaNbfUYA/KrwJfsifH660wgFBSd+0dlCs2piuYq1pcxHiFx0oumV6w+3LMEl4UspRsoVagNJhVQTd2baSX7O5cVNkWXX+3wWb91hcoFqu7iD8BMzAi7r9+mMZz48Ge1xPPbKWTFM60vPX/+iygXl0ylyZdsJzy60pwIDAQAB",
		
	
);