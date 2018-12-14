<?php
/**
 * @package    Protokit Template
 * @version    @version@
 * @author     Igor Berdicheskiy - septdir.ru
 * @copyright  Copyright (c) 2014 - 2018 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 * @link       https://www.norrnext.com/
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

/**
 * @var \Joomla\CMS\Document\HtmlDocument $this
 * @var \Joomla\Registry\Registry         $params
 */


$app  = Factory::getApplication();
$user = Factory::getUser();

// Output as HTML5
$this->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option    = $app->input->getCmd('option', '');
$view      = $app->input->getCmd('view', '');
$layout    = $app->input->getCmd('layout', '');
$task      = $app->input->getCmd('task', '');
$itemid    = $app->input->getCmd('Itemid', '');
$sitename  = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$fullWidth = ($task === 'edit' || $layout === 'form');

// Add UIKit framework
HTMLHelper::_('script', 'uikit.min.js', array('version' => 'auto', 'relative' => true));
HTMLHelper::_('stylesheet', 'uikit.min.css', array('version' => 'auto', 'relative' => true));

// Add template js
HTMLHelper::_('script', 'template.js', array('version' => 'auto', 'relative' => true));

// Add html5 shiv
HTMLHelper::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Add Stylesheets
HTMLHelper::_('stylesheet', 'template.css', array('version' => 'auto', 'relative' => true));

// Check for a custom CSS file
HTMLHelper::_('stylesheet', 'user.css', array('version' => 'auto', 'relative' => true));

// Check for a custom js file
HTMLHelper::_('script', 'user.js', array('version' => 'auto', 'relative' => true));

// Adjusting content width
$position7ModuleCount = $this->countModules('position-7');
$position8ModuleCount = $this->countModules('position-8');

if ($position7ModuleCount && $position8ModuleCount)
{
	$width = 'uk-width-1-2@m';
}
elseif ($position7ModuleCount && !$position8ModuleCount)
{
	$width = 'uk-width-3-4@m';
}
elseif (!$position7ModuleCount && $position8ModuleCount)
{
	$width = 'uk-width-3-4@m';
}
else
{
	$width = 'uk-width-1-1@m';
}

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<jdoc:include type="head"/>
</head>
<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '')
	. ($this->direction === 'rtl' ? ' rtl' : '');
?>">
<div class="body" id="top">
	<div class="uk-container<?php echo ($fullWidth) ? ' uk-width-1-1' : ''; ?>">
		<jdoc:include type="modules" name="banner" style="xhtml"/>
		<div data-uk-grid>
			<?php if ($position8ModuleCount) : ?>
				<aside id="sidebar" class="tm-sidebar uk-width-1-4@m">
					<div class="sidebar-nav">
						<jdoc:include type="modules" name="position-8" style="xhtml"/>
					</div>
				</aside>
			<?php endif; ?>
			<main id="content" role="main" class="tm-content <?php echo $width; ?>">
				<jdoc:include type="modules" name="position-3" style="xhtml"/>
				<jdoc:include type="message"/>
				<jdoc:include type="component"/>
				<div class="uk-clearfix"></div>
				<jdoc:include type="modules" name="position-2" style="none"/>
			</main>
			<?php if ($position7ModuleCount) : ?>
				<aside id="aside" class="tm-aside uk-width-1-4@m">
					<jdoc:include type="modules" name="position-7" style="well"/>
				</aside>
			<?php endif; ?>
		</div>
	</div>
</div>
<jdoc:include type="modules" name="debug" style="none"/>
</body>
</html>
