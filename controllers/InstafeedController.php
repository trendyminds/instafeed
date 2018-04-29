<?php
/**
 * Instafeed plugin for Craft CMS
 *
 * Instafeed Controller
 *
 * https://craftcms.com/docs/plugins/controllers
 * --snip--
 *
 * @author    TrendyMinds
 * @copyright Copyright (c) 2018 TrendyMinds
 * @link      https://trendyminds.com
 * @package   Instafeed
 * @since     1.0.0
 */

namespace Craft;

class InstafeedController extends BaseController
{

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     * @access protected
     */
    protected $allowAnonymous = array('actionIndex');

    /**
     * Handle a request going to our plugin's index action URL, e.g.: actions/instafeed
     */
    public function actionIndex()
    {
        header('Content-Type: application/json');
        echo json_encode(craft()->instafeed->getPosts(), JSON_PRETTY_PRINT);
        die();
    }
}
