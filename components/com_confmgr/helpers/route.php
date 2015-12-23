<?php
/**
 * @author		Dr Kaushal Keraminiyage
 * @copyright	Dr Kaushal Keraminiyage
 * @license		GNU General Public License version 2 or later
 */

defined("_JEXEC") or die("Restricted access");

/**
 * Confmgr Component Route Helper
 *
 * @package     Confmgr
 * @subpackage  Helpers
 */
abstract class ConfmgrHelperRoute
{
	protected static $lookup;

	protected static $lang_lookup = array();

	/**
	 * @param   integer  The route of the content item
	 */
	public static function getPaperRoute($id, $catid = 0, $language = 0)
	{
		$needles = array(
			'paper'  => array((int) $id)
		);
		//Create the link
		$link = 'index.php?option=com_confmgr&view=paper&id='. $id;

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param   integer  The route of the content item
	 */
	public static function getAbstractRoute($id, $catid = 0, $language = 0)
	{
		$needles = array(
			'abstract'  => array((int) $id)
		);
		//Create the link
		$link = 'index.php?option=com_confmgr&view=abstract&id='. $id;

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param   integer  The route of the content item
	 */
	public static function getFull_paperRoute($id, $catid = 0, $language = 0)
	{
		$needles = array(
			'full_paper'  => array((int) $id)
		);
		//Create the link
		$link = 'index.php?option=com_confmgr&view=full_paper&id='. $id;

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param   integer  The route of the content item
	 */
	public static function getCamera_ready_paperRoute($id, $catid = 0, $language = 0)
	{
		$needles = array(
			'camera_ready_paper'  => array((int) $id)
		);
		//Create the link
		$link = 'index.php?option=com_confmgr&view=camera_ready_paper&id='. $id;

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param   integer  The route of the content item
	 */
	public static function getPresentationRoute($id, $catid = 0, $language = 0)
	{
		$needles = array(
			'presentation'  => array((int) $id)
		);
		//Create the link
		$link = 'index.php?option=com_confmgr&view=presentation&id='. $id;

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param   integer  The route of the content item
	 */
	public static function getThemeRoute($id, $catid = 0, $language = 0)
	{
		$needles = array(
			'theme'  => array((int) $id)
		);
		//Create the link
		$link = 'index.php?option=com_confmgr&view=theme&id='. $id;

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param   integer  The route of the content item
	 */
	public static function getAuthorRoute($id, $catid = 0, $language = 0)
	{
		$needles = array(
			'author'  => array((int) $id)
		);
		//Create the link
		$link = 'index.php?option=com_confmgr&view=author&id='. $id;

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param   integer  The route of the content item
	 */
	public static function getRev1ewerRoute($id, $catid = 0, $language = 0)
	{
		$needles = array(
			'rev1ewer'  => array((int) $id)
		);
		//Create the link
		$link = 'index.php?option=com_confmgr&view=rev1ewer&id='. $id;

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param   integer  The route of the content item
	 */
	public static function getRev1ewRoute($id, $catid = 0, $language = 0)
	{
		$needles = array(
			'rev1ew'  => array((int) $id)
		);
		//Create the link
		$link = 'index.php?option=com_confmgr&view=rev1ew&id='. $id;

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param   integer  The route of the content item
	 */
	public static function getAuthor_for_paperRoute($id, $catid = 0, $language = 0)
	{
		$needles = array(
			'author_for_paper'  => array((int) $id)
		);
		//Create the link
		$link = 'index.php?option=com_confmgr&view=author_for_paper&id='. $id;

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param   integer  The route of the content item
	 */
	public static function getRev1ewer_for_paperRoute($id, $catid = 0, $language = 0)
	{
		$needles = array(
			'rev1ewer_for_paper'  => array((int) $id)
		);
		//Create the link
		$link = 'index.php?option=com_confmgr&view=rev1ewer_for_paper&id='. $id;

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param   integer  The route of the content item
	 */
	public static function getPaymentRoute($id, $catid = 0, $language = 0)
	{
		$needles = array(
			'payment'  => array((int) $id)
		);
		//Create the link
		$link = 'index.php?option=com_confmgr&view=payment&id='. $id;

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	protected static function _findItem($needles = null)
	{
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu('site');
		$language	= isset($needles['language']) ? $needles['language'] : '*';

		// Prepare the reverse lookup array.
		if (!isset(self::$lookup[$language]))
		{
			self::$lookup[$language] = array();

			$component	= JComponentHelper::getComponent('com_confmgr');

			$attributes = array('component_id');
			$values = array($component->id);

			if ($language != '*')
			{
				$attributes[] = 'language';
				$values[] = array($needles['language'], '*');
			}

			$items = $menus->getItems($attributes, $values);

			foreach ($items as $item)
			{
				if (isset($item->query) && isset($item->query['view']))
				{
					$view = $item->query['view'];
				if (!isset(self::$lookup[$language][$view]))
					{
						self::$lookup[$language][$view] = array();
					}
					if (isset($item->query['id']))
					{

						// here it will become a bit tricky
						// language != * can override existing entries
						// language == * cannot override existing entries
						if (!isset(self::$lookup[$language][$view][$item->query['id']]) || $item->language != '*')
						{
							self::$lookup[$language][$view][$item->query['id']] = $item->id;
						}
					}
				}
			}
		}

		if ($needles)
		{
			foreach ($needles as $view => $ids)
			{
				if (isset(self::$lookup[$language][$view]))
				{
					foreach ($ids as $id)
					{
						if (isset(self::$lookup[$language][$view][(int) $id]))
						{
							return self::$lookup[$language][$view][(int) $id];
						}
					}
				}
			}
		}

		// Check if the active menuitem matches the requested language
		$active = $menus->getActive();
		if ($active && ($language == '*' || in_array($active->language, array('*', $language)) || !JLanguageMultilang::isEnabled()))
		{
			return $active->id;
		}

		// If not found, return language specific home link
		$default = $menus->getDefault($language);
		return !empty($default->id) ? $default->id : null;
	}
}
