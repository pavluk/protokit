<?php
/**
 *  @package    Protokit Template
 *  @version    @version@
 *  @author     Artem Pavluk - www.art-pavluk.com
 *  @copyright  Copyright (c) 2013 - 2019 NorrNext. All rights reserved.
 *  @license    GNU General Public License version 3 or later; see license.txt
 *  @link       https://www.norrnext.com/
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

HTMLHelper::addIncludePath(JPATH_COMPONENT . '/helpers');

?>
<div class="archive <?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</div>
	<?php endif; ?>
	<form id="adminForm" action="<?php echo Route::_('index.php'); ?>" method="post">
		<div class="filter-search uk-margin-bottom">
			<?php if ($this->params->get('filter_field') !== 'hide') : ?>
				<div class="uk-margin-small-bottom">
					<input type="text" name="filter-search" id="filter-search"
						   value="<?php echo $this->escape($this->filter); ?>"
						   class="uk-input"
						   onchange="document.getElementById('adminForm').submit();"
						   placeholder="<?php echo Text::_('COM_CONTENT_TITLE_FILTER_LABEL'); ?>"/>
				</div>
			<?php endif; ?>
			<div class="uk-flex uk-flex-middle">
				<?php
				echo str_replace('inputbox', 'uk-select uk-form-width-small', $this->form->monthField);
				?>
				<?php
				echo str_replace('inputbox', 'uk-select uk-form-width-small', $this->form->yearField);
				?>
				<?php
				echo str_replace('inputbox', 'uk-select uk-form-width-xsmall', $this->form->limitField)
				?>
				<button type="submit" class="uk-button uk-button-primary uk-button-small uk-margin-small-left">
					<?php echo Text::_('JGLOBAL_FILTER_BUTTON'); ?>
				</button>
				<input type="hidden" name="view" value="archive"/>
				<input type="hidden" name="option" value="com_content"/>
				<input type="hidden" name="limitstart" value="0"/>
			</div>
		</div>
		<?php echo $this->loadTemplate('items'); ?>
	</form>
</div>
