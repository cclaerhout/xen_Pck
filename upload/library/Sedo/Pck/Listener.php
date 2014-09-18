<?php
class Sedo_Pck_Listener
{
	protected static $_view;

	public static function controllerPreView(XenForo_FrontController $fc, 
		XenForo_ControllerResponse_Abstract &$controllerResponse,
		XenForo_ViewRenderer_Abstract &$viewRenderer,
		array &$containerParams
	)
	{
		if(!($viewRenderer instanceof XenForo_ViewRenderer_Json)
			&& XenForo_Application::get('options')->get('sedo_pck_parse_bbcode_notice')
			&& XenForo_Application::get('options')->get('sedo_pck_notices_create_view')
		)
		{
			$response = $fc->getResponse();
			self::$_view = new XenForo_ViewPublic_Base($viewRenderer, $response, $containerParams);
		}
	}

	public static function extendViewPublicPageView($class, array &$extend)
	{
		if($class == 'XenForo_ViewPublic_Page_View')
		{
			$extend[] = 'Sedo_Pck_ViewPublic_Page_View';
		}	
	}

	public static function extendViewPublicHelpPage($class, array &$extend)
	{
		if($class == 'XenForo_ViewPublic_Help_Page')
		{
			$extend[] = 'Sedo_Pck_ViewPublic_Help_Page';
		}	
	}

	public static function noticesPrepare(array &$noticeList, array &$noticeTokens, XenForo_Template_Abstract $template, array $containerData)
	{
		if(!XenForo_Application::get('options')->get('sedo_pck_parse_bbcode_notice'))
		{
			return;
		}

		$formatterOptions = array(
			'view' => self::$_view,
			'smilies' => array()
		);
		
		$bbCodeParser = XenForo_BbCode_Parser::create(XenForo_BbCode_Formatter_Base::create('Base', $formatterOptions));
		
		foreach ($noticeList AS $noticeId => &$notice)
		{
			if(!isset($notice['message']))
			{
				continue;
			}
			
			$message = &$notice['message'];
			$message = $bbCodeParser->render($message);
			$message = htmlspecialchars_decode($message);
			$message = str_replace("</p><br />\n<br />", "</p>", $message);			
		}
	}

	public static function extendViewAdminPageEdit($class, array &$extend)
	{
		if($class == 'XenForo_ViewAdmin_Page_Edit')
		{
			$extend[] = 'Sedo_Pck_ViewAdmin_Page_Edit';
		}	
	}

	public static function extendViewAdminHelpPageEdit($class, array &$extend)
	{
		if($class == 'XenForo_ViewAdmin_HelpPage_Edit')
		{
			$extend[] = 'Sedo_Pck_ViewAdmin_HelpPage_Edit';
		}	
	}

	public static function extendViewAdminNotice($class, array &$extend)
	{
		if($class == 'XenForo_ViewAdmin_Notice_Edit')
		{
			$extend[] = 'Sedo_Pck_ViewAdmin_Notice_Edit';
		}
	}		
}
//Zend_Debug::dump($contents);