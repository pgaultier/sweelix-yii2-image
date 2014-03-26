<?php
/**
 * File Config.php
 *
 * PHP version 5.4+
 *
 * @author    Philippe Gaultier <pgaultier@sweelix.net>
 * @copyright 2010-2014 Sweelix
 * @license   http://www.sweelix.net/license license
 * @version   1.0.0
 * @link      http://www.sweelix.net
 * @category  components
 * @package   sweelix.yii2.image.components
 */

namespace sweelix\yii2\image;
use yii\base\Exception;
use yii\base\Component;
use Yii;

/**
 * Class Config
 *
 * This module allow automatic configuration for class Image.
 * Once module is configured , Image inherit of basic properties
 * such as
 *
 *  - cachePath
 *  - cachingMode
 *  - urlSeparator
 *  - quality
 *
 * id of the module should be set to "image". If not, we will attempt to find
 * correct module.
 *
 * <code>
 * 	'components' => [
 * 		...
 * 		'image' => [
 * 			'class'=>'sweelix\yii2\image\Config',
 * 			'quality'=>80,
 * 			'cachingMode'=>sweelix\yii2\image\Image::MODE_NORMAL,
 * 			'urlSeparator'=>'/',
 * 			'cachePath'=>'@webroot/cache',
 * 			'errorImage'=>'@webroot/img/error.jpg',
 * 		],
 * 		...
 * </code>
 *
 * @author    Philippe Gaultier <pgaultier@sweelix.net>
 * @copyright 2010-2014 Sweelix
 * @license   http://www.sweelix.net/license license
 * @version   1.0.0
 * @link      http://www.sweelix.net
 * @category  components
 * @package   sweelix.yii2.components
 * @since     1.0.0
 */
class Config extends Component {
	/**
	 * @var integer define caching mode @see Image for further details
	 */
	private $_cachingMode = null;
	/**
	 * Caching mode setter @see Image::cachingMode for further details
	 *
	 * @param integer $mode can be performance, normal or debug
	 *
	 * @return void
	 * @since  1.0.0
	 */
	public function setCachingMode($mode) {
		$this->_cachingMode = $mode;
	}
	/**
	 * Caching mode getter @see Image for further details
	 *
	 * @return integer
	 * @since  1.0.0
	 */
	public function getCachingMode() {
		return $this->_cachingMode;
	}
	/**
	 * @var string this separator is used to build Urls
	 */
	private $_urlSeparator = '/';
	/**
	 * Url separator setter @see Image::urlSeparator for further details
	 *
	 * @param string $urlSeparator separator used to build Urls
	 *
	 * @return void
	 * @since  1.0.0
	 */
	public function setUrlSeparator($urlSeparator) {
		$this->_urlSeparator = $urlSeparator;
	}
	/**
	 * Url separator getter @see Image::urlSeparator for further details
	 *
	 * @return string
	 * @since  1.0.0
	 */
	public function getUrlSeparator() {
		return $this->_urlSeparator;
	}
	/**
	 * @var string define default cache path
	 */
	private $_cachePath = '@webroot/cache';
	/**
	 * Cache path setter @see Image::cachePath for further details
	 *
	 * @param string $cachePath real path (not namespace path)
	 *
	 * @return void
	 * @since  1.0.0
	 */
	public function setCachePath($cachePath) {
		$this->_cachePath = $cachePath;
	}
	/**
	 * Cache path getter @see Image::cachePath for further details
	 *
	 * @return string
	 * @since  1.0.0
	 */
	public function getCachePath() {
		return Yii::getAlias($this->_cachePath);
	}
	/**
	 * @var string this image is used when original image cannot be found
	 */
	private $_errorImage = '@webroot/error.jpg';
	/**
	 * Error image setter @see Image::errorImage for further details
	 *
	 * @param string $errorImage error image name
	 *
	 * @return void
	 * @since  1.0.0
	 */
	public function setErrorImage($errorImage) {
		$this->_errorImage = $errorImage;
	}
	/**
	 *  Error image getter @see Image::errorImage for further details
	 *
	 * @return string
	 * @since  1.0.0
	 */
	public function getErrorImage() {
		return Yii::getAlias($this->_errorImage);
	}
	/**
	 * @var integer define the quality used for the rendering
	 */
	private $_quality = 90;
	/**
	 * Quality setter @see Image::setQuality() for further details
	 *
	 * @param integer $quality image quality default to 90
	 *
	 * @return void
	 * @since  1.0.0
	 */
	public function setQuality($quality) {
		$this->_quality = $quality;
	}
	/**
	 * Cache path getter @see Image::cachePath for further details
	 *
	 * @return integer
	 * @since  1.0.0
	 */
	public function getQuality() {
		return $this->_quality;
	}

	/**
	 * Init module with parameters @see CApplicationComponent::init()
	 *
	 * @return void
	 * @since  1.0.0
	 */
	public function init() {
		parent::init();
		if ((is_writable($this->getCachePath())===false) || (is_dir($this->getCachePath())===false)) {
			throw new Exception(Yii::t('sweelix', 'ImageConfig, cachePath "{cachePath}" is invalid', ['cachePath' => $this->_cachePath]));
		}
		$this->setCachingMode(Image::MODE_NORMAL);
	}
}