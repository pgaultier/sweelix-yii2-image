<?php
/**
 * File Image.php
 *
 * PHP version 5.4+
 *
 * @author    Philippe Gaultier <pgaultier@sweelix.net>
 * @copyright 2010-2014 Sweelix
 * @license   http://www.sweelix.net/license license
 * @version   XXX
 * @link      http://www.sweelix.net
 * @category  web
 * @package   sweelix.yii2.image.web
 */

namespace sweelix\yii2\image;
use sweelix\image\Image as BaseImage;
use yii\base\Exception;
use Yii;

/**
 * Class Image wraps @see sweelix\image\Image and
 * Yii into one class to inherit Yii config
 *
 * @author    Philippe Gaultier <pgaultier@sweelix.net>
 * @copyright 2010-2014 Sweelix
 * @license   http://www.sweelix.net/license license
 * @version   XXX
 * @link      http://www.sweelix.net
 * @category  web
 * @package   sweelix.yii2.image.web
 * @since     XXX
 */
class Image extends BaseImage {
	/**
	 * Constructor, create an image object. This object will
	 * allow basic image manipulation
	 *
	 * @param string  $fileImage  image name with path
	 * @param integer $quality    quality, default is @see Image::_quality
	 * @param integer $ratio      ratio, default is @see Image::_ratio
	 * @param string  $base64Data image data base64 encoded
	 *
	 * @return Image
	 * @since  XXX
	 */
	public function __construct($fileImage, $quality=null, $ratio=null, $base64Data=null) {
		try {
			$component = Yii::$app->get('image');
			if($component===null) {
				throw new Exception('sweelix\yii2\image\Config has not been defined');
			}
			static::$cachePath = $component->getCachePath();
			$this->cachingMode = $component->getCachingMode();
			$this->setQuality($component->getQuality());
			self::$urlSeparator = $component->getUrlSeparator();
			self::$errorImage = $component->getErrorImage();
			parent::__construct($fileImage, $quality, $ratio, $base64Data);
		} catch(Exception $e) {
			Yii::error($e->getMessage(), __METHOD__);
			throw $e;
		}
	}

	/**
	 * Create an instance of Image with correct parameters
	 * calls original constructor @see Image::__construct()
	 *
	 * @param string  $fileImage  image name with path
	 * @param integer $quality    quality, default is @see BaseImage::_quality
	 * @param integer $ratio      ratio, default is @see BaseImage::_ratio
	 * @param string  $base64Data image data base64 encoded
	 *
	 * @return Image
	 * @since  XXX
	 */
	public static function create($fileImage, $quality=null, $ratio=null, $base64Data=null) {
		return new static($fileImage, $quality, $ratio, $base64Data);
	}
}